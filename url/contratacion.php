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
	$usuario=$_SESSION['usuario'];
		
	
?>
	<div class="titulomenu">Contratación > </div><div class="imagentitulo"></div> 
	<div class="cuerpomenu">
		<form action="nuevousuario2contratacion.php" METHOD="POST">Listado de Contratación de The Surf Club <span style="text-align:right;"><input type="submit" value="Añadir Contrato"></span></form>
		
							
<?php 
		// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ("localhost", "root", "")
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
			mysql_select_db ("thesurfclub")
			or die ("No se puede seleccionar la base de datos");
									
		$usuario2=$_SESSION['usuario'];
	
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
									
			//Si se le ha dado a buscar y en la busqueda a introducido un usuario.
			if($usuario3!="")
			{
				$instruccion = "select * from contrato where fecha_fin_contrato >'$usuario4' LIMIT $comienzo,$num" ;
				$instruccion2 = "select * from contrato where fecha_fin_contrato >'$usuario4'";
			}
									
									
			//Si no se ha introduccido nada y se ha pulsado buscar.
			if($usuario3=="")
			{
				$instruccion = "select * from contrato LIMIT $comienzo,$num" ;
				$instruccion2 = "select * from contrato";
			}
									
		}
		else
		{		
			//Si no se ha pulsado buscar.
			$instruccion = "select * from contrato LIMIT $comienzo,$num" ;
			$instruccion2 = "select * from contrato";
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
					print "<a class='botompag' href='" . "contratacion.php" . "?comienzo=" . ($comienzo - $num) . "'><img src='../img/botonanterior.jpg' width='50' border='0'></img></a>";
				}
								
				if(($comienzo+$num)<$nfilas_t)
				{
					print "<a class='botompag' href='" . "contratacion.php" . "?comienzo=" . ($comienzo + $num) . "'><img src='../img/botonsiguiente.jpg' width='50' border='0'></img></a>";
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
         	print ("<TH>Nombre Monitor</TH>\n");
			print ("<TH>Duración de Contrato</TH>\n");
			print ("<TH>Fecha Fin</TH>\n");
         	print ("</TR>\n");
			
			

        	for ($i=0; $i<$nfilas; $i++)
         	{
				$resultado = mysql_fetch_array ($consulta);
				$idal=$resultado['id_monitor'];
				$instruccionp = "select nombre_monitor from monitores where id_monitor='$idal'";
				$consultap = mysql_query ($instruccionp, $conexion)
					or die ("Fallo en la consulta1as");
				$resultadop = mysql_fetch_array ($consultap);
            	$diafa=$resultado['fecha_fin_contrato'];
				$diafa=cambiaf_a_normal($diafa);
           		print ("<TR>\n");
           		print ("<TD>" . $resultadop['nombre_monitor'] . "</TD>\n");
				print ("<TD>" . $resultado['duracion_contrato'] . " horas</TD>\n");
				print ("<TD> $diafa </TD>\n");
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