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
	$usuario=$_SESSION['usuario'];
	
	
						
?>
	<div class="titulomenu">Cursos > 
<h6> Listado de Cursos de The Surf Club </h6>
        <form action="nuevousuario2cursos.php" METHOD="POST">Listado de cursos de The Surf Club <span style="text-align:right;"><input type="submit" value="Añadir Curso"></span></form>
</div><div class="imagentitulo"></div> 
	<div class="cuerpomenu">
        
		<form ACTION="cursos.php" METHOD="POST">
		
		</form>
							
<?php 
		// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ($db_host, $db_user, $db_password)
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
			mysql_select_db ($db_name)
			or die ("No se puede seleccionar la base de datos");
									
		$usuario2=$_SESSION['usuario'];
		
		/* $fecha_curso2=cambiaf_a_mysql($fecha_curso); */
								
		//Empezamos la paginación.
		$num=4;
								
					if(isset($_REQUEST['comienzo'])){				
 	$comienzo=$_REQUEST['comienzo']; 
            }
		if(!isset($comienzo)) 
			$comienzo=0;
									
		//Para la paginación vamos a realizar dos consultas, una para ver el total y otra para limitarlas.
								
		//Comprobamos si se le ha dado a buscar
		if (isset($buscar) && $error=="")
		{
			//Si se le ha dado a buscar y en la busqueda a introducido una actividad.
			if($fecha_curso != "")
			{
				
				$instruccion = "SELECT * FROM cursos WHERE  fecha_inicio_cursos <= '$fecha_curso2' AND fecha_fin_curso >= '$fecha_curso2' LIMIT $comienzo,$num";
				$instruccion2 = "SELECT * FROM cursos WHERE  fecha_inicio_cursos <= '$fecha_curso2' AND fecha_fin_curso >= '$fecha_curso2'";
			}
			else
			{
			$instruccion = "select * from cursos LIMIT $comienzo,$num" ;
			$instruccion2 = "select * from cursos";
			}
		}
		else
		{		
			//Si no se ha pulsado buscar.
			$instruccion = "select * from cursos LIMIT $comienzo,$num" ;
			$instruccion2 = "select * from cursos";
		}
												
		$consulta = mysql_query ($instruccion, $conexion)
			 or die ("Fallo en la consulta1");
		$consulta2 = mysql_query ($instruccion2, $conexion)
			 or die ("Fallo en la consulta2");

		$nfilas = mysql_num_rows ($consulta);
		$nfilas_t= mysql_num_rows ($consulta2);
?>
		<center>
<?php 
			//Vamos a "pintar los botones".
			if ($nfilas>0)
			{
				if($comienzo==0)
				{
									
					print "<span class='botompag'><img src='../img/botonanterior.jpg' width='50'></img></span> ";
				}
				else
				{
					print "<a class='botompag' href='" . "cursos.php" . "?comienzo=" . ($comienzo - $num) . "'><img src='../img/botonanterior.jpg' width='50' border='0'></img></a>";
				}
								
				if(($comienzo+$num)<$nfilas_t)
				{
					print "<a class='botompag' href='" . "cursos.php" . "?comienzo=" . ($comienzo + $num) . "'><img src='../img/botonsiguiente.jpg' width='50' border='0'></img></a>";
				}
				else
				{
					print " <span class='botompag'><img src='../img/botonsiguiente.jpg' width='50'></img></span>";
				}
			}
?>
		</center>
<?php 
        //Vamos a pintar una tabla, con los resultados de las consultas.
		if ($nfilas > 0)
    	{
         	print ("<center><TABLE class='tablediary'>\n");
         	print ("<TR>\n");
         	print ("<TH>Nombre</TH>\n");
			print ("<TH>Deporte</TH>\n");
			print ("<TH>Duración de Cursos</TH>\n");
			print ("<TH>Numero de Alumnos</TH>\n");
            print ("<TH>Ver Detalles</TH>\n");
			print ("<TH>Actualizar</TH>\n");
         	print ("<TH>Borrar</TH>\n");
         	print ("</TR>\n");

        	for ($i=0; $i<$nfilas; $i++)
         	{
            	$resultado = mysql_fetch_array ($consulta);
				$idal=$resultado['id_curso'];
				$instruccionp = "select count(id_cliente) from clientecursos where id_curso='$idal'";
				$consultap = mysql_query ($instruccionp, $conexion)
					or die ("Fallo en la consulta1as");
				$resultadop = mysql_fetch_array ($consultap);
            	$diafa=$resultadop['count(id_cliente)'];
           		print ("<TR>\n");
           		print ("<TD>" . $resultado['nombre_curso'] . "</TD>\n");
            	print ("<TD>" . $resultado['deporte'] . "</TD>\n");
            	print ("<TD>" . $resultado['duracion_cursos'] . " horas</TD>\n");
				print ("<TD> $diafa </TD>\n");
                print ("<TD><a href='verdetallescurso.php?id=" . $resultado['id_curso'] . "'><center><img src='../img/iconodetalles.jpg' border='0'></img></center></a></TD>\n");
				print ("<TD><a href='actualizarcurso.php?id=" . $resultado['id_curso'] . "'><center><img src='../img/iconodetalles.jpg' border='0'></img></center></a></TD>\n");
           		print ("<TD><a href='borrarcurso.php?id=" . $resultado['id_curso'] . "'><center><img src='../img/iconoborrar.jpg' border='0'></img></center></a></TD>\n");
            	print ("</TR>\n");
				print ("</TR>\n");
        	}

         		print ("</TABLE></center>\n");
				
				
		}
      	else
         	print ("No hay Cursos disponibles, con las caracteristicas introducidas");
   			
			//Cerramos la conexión con la base de datos.
         	mysql_close ($conexion);
         				
			//Vamos a escribir, la situación de donde nos encontramos dentro del total de resultados.
         	if ($nfilas>0)
         	{
		         if(($num+$comienzo)>$nfilas_t)
		    	{
		    		$a=$nfilas_t;
		    	}
		    	else
		    	{
		    		$a=($num+$comienzo);
		    	}
		    	print ("<div class='paginado'>Mostrando ". ($comienzo+1). " de ".$a." con un total de " .$nfilas_t ."<br><br>");
	        }	
		  	print ("</div>")
         				
?>			
	</div>				
</div>
							
<?PHP
}
include("pie.php");
?>