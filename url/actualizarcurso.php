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
      			$id=$_REQUEST['id'];
        		
   						// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ($db_host, $db_user, $db_password)
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ($db_name)
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
                    if(isset($nombreFichero)){
						$imgagen2=$nombreFichero;
    }
						
   						// Enviar consulta para selecionar los detalles de la id pasados por URL.
   						$sesion2=$_SESSION['usuario'];
						$instruccion = "select * from cursos where id_curso='$id'" ;
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consulta");        						
         				$resultado = mysql_fetch_array ($consulta);
				
				
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
                    
                    if (trim($_REQUEST['apellidol'])=="")
     				{
     					$error["apellidol"]="Campo marcado (*) requerido";
     					$err=true;
     				}
                    
                    if (trim($_REQUEST['apellidol'])=="")
     				{
     					$error["apellidol"]="Campo marcado (*) requerido";
     					$err=true;
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

						 	$instruccion="update cursos set nombre_curso='".$_REQUEST['nombrel']."',deporte='".$_REQUEST['apellidol']."' WHERE id_curso=$id";
						 	$consulta=mysql_query($instruccion,$conexion)
						 		or die("Fallo en la actualización");
						 	mysql_close ($conexion);

         					
   					?>
   					<div class="titulomenu">¡Enorabuena ha actualizado satifactoriamente el Curso!</div>
   					<div class="cuerpomenu">
   					<table  border="0">
   						<tr>
   							<td style="font-weight:bold;">Características:</td>
   							<td style="font-weight:bold;">Información:</td>
   						</tr>
   						<tr>
   							<td>Nombre Curso:</td>
   							<td><?php print($_REQUEST['nombrel'])?></td>
   						</tr>
   						<tr>
   							<td>Deporte:</td>
   							<td><?php print($_REQUEST['apellidol'])?></td>
   						
   						
   					</table>
   					<br/>
   					</div>
   					<div class="preguntalogin">Haz clik <a href="cursos.php">aquí</a> para volver a los cursos</div>
      				<?php
   				}
   				else
   				{
			?>
      			
						<div class="titulomenu">Actualizar Curso > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
						Cumplimenta este formulario para actualizar el curso
							<form ACTION="actualizarcurso.php?id=<?PHP print "$id"; ?>" METHOD="POST" ENCTYPE="multipart/form-data">
						<br/>
						<fieldset class="formulariol">
								Nombre Curso *:<input type="text"  name="nombrel" value="<?PHP 
								if (isset($_REQUEST['enviarl']))
									print($_REQUEST['nombrel']);
								else
									print($resultado['nombre_curso']);
								?>"></input>
                
								<?php
                     if (isset($error['nombrel'])) {
                    if ($error['nombrel']!="")
									print("<span class='error'>".$error['nombrel']."</span>");
                     }
								?>
							<br/>
							<br/>
								Deporte *:<input type="text"  name="apellidol" value="<?PHP
                    
                    
								if (isset($_REQUEST['enviarl'])) {
									print($_REQUEST['apellidol']);
                                    
                                }
								else
                                {
									print($resultado['deporte']);
                    
                    }
								?>"></input>
								<?php
                          if (isset($error['apellidol'])) {
                                   if ($error['apellidol']!="")
									print("<span class='error'>".$error['apellidol']."</span>");
                          }
								?>
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