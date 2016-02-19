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
		//Rescatamos el ID, que le hemos pasado por URL.
		$id=$_REQUEST['id'];
						
		// Conectar con el servidor de base de datos
      	$conexion = mysql_connect ("localhost", "root", "")
         or die ("No se puede conectar con el servidor");

   		// Seleccionar base de datos
     	mysql_select_db ("thesurfclub")
         	or die ("No se puede seleccionar la base de datos");
							
		$usuario2=$_SESSION['usuario'];
		$imgagen2=$nombreFichero;
						
   		// Enviar consulta que nos saque toda la información de la tabla agenda del usuario logueado 
		//cuyo id sea al id pasado por url
   		$sesion2=$_SESSION['usuario'];
		$instruccion = "select * from monitores where id_monitor='$id'" ;
		$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta");        					
         $resultado = mysql_fetch_array ($consulta);
?>
					
   		<div class="titulomenu">¿Desea borrar a <?php print "$resultado[nombre_monitor]?"?> ></div>
   		<div class="cuerpomenu">
   		<table  border="0">
   			   			<tr>
   							<td>Nombre:</td>
   							<td><?php print("$resultado[nombre_monitor]")?></td>
   						</tr>
   						<tr>
   							<td>Apellido:</td>
   							<td><?php print("$resultado[apellidos_monitor]")?></td>
   						</tr>
   						<tr>
   							<td>Dni:</td>
   							<td><?php print("$resultado[dni_monitor]")?></td>
   						</tr>
   						<tr>
   							<td>Actividad:</td>
   							<td><?php print("$resultado[actividad_monitor]")?></td>
   						</tr>
   						<tr>
   							<td>Teléfono:</td>
   							<td><?php print("$resultado[telefono_monitor]")?></td>
   						</tr>
   						<tr>
   							<td>Email:</td>
   							<td><?php print("$resultado[email_monitor]")?></td>
   						</tr>
						<?PHP
						$instruccion2 = "select * from cursos where id_monitor='$id'" ;
						$consulta2 = mysql_query ($instruccion2, $conexion)
        					 or die ("Fallo en la consulta22");        					
         				
						$nfilas2 = mysql_num_rows ($consulta2);
						mysql_close ($conexion);
						if ($nfilas2 > 0)
						{
							print "<tr>";
							print "<td>Cursos:</td>";
							print"<TD><ul>";
							for ($i=0; $i<$nfilas2; $i++)
							{
								$resultado2 = mysql_fetch_array ($consulta2);
								print ("<li>" . $resultado2['nombre_curso'] . "</li>\n");
							}
						}
						?>
						</ul>
						</TD>
						</tr>   				
   						<tr>
   							<td>Foto Monitor:</td>
   							<td><?php print "<img src='../img/$resultado[foto_monitor].' width='100'></img>";?></td>
   						</tr>

   		</table>
   		<br/>
   		</div>
   		<center><div class="botomborrar">Borrar a <?php print"$resultado[nombre_monitor]"?></div><br/><?php print"<a href='usuarioborradomonitores.php?id=" . $resultado['id_monitor'] . "&img=" . $resultado['foto_monitor'] . "'><img src='../img/delete.gif' border='0'></img></a>";?></center>
   		<br/>
   		<br/>
   		<div class="preguntalogin">Haz clik <a href="monitores.php">aquí</a> para volver a la agenda</div>
<?PHP
	}
	include("pie.php");
?>