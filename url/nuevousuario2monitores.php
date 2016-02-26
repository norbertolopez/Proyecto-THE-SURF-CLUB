<?php

session_start();
include("encabezado.php");
include_once("db_configuration.php");
print "<LINK REL='stylesheet' TYPE='text/css' HREF='../css/estilos.css'>";
if (!isset($_SESSION['usuario']))
					{
						print("Para ver este contenido debe estar logueado");
						echo "<META HTTP-EQUIV='refresh' CONTENT='3; URL=../index.php'>";
					}
else
{
				$error="";
		
				$err=false;
				
				// Subir fichero
      			$copiarFichero = false;
      			
      			if (isset($_REQUEST['enviarl']))
   				{
     				//Comprobación de Errores.
   					if (trim($_REQUEST['nombrel'])=="")
     				{
     					$error["nombrel"]="Campo marcado (*) requerido";
     					$err=true;
   					}
     				
     				
					
					if (trim($_REQUEST['apellidol'])=="")
     				{
     					$error["apellidol"]="Campo marcado (*) requerido";
     					$err=true;
     				}
     			   
     			


     				if ($error=="")
     				{
     				// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ($db_host, $db_user, $db_password)
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ($db_name)
         					or die ("No se puede seleccionar la base de datos");
						$usuario11=$_SESSION['usuario'];
						
						
   						// Enviar consulta para comprobar que no exista un usuario, con el mismo apellido y nombre que el que queremos introducir.
						$instruccion3 = "select * from monitores where nombre_monitor='".$_REQUEST['nombrel']."' and apellidos_monitor='".$_REQUEST['apellidol']."'";
						$consulta3 = mysql_query ($instruccion3, $conexion)
        					 or die ("Fallo en la consultahgfghfghfgh");
        					 
	   					$nfilas3 = mysql_num_rows ($consulta3);
     				
	        			if ($nfilas3!=0)
	        			{
	        				$error["nombrel"]="Ya existe un monitor, con ese Nombre y apellido";
	     					$err=true;
	        			}
	        			
	        			mysql_close ($conexion);
   					}
					
					if (trim($_REQUEST['telefonol'])=="")
     				{
     					$error["telefonol"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
					if (trim($_REQUEST['dnil'])=="")
     				{
     					$error["dnil"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
     				if (!preg_match('/^[0-9]{9}$/', $_REQUEST['telefonol']))
     				{	
     					$error["telefonol"]="Telefono Invalido, Teclee un telefono correcto";
     					$err=true;
     				}
     			
     				if (trim($_REQUEST['emaill'])=="")
     				{
     					$error["emaill"]="Campo marcado (*) requerido";
     					$err=true;
     				}
      				if (trim($_REQUEST['actividadl'])=="")
     				{
     					$error["actividadl"]="Campo marcado (*) requerido";
     					$err=true;
     				}    				
   					if (trim($_REQUEST['direcionl'])=="")
     				{
     					$error["direcionl"]="Campo marcado (*) requerido";
     					$err=true;
     				}
     			
     				if (!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_REQUEST['emaill']))
     				{	
     					$error["emaill"]="Email Invalido, Teclee un email correcto";
     					$err=true;
     				}
    				
					if (!preg_match('/^[0-9]{8}[a-z,A-Z]{1}$/',$_REQUEST['dnil']))
					{
						$error["dnil"]="DNI Incorrecto, 8digitos + 1 Letra";
						$err=TRUE;
					}

   					// Copiar fichero en directorio de ficheros subidos
				  	// Se renombra para evitar que sobreescriba un fichero existente
				   	// Para garantizar la unicidad del nombre se añade una marca de tiempo
				      if (is_uploaded_file ($_FILES['imagenl']['tmp_name']))
				      {
				         $nombreDirectorio = "../img/";
				         $nombreFichero = $_FILES['imagenl']['name'];
				         $copiarFichero = true;
				
				      // Si ya existe un fichero con el mismo nombre, renombrarlo
				         $nombreCompleto = $nombreDirectorio . $nombreFichero;
				         if (is_file($nombreCompleto))
				         {
				            $idUnico = time();
				            $nombreFichero = $idUnico . "-" . $nombreFichero;
							$nombreFichero = ereg_replace (" ", "-", $nombreFichero);
				         }
				      }
				   // El fichero introducido supera el límite de tamaño permitido
				      else if ($_FILES['imagenl']['error'] == UPLOAD_ERR_FORM_SIZE)
				      {
				      	 $maxsize = $_REQUEST['MAX_FILE_SIZE'];
				         $error["imagenl"] = "¡El tamaño del fichero supera el límite permitido ($maxsize bytes)!";
				         $err = true;
				      }
				   // No se ha introducido ningún fichero
				      else if ($_FILES['imagenl']['name'] == "")
				         $nombreFichero = '';
				   // El fichero introducido no se ha podido subir
				      else
				      {
				         $error["imagenl"] = "¡No se ha podido subir el fichero!";
				         $err = true;
				      }
						
					if (trim($_FILES['imagenl']['name'])=="")
					{
						$error["imagenl"]="Campo marcado (*) requerido";
						 $err = true;
					}
					else if($_FILES['imagenl']['type']!="image/jpeg" && $_FILES['imagenl']['type']!="image/jpg" && $_FILES['imagenl']['type']!="image/png" && $_FILES['imagenl']['type']!="image/JPEG" && $_FILES['imagenl']['type']!="image/jpg" && $_FILES['imagenl']['type']!="image/PNG" && !$err)
						{
							$error["imagenl"]="Extensión de fichero invalida, solo se permite archivos jpg, gif". $_FILES['imagenl']['name']. "muestra algo";
							$err = true;
						}
   				}
      			
      			if(isset($_REQUEST['enviarl']) && $error=="")
   				{ 
   						// Conectar con el servidor de base de datos
      					$conexion2 = mysql_connect ($db_host, $db_user, $db_password)
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ($db_name)
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
   						// Enviar consulta para insertar contacto en la agenda.
						$instruccion = "insert into monitores (dni_monitor,nombre_monitor,apellidos_monitor,email_monitor,telefono_monitor,direccion_monitor,actividad_monitor,foto_monitor) values ('".$_REQUEST['dnil']."','".$_REQUEST['nombrel']."','".$_REQUEST['apellidol']."','".$_REQUEST['emaill']."','".$_REQUEST['telefonol']."','".$_REQUEST['direcionl']."','".$_REQUEST['actividadl']."','".$nombreFichero."')" ;
						$consulta = mysql_query ($instruccion, $conexion2)
        					 or die ("Fallo en la consultass");        					
         				mysql_close ($conexion2);
         				if ($copiarFichero)
       						  move_uploaded_file ($_FILES['imagenl']['tmp_name'],$nombreDirectorio . $nombreFichero);	
   					?>
   					<div class="titulomenu">¡El monitor ha ingresado satifactoriamente!</div>
   					<div class="cuerpomenu">
   					<table  border="0">
   						<tr>
   							<td style="font-weight:bold;">Características:</td>
   							<td style="font-weight:bold;">Información:</td>
   						</tr>
   						<tr>
   							<td>Nombre:</td>
   							<td><?php print($_REQUEST['nombrel'])?></td>
   						</tr>
   						<tr>
   							<td>Apellido:</td>
   							<td><?php print($_REQUEST['apellidol'])?></td>
   						</tr>
   						<tr>
   							<td>DNI:</td>
   							<td><?php print($_REQUEST['dnil'])?></td>
   						</tr>
   						<tr>
   							<td>Direccion:</td>
   							<td><?php print($_REQUEST['direcionl'])?></td>
   						</tr>
   						<tr>
   							<td>Teléfono:</td>
   							<td><?php print($_REQUEST['telefonol'])?></td>
   						</tr>
   						<tr>
   							<td>Correo Electronico:</td>
   							<td><?php print($_REQUEST['emaill'])?></td>
   						</tr>
						<tr>
   							<td>Actividad:</td>
   							<td><?php print($_REQUEST['actividadl'])?></td>
   						</tr>  						
   						<tr>
   							<td>Imagen subida:</td>
   							<td><?php print "<img src='../img/$nombreFichero' width='100px'></img>";?></td>
   						</tr>
   					</table>
   					<br/>
   					</div>
   					<div class="preguntalogin">Haz clik <a href="monitores.php">aquí</a> para volver a la agenda</div>
      				<?php
   				}
   				else
   				{
			?>
      			
						<div class="titulomenu">Agregar Monitor > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
						Cumplimenta este formulario para agregar a un Monitor
							<form ACTION="nuevousuario2monitores.php" METHOD="POST" ENCTYPE="multipart/form-data">
						<br/>
						<fieldset class="formulariol">
								Nombre *:<input type="text"  name="nombrel"></input>
								<?php 
                            if (isset($error['nombrel'])) {
                                if ($error['nombrel']!="")
									print("<span class='error'>".$error['nombrel']."</span>");
                                }
								?>
							<br/>
							<br/>
								Apellido *:<input type="text"  name="apellidol"></input>
								<?php 
                    if (isset($error['apellidol'])) {
                    if ($error['apellidol']!="")
									print("<span class='error'>".$error['apellidol']."</span>");
                    }
								?>
							<br/>
							<br/>
								DNI *:<input type="text"  name="dnil"></input>
								<?php 
                    if (isset($error['dnil'])) {
                            if ($error['dnil']!="")
									print("<span class='error'>".$error['dnil']."</span>");
                    }
								?>
							<br/>
							<br/>

								Teléfono *:<input type="text"  name="telefonol"></input>
								<?php 
                    if (isset($error['telefonol'])) {
                            if ($error['telefonol']!="")
									print("<span class='error'>".$error['telefonol']."</span>");
                    }
								?>
							<br/>
							<br/>
								Correo Electrónico *:<input type="text"  name="emaill"></input>
								<?php 
                            if (isset($error['emaill'])) {
                            if ($error['emaill']!="")
									print("<span class='error'>".$error['emaill']."</span>");
                            }
								?>
							<br/>
							<br/>
								Dirección *:<input type="text"  name="direcionl"></input>
								<?php 
                                    if (isset($error['direcionl'])) {
                                    if ($error['direcionl']!="")
									print("<span class='error'>".$error['direcionl']."</span>");
                                    }
								?>
							<br/>
							<br/>
								Actividad *:<input type="text"  name="actividadl"></input>
								<?php 
                                    if (isset($error['actividadl'])) {
                                    if ($error['actividadl']!="")
									print("<span class='error'>".$error['actividadl']."</span>");
                                    }
								?>
							<br/>

							<br/>
								Imagen  *:
								<INPUT TYPE="HIDDEN" NAME="MAX_FILE_SIZE" VALUE="10002400">					
								<input type="file" name="imagenl" value="examinar"></input>
								<?php 
                                if (isset($error['imagenl'])) {
                                if ($error['imagenl']!="")
									print("<span class='error'>".$error['imagenl']."</span>");
                                }
								?>
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