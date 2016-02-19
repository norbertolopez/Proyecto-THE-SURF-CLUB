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
	/* $usuario3=$_REQUEST['usuario3']; */
	/* $actividad=$_REQUEST['actividad']; */
	/* $buscar=$_REQUEST['buscar']; */
	$error="";
	if (isset($buscar))
   	{
		if ((!preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$usuario3)) && $usuario3!="")
		{
			$error["usuario3"]="Fecha introducida incorrecta";
		}
		
		if ((!preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$actividad)) && $actividad!="")
		{
			$error["actividad"]="Fecha introducida incorrecta";
		}
	}
	
?>
	<div class="titulomenu">Alquiler > </div><div class="imagentitulo"></div> 
	<div class="cuerpomenu">
		<form action="nuevousuario2alquiler.php" METHOD="POST">Listado de Alquiler de The Surf Club <span style="text-align:right;"><input type="submit" value="Añadir Alquiler"></span></form>
		
							
<?php 
		// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ("localhost", "root", "")
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
			mysql_select_db ("thesurfclub")
			or die ("No se puede seleccionar la base de datos");
									
		$usuario2=$_SESSION['usuario'];
		/* $imgagen2=$nombreFichero; */
								
		//Empezamos la paginación.
		$num=4;
								
		$comienzo=$_REQUEST['comienzo'];
		if(!isset($comienzo)) 
			$comienzo=0;
									
		//Para la paginación vamos a realizar dos consultas, una para ver el total y otra para limitarlas.
		/* $usuario4=cambiaf_a_mysql($usuario3); */
		/* $actividad2=cambiaf_a_mysql($actividad); */
		//Comprobamos si se le ha dado a buscar
		if (isset($buscar) && $error=="")
		{
			//Si se le ha dado a buscar y en la busqueda a introducido una actividad.
			if($usuario3=="" && $actividad!="")
			{
				$instruccion = "SELECT id_alquiler,id_cliente,id_material,duracion_alquiler,costo_alquiler,fecha_inicio_alquiler,fecha_fin_alquiler, sum(costo_alquiler) FROM alquiler WHERE fecha_inicio_alquiler <= '$actividad2' AND fecha_fin_alquiler >= '$actividad2' LIMIT $comienzo,$num" ;
				$instruccion2 = "SELECT id_alquiler,id_cliente,id_material,duracion_alquiler,costo_alquiler,fecha_inicio_alquiler,fecha_fin_alquiler, sum(costo_alquiler) FROM alquiler WHERE fecha_inicio_alquiler <= '$actividad2' AND fecha_fin_alquiler >= '$actividad2' ";
				
			}
									
			//Si se le ha dado a buscar y en la busqueda a introducido un usuario.
			if($usuario3!="" && $actividad=="")
			{
				$instruccion = "SELECT id_alquiler,id_cliente,id_material,duracion_alquiler,costo_alquiler,fecha_inicio_alquiler,fecha_fin_alquiler FROM alquiler WHERE fecha_inicio_alquiler <= '$usuario4' AND fecha_fin_alquiler >= '$usuario4' LIMIT $comienzo,$num" ;
				$instruccion2 = "SELECT id_alquiler,id_cliente,id_material,duracion_alquiler,costo_alquiler,fecha_inicio_alquiler,fecha_fin_alquiler FROM alquiler WHERE fecha_inicio_alquiler <= '$usuario4' AND fecha_fin_alquiler >= '$usuario4'";
			}
									
			//Si se le ha dado a buscar y en la busqueda a introducido un usuario y teléfono.
			if($usuario3!="" && $actividad!="")
			{
				$instruccion = "SELECT material.id_material, nombre_material, sum(costo_alquiler) FROM material, alquiler LIMIT $comienzo,$num" ;
				$instruccion2 = "SELECT material.id_material, nombre_material, sum(costo_alquiler) FROM material, alquiler";;
			}
									
			//Si no se ha introduccido nada y se ha pulsado buscar.
			if($usuario3=="" && $actividad=="")
			{
				$instruccion = "SELECT id_alquiler,id_cliente,id_material,duracion_alquiler,costo_alquiler,fecha_inicio_alquiler,fecha_fin_alquiler FROM alquiler LIMIT $comienzo,$num" ;
				$instruccion2 = "SELECT id_alquiler,id_cliente,id_material,duracion_alquiler,costo_alquiler,fecha_inicio_alquiler,fecha_fin_alquiler FROM alquiler";
			}
									
		}
		else
		{		
			//Si no se ha pulsado buscar.
			$instruccion = "SELECT id_alquiler,id_cliente,id_material,duracion_alquiler,costo_alquiler,fecha_inicio_alquiler,fecha_fin_alquiler FROM alquiler LIMIT $comienzo,$num" ;
			$instruccion2 = "SELECT id_alquiler,id_cliente,id_material,duracion_alquiler,costo_alquiler,fecha_inicio_alquiler,fecha_fin_alquiler FROM alquiler";
			
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
					print "<a class='botompag' href='" . "alquiler.php" . "?comienzo=" . ($comienzo - $num) . "'><img src='../img/botonanterior.jpg' width='50' border='0'></img></a>";
				}
								
				if(($comienzo+$num)<$nfilas_t)
				{
					print "<a class='botompag' href='" . "alquiler.php" . "?comienzo=" . ($comienzo + $num) . "'><img src='../img/botonsiguiente.jpg' width='50' border='0'></img></a>";
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
         	print ("<TH>Nombre Material</TH>\n");
			print ("<TH>Nombre Cliente</TH>\n");
			print ("<TH>Fecha Fin</TH>\n");
			if (isset($buscar) && ($usuario3!="" || $actividad!=""))
				print ("<TH>Ingresos</TH>\n");
         	print ("</TR>\n");
			
			

        	for ($i=0; $i<$nfilas; $i++)
         	{
				$resultado = mysql_fetch_array ($consulta);
				$idal=$resultado['id_material'];
				$idal2=$resultado['id_cliente'];
				
				if (isset($buscar))
				{
					//Si se le ha dado a buscar y en la busqueda a introducido una actividad.
					if($usuario3=="" && $actividad!="")
					{
						$instruccionp = "select nombre_material, modelo_material, tipo_material, sum(costo_alquiler) from material,alquiler  where material.id_material='$idal' GROUP BY modelo_material";
					}
											
					//Si se le ha dado a buscar y en la busqueda a introducido un usuario.
					if($usuario3!="" && $actividad=="")
					{
						$instruccionp = "select nombre_material, modelo_material, tipo_material, sum(costo_alquiler) from material,alquiler  where material.id_material='$idal' GROUP BY tipo_material";
					}
											
					//Si se le ha dado a buscar y en la busqueda a introducido un usuario y teléfono.
					if($usuario3!="" && $actividad!="")
					{
						$instruccionp = "select nombre_material, modelo_material, tipo_material from material where id_material='$idal'";
					}
											
					//Si no se ha introduccido nada y se ha pulsado buscar.
					if($usuario3=="" && $actividad=="")
					{
						$instruccionp = "select nombre_material, modelo_material, tipo_material from material where id_material='$idal'";
					}
											
				}
				else
				{		
					$instruccionp = "select nombre_material, modelo_material, tipo_material from material where id_material='$idal'";	
				}
				
				$instruccionp2 = "select nombre_cliente from clientes where id_cliente='$idal2'";
				$consultap = mysql_query ($instruccionp, $conexion)
					or die ("Fallo en la consulta1as");
				$consultap2 = mysql_query ($instruccionp2, $conexion)
					or die ("Fallo en la consulta1sa");
				$resultadop = mysql_fetch_array ($consultap);
				$resultadop2 = mysql_fetch_array ($consultap2);
            	$diafa=$resultado['fecha_fin_alquiler'];
				$diafa=cambiaf_a_normal($diafa);
           		print ("<TR>\n");
           		print ("<TD>" . $resultadop['nombre_material'] . "</TD>\n");
            	print ("<TD>" . $resultadop2['nombre_cliente'] . "</TD>\n");
				print ("<TD> $diafa </TD>\n");
				if (isset($buscar) && ($usuario3!="" || $actividad!=""))
					print ("<TD>" . $resultadop['sum(costo_alquiler)'] . "</TD>\n");
            	print ("</TR>\n");
        	}

         		print ("</TABLE></center>\n");
				$_SESSION['consulta1']=$instruccion;
				$_SESSION['consulta2']=$instruccionp;
				$_SESSION['pag']="alquiler";
				?>
				
				<?PHP
		}
      	else
         	print ("No hay Alquiler, con las caracteristicas introducidas");
   			
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