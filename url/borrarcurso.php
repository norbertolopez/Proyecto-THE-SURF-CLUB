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
		$instruccion = "select * from cursos where id_curso='$id'" ;
		$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta");        					
         $resultado = mysql_fetch_array ($consulta);
?>
					
   		<div class="titulomenu">¿Desea borrar a <?php print "$resultado[nombre_curso]?"?> </div>
   		<div class="cuerpomenu">
   		<table  border="0">
   			   			<tr>
   							<td>Nombre Curso:</td>
   							<td><?php print("$resultado[nombre_curso]")?></td>
   						</tr>
   						<tr>
   							<td>Deporte:</td>
   							<td><?php print("$resultado[deporte]")?></td>
   						</tr>
                        <tr>
   							<td>Duracion Curso:</td>
   							<td><?php print("$resultado[fecha_inicio_cursos]")?></td>
   						</tr>
                        <tr>
   							<td>Fecha Inicio:</td>
   							<td><?php print("$resultado[fecha_inicio_cursos]")?></td>
   						</tr>
                        <tr>
   							<td>Fecha Fin:</td>
   							<td><?php print("$resultado[fecha_fin_curso]")?></td>
   						</tr>
                        <tr>
   							<td>Costo:</td>
   							<td><?php print("$resultado[costo_curso]")?></td>
   						</tr>
   						
						
						</ul>
						</TD>
						</tr>   				
   						

   		</table>
   		<br/>
   		</div>
   		<center><div class="botomborrar">Borrar a <?php print"$resultado[nombre_curso]"?></div><br/><?php print"<a href='borradocurso.php?id=" . $resultado['id_curso'] . "'><img src='../img/delete.gif' border='0'></img></a>";?></center>
   		<br/>
   		<br/>
   		<div class="preguntalogin">Haz clik <a href="cursos.php">aquí</a> para volver a la agenda</div>
<?PHP
	}
	include("pie.php");
?>