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
      					$conexion = mysql_connect ("localhost", "root", "")
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ("thesurfclub")
         					or die ("No se puede seleccionar la base de datos");
						$usuario11=$_SESSION['usuario'];
						
						
   						// Enviar consulta para comprobar que no exista un usuario, con el mismo apellido y nombre que el que queremos introducir.
						$instruccion3 = "select * from material where nombre_material='$nombrel'" ;
						$consulta3 = mysql_query ($instruccion3, $conexion)
        					 or die ("Fallo en la consultahgfghfghfgh");
        					 
	   					$nfilas3 = mysql_num_rows ($consulta3);
     				
	        			if ($nfilas3!=0)
	        			{
	        				$error["nombrel"]="Ya existe un Material, con ese Nombre";
	     					$err=true;
	        			}
	        			
	        			mysql_close ($conexion);
   					}
					
      			}
      			if(isset($_REQUEST['enviarl']) && $error=="")
   				{ 
   						// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ("localhost", "root", "")
        					 or die ("No se puede conectar con el servidor");
						
   						// Seleccionar base de datos
     					mysql_select_db ("thesurfclub")
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
						
   						// Enviar consulta para insertar contacto en la agenda.
						$instruccion = "insert into material (nombre_material,tipo_material,modelo_material) values ('".$_REQUEST['nombrel']."','".$_REQUEST['apellidol']."','".$_REQUEST['dnil']."')";
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consultass32");        					
         				mysql_close ($conexion);
					//	$emaill=cambiaf_a_normal($emaill);
					//	$telefonol=cambiaf_a_normal($telefonol);
         			?>
   					<div class="titulomenu">¡Enorabuena ha ingresado satifactoriamente el Material Deseado!</div>
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
   							<td>Tipo:</td>
   							<td><?php print($_REQUEST['apellidol'])?></td>
   						</tr>
   						<tr>
   							<td>Modelo:</td>
   							<td><?php print($_REQUEST['dnil'])?></td>
   						</tr>
   					</table>
   					<br/>
   					</div>
   					<div class="preguntalogin">Haz clik <a href="material.php">aquí</a> para volver a la agenda</div>
      				<?php
   				}
   				else
   				{
			?>
      			
						<div class="titulomenu">Agregar Material > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
						Cumplimenta este formulario para agregar a un Material
							<form ACTION="nuevousuario2material.php" METHOD="POST">
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
								Tipo *:<input type="text"  name="apellidol"></input>
								<?php
                    if (isset($error['apellidol'])) {
                    if ($error['apellidol']!="")
									print("<span class='error'>".$error['apellidol']."</span>");
                    }
								?>
							<br/>
							<br/>
								Modelo *:<input type="text"  name="dnil"></input>
								<?php 
                    if (isset($error['dnil'])) {
                    if ($error['dnil']!="")
									print("<span class='error'>".$error['dnil']."</span>");
                    }
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