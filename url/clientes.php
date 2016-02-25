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
	$usuario=$_SESSION['usuario'];
	
	
?>
	<div class="titulomenu">Clientes > </div><div class="imagentitulo"></div> 
	<div class="cuerpomenu">
		<form action="nuevousuario2clientes.php" METHOD="POST">Listado de Clientes de The Surf Club <span style="text-align:right;"><input type="submit" value="Añadir Cliente"></span></form>
		
							
<?php 
		// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ("localhost", "root", "")
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
			mysql_select_db ("thesurfclub")
			or die ("No se puede seleccionar la base de datos");
									
		$usuario2=$_SESSION['usuario'];
		/*$imgagen2=$nombreFichero; */
								
		//Empezamos la paginación.
		$num=4;
					if(isset($_REQUEST['comienzo'])){				
 	$comienzo=$_REQUEST['comienzo']; 
            }
		if(!isset($comienzo)) 
			$comienzo=0;
									
		//Para la paginación vamos a realizar dos consultas, una para ver el total y otra para limitarlas.
								
		//Comprobamos si se le ha dado a buscar
		if (isset($buscar))
		{
			//Si se le ha dado a buscar y en la busqueda a introducido una actividad.
			if($usuario3=="" && $actividad!="")
			{
				$instruccion = "select * from clientes where apellidos_cliente='$actividad' LIMIT $comienzo,$num" ;
				$instruccion2 = "select * from clientes where apellidos_cliente='$actividad'";
			}
									
			//Si se le ha dado a buscar y en la busqueda a introducido un usuario.
			if($usuario3!="" && $actividad=="")
			{
				$instruccion = "select * from clientes where nombre_cliente='$usuario3' LIMIT $comienzo,$num" ;
				$instruccion2 = "select * from clientes where nombre_cliente='$usuario3'";
			}
									
			//Si se le ha dado a buscar y en la busqueda a introducido un usuario y teléfono.
			if($usuario3!="" && $actividad!="")
			{
				$instruccion = "select * from clientes where nombre_cliente='$usuario3' and apellidos_cliente='$actividad' LIMIT $comienzo,$num" ;
				$instruccion2 = "select * from clientes where nombre_cliente='$usuario3' and apellidos_cliente='$actividad'";
			}
									
			//Si no se ha introduccido nada y se ha pulsado buscar.
			if($usuario3=="" && $actividad=="")
			{
				$instruccion = "select * from clientes LIMIT $comienzo,$num" ;
				$instruccion2 = "select * from clientes";
			}
									
		}
		else
		{		
			//Si no se ha pulsado buscar.
			$instruccion = "select * from clientes LIMIT $comienzo,$num" ;
			$instruccion2 = "select * from clientes";
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
					print "<a class='botompag' href='" . "clientes.php" . "?comienzo=" . ($comienzo - $num) . "'><img src='../img/botonanterior.jpg' width='50' border='0'></img></a>";
				}
								
				if(($comienzo+$num)<$nfilas_t)
				{
					print "<a class='botompag' href='" . "clientes.php" . "?comienzo=" . ($comienzo + $num) . "'><img src='../img/botonsiguiente.jpg' width='50' border='0'></img></a>";
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
			print ("<TH>Apellido</TH>\n");
         	print ("</TR>\n");

        	for ($i=0; $i<$nfilas; $i++)
         	{
            	$resultado = mysql_fetch_array ($consulta);
           		print ("<TR>\n");
           		print ("<TD>" . $resultado['nombre_cliente'] . "</TD>\n");
            	print ("<TD>" . $resultado['apellidos_cliente'] . "</TD>\n");
            	print ("</TR>\n");
        	}

         		print ("</TABLE></center>\n");
				
				
		}
      	else
         	print ("No hay Clientes, con las caracteristicas introducidas");
   			
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
			