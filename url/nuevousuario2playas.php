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
				include("../lib/fecha.php");
				$error="";
		
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
 	
     			   
				   	if (trim($apellidol)=="")
     				{
     					$error["apellidol"]="Campo marcado (*) requerido";
     					$err=true;
     				}
     			   
				   	if (trim($dnil)=="")
     				{
     					$error["dnil"]="Campo marcado (*) requerido";
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
						$instruccion3 = "select * from playas where nombre_playa='$nombrel'" ;
						$consulta3 = mysql_query ($instruccion3, $conexion)
        					 or die ("Fallo en la consultahgfghfghfgh");
        					 
	   					$nfilas3 = mysql_num_rows ($consulta3);
     				
	        			if ($nfilas3!=0)
	        			{
	        				$error["nombrel"]="Ya existe una Playa, con ese Nombre";
	     					$err=true;
	        			}
	        			
	        			mysql_close ($conexion);
   					}
					
      			}
      			if(isset($_REQUEST['enviarl']) && $error=="")
   				{ 
   						// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ($db_host, $db_user, $db_password)
        					 or die ("No se puede conectar con el servidor");
						
   						// Seleccionar base de datos
     					mysql_select_db ($db_name)
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
						
   						// Enviar consulta para insertar contacto en la agenda.
						$instruccion = "insert into playas (nombre_playa,longitud_playa) values ('".$_REQUEST['nombrel']."','".$_REQUEST['apellidol']."')";
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consultass32");        					
         				mysql_close ($conexion);
					//	$emaill=cambiaf_a_normal($emaill);
					//	$telefonol=cambiaf_a_normal($telefonol);
         			?>
   					<div class="titulomenu">¡Enorabuena ha ingresado satifactoriamente la playa!</div>
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
   							<td>Longitud:</td>
   							<td><?php print($_REQUEST['apellidol'])?></td>
   						</tr>
   						
   					</table>
   					<br/>
   					</div>
   					<div class="preguntalogin">Haz clik <a href="playas.php">aquí</a> para volver a playas</div>
      				<?php
   				}
   				else
   				{
			?>
      			
						<div class="titulomenu">Agregar Playa > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
						Cumplimenta este formulario para agregar a una Playa
							<form ACTION="nuevousuario2playas.php" METHOD="POST">
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
								Longitud *:<input type="text"  name="apellidol"></input>
								<?php
                    if (isset($error['apellidol'])) {
                    if ($error['apellidol']!="")
									print("<span class='error'>".$error['apellidol']."</span>");
                    }
								?>
							<br/>
							
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