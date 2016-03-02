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
	$usuario=$_SESSION['usuario'];

	
?>
	<div class="titulomenu">Playas > 
        <h6>Aqui encontraras el listado de nuestras playas donde haremos la practica de las distintas</h6>
        <form action="nuevousuario2playas.php" METHOD="POST">Listado de playas de The Surf Club <span style="text-align:right;"><input type="submit" value="Añadir Playa"></span></form>

</div><div class="imagentitulo"></div> 
	<div class="cuerpomenu">
		<?PHP
			//Empezamos la paginación.
			$num=4;
			
           			if(isset($_REQUEST['comienzo'])){				
 	$comienzo=$_REQUEST['comienzo']; 
            }
    
			if(!isset($comienzo)) 
				$comienzo=0;
			
			$conexion = mysql_connect ($db_host, $db_user, $db_password)
				or die ("No se puede conectar con el servidor");

			// Seleccionar base de datos.
			mysql_select_db ($db_name)
				or die ("No se puede seleccionar la base de datos");
				
			//Si no se ha pulsado buscar.
			$instruccion = "select * from playas LIMIT $comienzo,$num" ;
			$instruccion2 = "select * from playas";
	
										
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
					print "<a class='botompag' href='" . "playas.php" . "?comienzo=" . ($comienzo - $num) . "'><img src='../img/botonanterior.jpg' width='50' border='0'></img></a>";
				}
								
				if(($comienzo+$num)<$nfilas_t)
				{
					print "<a class='botompag' href='" . "playas.php" . "?comienzo=" . ($comienzo + $num) . "'><img src='../img/botonsiguiente.jpg' width='50' border='0'></img></a>";
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
			print ("<TH>Longitud</TH>\n");
			print ("<TH>Número de Cursos</TH>\n");
            print ("<TH>Ver Detalles</TH>\n");
			print ("<TH>Actualizar</TH>\n");
         	print ("<TH>Borrar</TH>\n");
         	print ("</TR>\n");

        	for ($i=0; $i<$nfilas; $i++)
         	{
				
				
            
				$resultado = mysql_fetch_array ($consulta);
				$idal=$resultado['id_playa'];
				$instruccionp = "SELECT count(id_curso) from cursos where id_playa='$idal'";
				$consultap = mysql_query ($instruccionp, $conexion)
					or die ("Fallo en la consulta1as");
				$resultadop = mysql_fetch_array ($consultap);
            	$diafa=$resultadop['count(id_curso)'];
           		print ("<TR>\n");
           		print ("<TD>" . $resultado['nombre_playa'] . "</TD>\n");
            	print ("<TD>" . $resultado['longitud_playa'] . "</TD>\n");
				print ("<TD> $diafa </TD>\n");
                print ("<TD><a href='verdetallesplayas.php?id=" . $resultado['id_playa'] . "'><center><img src='../img/iconodetalles.jpg' border='0'></img></center></a></TD>\n");
				print ("<TD><a href='actualizarplaya.php?id=" . $resultado['id_playa'] . "'><center><img src='../img/iconodetalles.jpg' border='0'></img></center></a></TD>\n");
           		print ("<TD><a href='borrarplaya.php?id=" . $resultado['id_playa'] . "'><center><img src='../img/iconoborrar.jpg' border='0'></img></center></a></TD>\n");
            	print ("</TR>\n");
        	}

         		print ("</TABLE></center>\n");
				
				
		}
      	
   			
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