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
      					$conexion = mysql_connect ($db_host, $db_user, $db_password)
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ($db_name)
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
						$instruccion = "insert into clientes (nombre_cliente,apellidos_cliente,dni_cliente) values ('".$_REQUEST['nombrel']."','".$_REQUEST['apellidol']."','".$_REQUEST['dnil']."')";
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consultass32a");  
						$instruccion2="select id_cliente from clientes where dni_cliente='".$_REQUEST['dnil']."'";
						$consulta2 = mysql_query ($instruccion2, $conexion)
        					 or die ("Fallo en la consultass32b"); 
						$resultado2=mysql_fetch_array($consulta2);
						$cliente=$resultado2['id_cliente'];
						$instruccion3="insert into clientecursos (id_curso,id_cliente) values ('".$_REQUEST['cursol']."','$cliente')";
						$consulta3 = mysql_query ($instruccion3, $conexion)
        					 or die ("Fallo en la consultass32c");
         				mysql_close ($conexion);
				//		$emaill=cambiaf_a_normal($emaill);
				//		$telefonol=cambiaf_a_normal($telefonol);
         			?>
   					<div class="titulomenu">¡Enorabuena ha ingresado satifactoriamente al Cliente   !</div>
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
   							<td> ID Curso:</td>
   							<td><?php print($_REQUEST['cursol'])?></td>
   						</tr>
   					</table>
   					<br/>
   					</div>
   					<div class="preguntalogin">Haz clik <a href="clientes.php">aquí</a> para volver a la agenda</div>
      				<?php
   				}
    //si no esta definida , muestra el formulario para rellenarlo
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
								<?php
                    if (isset($error['nombrel'])) {
                    if ($error['nombrel']!="")
									print("<span class='error'>".$error[nombrel]."</span>");
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
<?php
                    echo "Curso* :<select name='cursol' required'>";
                    $connectionz = new mysqli($db_host, $db_user, $db_password, $db_name);
if ($result3=$connectionz->query("SELECT * FROM cursos;")) {
     if ($result3->num_rows===0) {
                echo "ERROR FATAL, ABORTAR MISIÓN";
              } else {
         //mientras tenga .. muestra ...
         while($obj2 = $result3->fetch_object()) {
                    echo "<option value='".$obj2->id_curso."'>".$obj2->nombre_curso."</option>";
                 }
         $result3->close();
         unset($obj2);
    }
 }
                    echo "Curso* :</select>";
?>
                    
                    

								
								<?php
                        if (isset($error['cursol'])) {
                        if ($error['cursol']!="")
									print("<span class='error'>".$error['cursol']."</span>");
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