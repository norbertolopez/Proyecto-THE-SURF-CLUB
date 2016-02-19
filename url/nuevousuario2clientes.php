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
				$nombrel=$_REQUEST['nombrel'];
				$apellidol=$_REQUEST['apellidol'];
				$dnil=$_REQUEST['dnil'];
				$cursol=$_REQUEST['cursol'];
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
					
					if (trim($cursol)=="")
     				{
     					$error["cursol"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
     				if (!preg_match('/^[0-9]{8}[a-z,A-Z]{1}$/',$dnil))
					{
						$error["dnil"]="DNI Incorrecto, 8digitos + 1 Letra";
						$err=TRUE;
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
						$instruccion3 = "select * from clientes where dni_cliente='$dnil'" ;
						$consulta3 = mysql_query ($instruccion3, $conexion)
        					 or die ("Fallo en la consultahgfghfghfgh");
        					 
	   					$nfilas3 = mysql_num_rows ($consulta3);
     				
	        			if ($nfilas3!=0)
	        			{
	        				$error["dnil"]="Ya existe un Cliente, con ese DNI";
	     					$err=true;
	        			}
						
						$instruccion4 = "select * from cursos where id_curso='$cursol'" ;
						$consulta4 = mysql_query ($instruccion4, $conexion)
        					 or die ("Fallo en la consultahgfghfghfgh");
        					 
	   					$nfilas4 = mysql_num_rows ($consulta4);
     				
	        			if ($nfilas4==0)
	        			{
	        				$error["cursol"]="No existe ningun curso con ese id";
	     					$err=true;
	        			}
	        			
	        			mysql_close ($conexion);
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
						
   						// Enviar consulta para insertar contacto en la agenda.
						$instruccion = "insert into clientes (nombre_cliente,apellidos_cliente,dni_cliente) values ('$nombrel','$apellidol','$dnil')";
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consultass32a");  
						$instruccion2="select id_cliente from clientes where dni_cliente='$dnil'";
						$consulta2 = mysql_query ($instruccion2, $conexion)
        					 or die ("Fallo en la consultass32b"); 
						$resultado2=mysql_fetch_array($consulta2);
						$cliente=$resultado2['id_cliente'];
						$instruccion3="insert into clientecursos (id_curso,id_cliente) values ('$cursol','$cliente')";
						$consulta3 = mysql_query ($instruccion3, $conexion)
        					 or die ("Fallo en la consultass32c");
         				mysql_close ($conexion);
						$emaill=cambiaf_a_normal($emaill);
						$telefonol=cambiaf_a_normal($telefonol);
         			?>
   					<div class="titulomenu">¡Enorabuena ha ingresado satifactoriamente a<?php print" $nombrel";?> a Clientes!</div>
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
   							<td>Apellido:</td>
   							<td><?php print("$apellidol")?></td>
   						</tr>
   						<tr>
   							<td>DNI:</td>
   							<td><?php print("$dnil")?></td>
   						</tr>
						<tr>
   							<td> ID Curso:</td>
   							<td><?php print("$cursol")?></td>
   						</tr>
   					</table>
   					<br/>
   					</div>
   					<div class="preguntalogin">Haz clik <a href="clientes.php">aquí</a> para volver a la agenda</div>
      				<?php
   				}
   				else
   				{
			?>
      			
						<div class="titulomenu">Agregar Clientes > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
						Cumplimenta este formulario para agregar a un Cliente
							<form ACTION="nuevousuario2clientes.php" METHOD="POST">
						<br/>
						<fieldset class="formulariol">
								Nombre *:<input type="text"  name="nombrel"></input>
								<?php if ($error[nombrel]!="")
									print("<span class='error'>$error[nombrel]</span>");
								?>
							<br/>
							<br/>
								Apellido *:<input type="text"  name="apellidol"></input>
								<?php if ($error[apellidol]!="")
									print("<span class='error'>$error[apellidol]</span>");
								?>
							<br/>
							<br/>
								DNI *:<input type="text"  name="dnil"></input>
								<?php if ($error[dnil]!="")
									print("<span class='error'>$error[dnil]</span>");
								?>
							<br/>
							<br/>
								ID Curso *:<input type="text"  name="cursol"></input>
								<?php if ($error[cursol]!="")
									print("<span class='error'>$error[cursol]</span>");
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