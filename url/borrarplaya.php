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
		//Rescatamos el ID, que le hemos pasado por URL.
		$id=$_REQUEST['id'];
						
		// Conectar con el servidor de base de datos
      	$conexion = mysql_connect ($db_host, $db_user, $db_password)
         or die ("No se puede conectar con el servidor");

   		// Seleccionar base de datos
     	mysql_select_db ($db_name)
         	or die ("No se puede seleccionar la base de datos");
							
		$usuario2=$_SESSION['usuario'];
        if (isset($nombreFichero)){
		$imgagen2=$nombreFichero;
            }
						
   		// Enviar consulta que nos saque toda la información de la tabla agenda del usuario logueado 
		//cuyo id sea al id pasado por url
   		$sesion2=$_SESSION['usuario'];
		$instruccion = "select * from playas where id_playa='$id'" ;
		$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta");        					
         $resultado = mysql_fetch_array ($consulta);
?>
					
   		<div class="titulomenu">¿Desea borrar a <?php print "$resultado[nombre_playa]?"?> </div>
   		<div class="cuerpomenu">
   		<table  border="0">
   			   			<tr>
   							<td>Nombre:</td>
   							<td><?php print("$resultado[nombre_playa]")?></td>
   						</tr>
   						<tr>
   							<td>Longitud:</td>
   							<td><?php print("$resultado[longitud_playa]")?></td>
   						</tr>
   						
						
						</ul>
						</TD>
						</tr>   				
   						

   		</table>
   		<br/>
   		</div>
   		<center><div class="botomborrar">Borrar a <?php print"$resultado[nombre_playa]"?></div><br/><?php print"<a href='borradoplayas.php?id=" . $resultado['id_playa'] . "'><img src='../img/delete.gif' border='0'></img></a>";?></center>
   		<br/>
   		<br/>
   		<div class="preguntalogin">Haz clik <a href="playas.php">aquí</a> para volver a la agenda</div>
<?PHP
	}
	include("pie.php");
?>