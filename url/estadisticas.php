<?php
//@Norberto López
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
	// Conectar con el servidor de base de datos.
	$conexion = mysql_connect ($db_host, $db_user, $db_password)
		or die ("No se puede conectar con el servidor");

	// Seleccionar base de datos.
	mysql_select_db ("thesurfclub")
		or die ("No se puede seleccionar la base de datos");
		
	$instruccion2 = "select * from monitores" ;
	$consulta2 = mysql_query ($instruccion2, $conexion)
        	or die ("Fallo en la consulta2");        					
    $monitores = mysql_num_rows ($consulta2);
	
	$instruccion3 = "select * from clientes" ;
	$consulta3 = mysql_query ($instruccion3, $conexion)
        	or die ("Fallo en la consulta22");        					
    $clientes = mysql_num_rows ($consulta3);
	
	$instruccion4 = "select * from usuarios where tipo='gestor'" ;
	$consulta4 = mysql_query ($instruccion4, $conexion)
        	or die ("Fallo en la consulta222");        					
    $gestores = mysql_num_rows ($consulta4);
	
	$instruccion5 = "select * from usuarios where tipo='admin'" ;
	$consulta5 = mysql_query ($instruccion5, $conexion)
        	or die ("Fallo en la consulta2222");        					
    $administradores = mysql_num_rows ($consulta5);
	
	$instruccion6 = "select sum(costo_curso) from cursos" ;
	$consulta6 = mysql_query ($instruccion6, $conexion)
        	or die ("Fallo en la consulta2222");     
	$resultado6 = mysql_fetch_array ($consulta6);
	$cursos=$resultado6['sum(costo_curso)'];
	
	$instruccion7 = "select sum(costo_alquiler) from alquiler" ;
	$consulta7 = mysql_query ($instruccion7, $conexion)
        	or die ("Fallo en la consulta2222");    
	$resultado7 = mysql_fetch_array ($consulta7);
	$material=$resultado7['sum(costo_alquiler)'];
	mysql_close ($conexion);
	
?>
						<div class="titulomenu">Estadisticas > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
							Estadisticas
							<div class="esta1">
								Ingresos.
								<br/>
								<br/>
								<img src="estadisticas-a.php?cursos=<?PHP print"$cursos"?>&material=<?PHP print"$material"?>" border="0"></img>
							</div>
							<div class="esta2">
								Número de personal.
								<br/>
								<br/>
								<img src="estadisticas-b.php?clientes=<?PHP print"$clientes"?>&monitores=<?PHP print"$monitores"?>&gestores=<?PHP print"$gestores"?>&administradores=<?PHP print"$administradores"?>" border="0"></img>
							</div>
						</div>				
<?php 
}

	include("pie.php");
?>