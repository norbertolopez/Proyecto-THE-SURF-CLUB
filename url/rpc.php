<?php

session_start();
								// Conectar con el servidor de base de datos.
							$conexion = mysql_connect ("localhost", "root", "")
								 or die ("No se puede conectar con el servidor");

							// Seleccionar base de datos.
							mysql_select_db ("thesurfclub")
								or die ("No se puede seleccionar la base de datos");

							//Encriptamos la contraseña.
							$usuariol=$_SESSION['usuario'];
							
							// Enviar consulta para saber si dicho usuario y clave estan en la base de datos.
							$instruccion = "select * from usuarios where usuario='$usuariol'";
							$consulta = mysql_query ($instruccion, $conexion)
								or die ("Fallo en la consulta");
							$resultado = mysql_fetch_array ($consulta);

	include('databaseConnection.php');
	include('settings.php');
	
	$action = $_POST['action'];
	switch($action) {
	
	case 'startCalendar':
		$month = $_POST['month'];
		$year = $_POST['year'];
		
		if(($month == 0) || ($year == 0)) {
			$thisDate = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		} else {
			$thisDate = mktime(0, 0, 0, $month, 1, $year);
		}
		
		echo '<div style="margin-bottom: 3px;">
					<form name="changeCalendarDate">
						<select id="ccMonth" onChange="startCalendar($F(\'ccMonth\'), $F(\'ccYear\'))">';
						
						for($i=0; $i<=11; $i++)
						{
							$monthNumber = ($i+1);
							$monthMaker = mktime(0, 0, 0, $monthNumber, 1, 2006);
							if($month > 0) {
								if($month == $monthNumber) {
									$sel = 'selected';
								} else {
									$sel = '';
								}
							} else {
								if(date("m", $thisDate) == $monthNumber) {
									$sel = 'selected';
								} else {
									$sel = '';
								}
							}
							
							/* 	
							********************************************************************************************************
								Change the names in here to your language - DO NOT CHANGE ANYTHING ELSE UNLESS YOU UNDERSTAND IT
							********************************************************************************************************
							*/
							$monthName = array('Enero',
												'Febrero',
												'Marzo',
												'Abril', 
												'Mayo',
												'Junio',
												'Julio',
												'Agosto',
												'Septiembre',
												'Octubre',
												'Noviembre',
												'Diciembre');
												

							echo '<option value="'. $monthNumber .'" '. $sel .'>'. $monthName[$i] .'</option>';
						}
						
				echo '</select>
						&nbsp;
						<select id="ccYear" onChange="startCalendar($F(\'ccMonth\'), $F(\'ccYear\'))">';
						
						$yStart = 2011;
						$yEnd = ($yStart + 4);
						for($i=$yStart; $i<$yEnd; $i++)
						{
							if($year > 0) {
								if($year == $i) {
									$sel = 'selected';
								} else {
									$sel = '';
								}
							} else {
								if(date("Y", $thisDate) == $i) {
									$sel = 'selected';
								} else {
									$sel = '';
								}
							}
							echo '<option value="'. $i .'" '. $sel .'>'. $i .'</option>';
						}
						
				echo '</select>';
				
				// Check if they are loggedin.
				if($_COOKIE['nodstrumCalendarV2']) {
					echo '&nbsp;&nbsp;<a href="#" onClick="showCP();">Opciones</a>';
				} 
				else
				{
							if ($resultado['tipo']=="admin")
							{
								echo '&nbsp;&nbsp;<a href="#" onClick="showLoginBox();">Ini. Sesi.</a>';
							}
							else
								echo '&nbsp;&nbsp;<a href="#" onClick="showLoginBox();"></a>';	
				}
				
				echo '</form>
				</div>';
		
		// Display the week days.
		echo '<div class="calendarFloat" style="text-align: center; background-color: #'. $dayColor .';"><span style="position: relative; top: 4px;">L</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #'. $dayColor .';"><span style="position: relative; top: 4px;">M</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #'. $dayColor .';"><span style="position: relative; top: 4px;">X</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #'. $dayColor .';"><span style="position: relative; top: 4px;">J</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #'. $dayColor .';"><span style="position: relative; top: 4px;">V</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #'. $weekendColor .';"><span style="position: relative; top: 4px;">S</span></div>
				<div class="calendarFloat" style="text-align: center; background-color: #'. $weekendColor .';"><span style="position: relative; top: 4px;">D</span></div>';
				
		// Show the calendar.
		for($i=0; $i<date("t", $thisDate); $i++)
		{
			$thisDay = ($i + 1);
			if(($month == 0) || ($year == 0)) {
				$finalDate = mktime(0, 0, 0, date("m"), $thisDay, date("Y"));
				$today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
				$fdf = mktime(0, 0, 0, date("m"), 1, date("Y"));
				$month = date("m");
				$year = date("Y");
			} else {
				$finalDate = mktime(0, 0, 0, $month, $thisDay, $year);
				$fdf = mktime(0, 0, 0, $month, 1, $year);
			}
			
			
			// Skip some cells to take into account for the weekdays.
			if($i == 0) {
				$firstDay = date("w", $fdf);
				$skip = ($firstDay - 1);
				if($skip < 0) { $skip = 6; }
				
				for($s=0; $s<$skip; $s++)
				{
					echo '<div class="calendarFloat" style="border: 1px solid #FFF;">&nbsp;</div>';
				}
			}
							
			// Make the weekends a darker colour.
			if((date("w", $finalDate) == 0) || (date("w", $finalDate) == 6)) {
				$bgColor = '#'. $weekendColor .'';
			} else {
				$bgColor = '#'. $dayColor .'';
			}
			
			// Determine what they should see if they are logged in or not.
			if($_COOKIE['nodstrumCalendarV2']) {
				$onClick = 'showEventForm('. $thisDay .')';
			} else {
				// displayEvents(day, $F('ccMonth'), $F('ccYear'));
				$onClick = 'displayEvents('. $thisDay .', '. $month .', '. $year .')';
			}
			
			// Check the database for any events on this day.
			$dayCheck = mysql_query("SELECT id FROM event WHERE timestamp='$finalDate' LIMIT 1", $conn);
			if($dayCheck) {
				if(mysql_num_rows($dayCheck) >0) {
					$bgColor = '#'. $eventColor .'';
				} else {
					// Check if this day is today and change it to the today color.
					if($finalDate == $today) {
						$bgColor = '#'. $todayColor .'';
					} else {
						// Dont change it.
					}
				}
			} else {
				// Nothing, ignore the error.
			}
			
			// Display the day.
			echo '<div class="calendarFloat" id="calendarDay_'. $thisDay .'" style="background-color: '. $bgColor .'; cursor: pointer;" 
									onMouseOver="highlightCalendarCell(\'calendarDay_'. $thisDay .'\')"
									onMouseOut="resetCalendarCell(\'calendarDay_'. $thisDay .'\')"
									onClick="'. $onClick .'">
						<span style="position: relative; top: '. $tTop .'; left: 1px;">'. $thisDay .'</span>
					</div>';
		}
		break;
	
	case 'listEvents':
		$day = $_POST['d'];
		$month = $_POST['m'];
		$year = $_POST['y'];
		
		$timeStamp = mktime(0,0,0, $month, $day, $year);
		
		$eventQuery = mysql_query("SELECT id, body FROM event WHERE timestamp='$timeStamp' ORDER BY id DESC", $conn);
		if($eventQuery) {
			if(mysql_num_rows($eventQuery) >0) {
				echo '<br><b>Evento: '. date("d", $timeStamp) .'/'. date("m", $timeStamp) .'/'. date("Y", $timeStamp) .'</b>';
				for($i=0; $i<mysql_num_rows($eventQuery); $i++) {
					if($i % 2) { $bgColor = '#'. $iteratorColor1 .''; } else { $bgColor='#'. $iteratorColor2 .''; }
					extract(mysql_fetch_array($eventQuery), EXTR_PREFIX_ALL, 'e');
					
					if($_COOKIE['nodstrumCalendarV2']) {
						echo '<div style="background-color: '. $bgColor .'; margin-bottom: 4px; padding: 1px;" id="event_'.$e_id.'">
								<div>
									'. nl2br($e_body) .'
								</div>
								<div style="font-size: 9px;">
									<span style="color: blue; text-decoration: underline; cursor: pointer;" onClick="deleteEvent('.$e_id.')">
										Borrar Este Evento
									</span>
								</div>
							</div>';
					} else {
						echo '<div style="background-color: '. $bgColor .'; margin-bottom: 4px; padding: 1px;">
								'. nl2br($e_body) .'
							</div>';	
					}
				} // for.
			} else {
				echo 'No hay eventos disponibles para hoy';
			}
		} else {
			echo 'Error getting the results.';
		}
		
		break;
	
	case 'addEvent':
		$day = $_POST['d'];
		$month = $_POST['m'];
		$year = $_POST['y'];
		$body = $_POST['body'];
		
		$timeStamp = mktime(0,0,0, $month, $day, $year);
		$bodyF = addslashes(trim($body));
		$addEvent = mysql_query("INSERT INTO event (body, timestamp) VALUES ('$body', '$timeStamp')", $conn);
		break;
	
	case 'deleteEvent':
		if($_COOKIE['nodstrumCalendarV2']) {
			$eid = $_POST['eid'];
			if(is_numeric($eid)) {
				$deleteIt = mysql_query("DELETE FROM event WHERE id='$eid' LIMIT 1", $conn);
			} else {
				// Dont do anything.
			}
		} else {
			// Dont delete it.
		}
		break;
		
		
	default:
		echo 'Whoops.';
		break;
	}

?>