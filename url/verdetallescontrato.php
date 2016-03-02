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
        				$id=$_REQUEST['id'];
        		
   						// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ($db_host, $db_user, $db_password)
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ($db_name)
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
						
						
   						// Enviar consulta para selecionar los detalles de la id pasados por URL.
   						$sesion2=$_SESSION['usuario'];
						$instruccion = "select * from contrato where id_contrato='$id'" ;
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consulta");        						
         				$resultado = mysql_fetch_array ($consulta);
   					?>
					
   					<div class="titulomenu">Detalles del contrato Nº <?php print "$resultado[id_contrato]"?> ></div>
   					<div class="cuerpomenu">
   					<table border="0">
   						
   						<tr>
   							<td>Id Contrato:</td>
   							<td><?php print("$resultado[id_contrato]")?></td>
   						</tr>
   						<tr>
   							<td>Id Monitor:</td>
   							<td><?php print("$resultado[id_monitor]")?></td>
   						</tr>
   						<tr>
   							<td>Duracion Contrato:</td>
   							<td><?php print("$resultado[duracion_contrato]")?></td>
   						</tr>
   						<tr>
   							<td>Costo contrato:</td>
   							<td><?php print("$resultado[costo_contrato]")?></td>
   						</tr>
   						<tr>
   							<td>Fecha Inicio:</td>
   							<td><?php print("$resultado[fecha_inicio_contrato]")?></td>
   						</tr>
   						<tr>
   							<td>Fecha Fin:</td>
   							<td><?php print("$resultado[fecha_fin_contrato]")?></td>
   						</tr>
						<?PHP
						$instruccion2 = "select * from contrato where id_contrato='$id'" ;
						$consulta2 = mysql_query ($instruccion2, $conexion)
        					 or die ("Fallo en la consulta22");        					
         				
						$nfilas2 = mysql_num_rows ($consulta2);
						mysql_close ($conexion);
						if ($nfilas2 > 0)
						{
							print "<tr>";
							
							print"<TD><ul>";
							for ($i=0; $i<$nfilas2; $i++)
							{
								
							}
						}
						?>
						</ul>
						</TD>
						</tr>   				
   					
   					</table>
   					<br/>
   					</div>
					<?PHP
					
					$_SESSION['consulta1']=$instruccion;
					$_SESSION['consulta2']=$instruccion2;
					$_SESSION['pag']="verdetalles";
					?>
					
   					<div class="preguntalogin">Haz clik <a href="contratacion.php">aquí</a> para volver a la agenda</div>
<?PHP
}
	include("pie.php");
?>