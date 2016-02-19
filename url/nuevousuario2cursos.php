<?php

session_start();
include("encabezado.php");
print "<LINK REL='stylesheet' TYPE='text/css' HREF='../css/estilos.css'>";
if (!isset($_SESSION['usuario']))
					{
						print("Para ver este contenido debe estar logueado");
						echo "<META HTTP-EQUIV='refresh' CONTENT='3; URL=../index.php'>";
					}
else
{
				include("../lib/fecha.php");
				$error="";
				$usuariol=$_REQUEST['usuariol'];
				$nombrem=$_REQUEST['nombrem'];
				$contraseñal=$_REQUEST['contraseñal'];
				$nombrel=$_REQUEST['nombrel'];
				$apellidol=$_REQUEST['apellidol'];
				$direcionl=$_REQUEST['direcionl'];
				$dnil=$_REQUEST['dnil'];
				$direcionl=$_REQUEST['direcionl'];
				$telefonol=$_REQUEST['telefonol'];
				$emaill=$_REQUEST['emaill'];
				$enviarl=$_REQUEST['enviarl'];
				$borrarl=$_REQUEST['borrarl'];
				$err=false;
				
				// Subir fichero
      			$copiarFichero = false;
      			
      			if (isset($enviarl))
   				{
     				//Comprobación de Errores.
   					if (trim($nombrel)=="")
     				{
     					$error["nombrel"]="Campo marcado (*) requerido";
     					$err=true;
   					}
 	
					
					if (trim($nombrem)=="")
     				{
     					$error["nombrem"]="Campo marcado (*) requerido";
     					$err=true;
     				}
     			   
				   	if (trim($apellidol)=="")
     				{
     					$error["apellidol"]="Campo marcado (*) requerido";
     					$err=true;
     				}
     			   
				   
     				if ($error=="")
     				{
     				// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ("localhost", "root", "")
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ("thesurfclub")
         					or die ("No se puede seleccionar la base de datos");
						$usuario11=$_SESSION['usuario'];
						
						
   						// Enviar consulta para comprobar que no exista un usuario, con el mismo apellido y nombre que el que queremos introducir.
						$instruccion3 = "select * from cursos where nombre_curso='$nombrel'" ;
						$consulta3 = mysql_query ($instruccion3, $conexion)
        					 or die ("Fallo en la consultahgfghfghfgh");
        					 
	   					$nfilas3 = mysql_num_rows ($consulta3);
     				
	        			if ($nfilas3!=0)
	        			{
	        				$error["nombrel"]="Ya existe un curso, con ese nombre";
	     					$err=true;
	        			}
	        			
	        			mysql_close ($conexion);
   					}
					
					if (trim($telefonol)=="")
     				{
     					$error["telefonol"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
					if (trim($dnil)=="")
     				{
     					$error["dnil"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
     				if (!is_numeric($dnil))
					{
									$error["dnil"]="Debe introducir un Numero";
									$err=TRUE;
					}
					
					if (!is_numeric($direcionl))
					{
									$error["direcionl"]="Debe introducir un Numero";
									$err=TRUE;
					}
					
					if (!preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$emaill))
					{
									$error["emaill"]="Fecha introducida incorrecta";
									$err=TRUE;
					}
     			
					if (!preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$telefonol))
					{
									$error["telefonol"]="Fecha introducida incorrecta";
									$err=TRUE;
					}
				
     				if (trim($emaill)=="")
     				{
     					$error["emaill"]="Campo marcado (*) requerido";
     					$err=true;
     				}
 				
   					if (trim($direcionl)=="")
     				{
     					$error["direcionl"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
					if ($error=="")
					{		
					// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ("localhost", "root", "")
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ("thesurfclub")
         					or die ("No se puede seleccionar la base de datos");
						if ($apellidol=="natacion" || $apellidol=="Natacion")
							$varp="Piscina";
						else if ($apellidol=="gimnasia" || $apellidol=="Gimnasia")
							$varp="Gimnasio";
						else
							$varp="$apellidol";
						$instruccionp=" select id_playa from playas where nombre_playa='$varp'";
						$consultap = mysql_query ($instruccionp, $conexion)
        					 or die ("Fallo en la consultass322");     
						$resultadop=mysql_fetch_array($consultap);
						$idplaya=$resultadop['id_playa'];
						$nfilasp = mysql_num_rows ($consultap);
						if ($nfilasp == 0)
	        			{
	        				$error["apellidol"]="No existe esa Playa";
	     					$err=true;
	        			}
						
						$instruccionm=" select id_monitor from monitores where id_monitor='$nombrem'";
						$consultam = mysql_query ($instruccionm, $conexion)
        					 or die ("Fallo en la consultass3m");     
						$resultadom=mysql_fetch_array($consultam);
						$idmonitor=$resultadom['id_monitor'];
						
						$nfilasp2 = mysql_num_rows ($consultam);
     				
	        			if ($nfilasp2 ==0)
	        			{
	        				$error["nombrem"]="No existe ese Monitor";
	     					$err=true;
	        			}
					}
     			
   				}
      			
      			if(isset($enviarl) && $error=="")
   				{ 
   						// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ("localhost", "root", "")
        					 or die ("No se puede conectar con el servidor");
						
   						// Seleccionar base de datos
     					mysql_select_db ("thesurfclub")
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
						$emaill=cambiaf_a_mysql($emaill);
						$telefonol=cambiaf_a_mysql($telefonol);
						
   						// Enviar consulta para insertar contacto en la agenda.
						$instruccion = "insert into cursos (nombre_curso,deporte,duracion_cursos,fecha_inicio_cursos,fecha_fin_curso,costo_curso,id_playa,id_monitor) values ('$nombrel','$apellidol','$dnil','$telefonol','$emaill','$direcionl','$idplaya','$idmonitor')";
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consultass32");        					
         				mysql_close ($conexion);
						$emaill=cambiaf_a_normal($emaill);
						$telefonol=cambiaf_a_normal($telefonol);
         			?>
   					<div class="titulomenu">¡Enorabuena ha ingresado satifactoriamente a<?php print" $nombrel";?> a Cursos!</div>
   					<div class="cuerpomenu">
   					<table  border="0">
   						<tr>
   							<td style="font-weight:bold;">Características:</td>
   							<td style="font-weight:bold;">Información:</td>
   						</tr>
   						<tr>
   							<td>Nombre:</td>
   							<td><?php print("$nombrel")?></td>
   						</tr>
   						<tr>
   							<td>Deporte:</td>
   							<td><?php print("$apellidol")?></td>
   						</tr>
   						<tr>
   							<td>Duracion:</td>
   							<td><?php print("$dnil")?></td>
   						</tr>
   						<tr>
   							<td>Fecha Inicio:</td>
   							<td><?php print("$telefonol")?></td>
   						</tr>
   						<tr>
   							<td>Fecha Fin:</td>
   							<td><?php print("$emaill")?></td>
   						</tr>
   						<tr>
   							<td>Costo:</td>
   							<td><?php print("$direcionl")?></td>
   						</tr>
   					</table>
   					<br/>
   					</div>
   					<div class="preguntalogin">Haz clik <a href="cursos.php">aquí</a> para volver a la agenda</div>
      				<?php
   				}
   				else
   				{
			?>
      			
						<div class="titulomenu">Agregar Cursos > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
						Cumplimenta este formulario para agregar a un Curso
							<form ACTION="nuevousuario2cursos.php" METHOD="POST">
						<br/>
						<fieldset class="formulariol">
								Nombre *:<input type="text"  name="nombrel"></input>
								<?php if ($error[nombrel]!="")
									print("<span class='error'>$error[nombrel]</span>");
								?>
							<br/>
							<br/>
								Deporte *:
								<select name="apellidol">
									<option value="surfing">Surfing</option>
									<option value="longboard">Longboard</option>
									<option value="surfcompeticion">Surfcompeticion</option>
									<option value="bodyboard">Bodyboard</option>
									<option value="Entrenamientop">Entrenamiento P</option>	
								</select>
								<?php if ($error[apellidol]!="")
									print("<span class='error'>$error[apellidol]</span>");
								?>
							<br/>
							<br/>
								Duración *:<input type="text"  name="dnil"></input>
								<?php if ($error[dnil]!="")
									print("<span class='error'>$error[dnil]</span>");
								?>
							<br/>
							<br/>

								Fecha Inicio *:<input type="text"  name="telefonol"></input>
								<?php if ($error[telefonol]!="")
									print("<span class='error'>$error[telefonol]</span>");
								?>
							<br/>
							<br/>
								Fecha Fin *:<input type="text"  name="emaill"></input>
								<?php if ($error[emaill]!="")
									print("<span class='error'>$error[emaill]</span>");
								?>
							<br/>
							<br/>
								Costo *:<input type="text"  name="direcionl"></input>
								<?php if ($error[direcionl]!="")
									print("<span class='error'>$error[direcionl]</span>");
								?>
							<br/>
							<br/>
							ID Nombre Monitor *:<input type="text"  name="nombrem"></input>
								<?php if ($error[nombrem]!="")
									print("<span class='error'>$error[nombrem]</span>");
								?>
							<br/>
							<br/>
											<p class="error">Los campos marcados con (*) son obligatorios</p>
							<center>
								<input type="submit" name="enviarl" value="Enviar">
								<input type="reset" name="borrarl" value="Borrar">
							</center>
						</fieldset>
						</form>
						</div>				
				
<?php 
}
}
	include("pie.php");
?>