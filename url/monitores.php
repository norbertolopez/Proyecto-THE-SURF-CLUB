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

//* $usuario3=$_REQUEST['usuario3'];
//*	$actividad=$_REQUEST['actividad'];
//*	$buscar=$_REQUEST['buscar'];
	
?>
	<div class="titulomenu">Monitores > </div><div class="imagentitulo"></div> 
	<div class="cuerpomenu">
		<form action="nuevousuario2monitores.php" METHOD="POST">Listado de Monitores de The Surf Club <span style="text-align:right;"><input type="submit" value="Añadir Monitor"></span></form>
		<form ACTION="monitores.php" METHOD="POST">
		<fieldset class="formulariol">
		<table>
			<tr>
				<td>Nombre: </td><td><input type="text" name="usuario3" size=16></td>
			</tr>
			<tr>
				<td>Cursos/Material:</td> <td><input type="text" name="actividad" size=16></td>
			</tr>
			<tr>	
				<td><input type=submit value="Buscar" name="buscar"></td>
			</tr>
		</table>
		</fieldset>
		</form>
							
<?php 
		// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ("localhost", "root", "")
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
			mysql_select_db ("thesurfclub")
			or die ("No se puede seleccionar la base de datos");
									
		$usuario2=$_SESSION['usuario'];
		//* $imgagen2=$nombreFichero;
								
		//Empezamos la paginación.
		$num=4;
								
 	$comienzo=$_REQUEST['comienzo']; 
	if(!isset($comienzo))  
			$comienzo=0;
									
		//Para la paginación vamos a realizar dos consultas, una para ver el total y otra para limitarlas.
								
		//Comprobamos si se le ha dado a buscar
		if (isset($buscar))
		{
			//Si se le ha dado a buscar y en la busqueda a introducido una actividad.
			if($usuario3=="" && $actividad!="")
			{
				$instruccion = "select * from monitores where id_monitor in (select id_monitor from cursos where deporte='$actividad' AND id_curso in (select id_curso from clientes where id_cliente in (select id_cliente from alquiler where id_material in (select id_material from material where nombre_material like '%$actividad%')))) LIMIT $comienzo,$num" ;
				$instruccion2 = "select * from monitores where id_monitor in (select id_monitor from cursos where deporte='$actividad' AND id_curso in (select id_curso from clientes where id_cliente in (select id_cliente from alquiler where id_material in (select id_material from material where nombre_material like '%$actividad%'))))";
			}
									
			//Si se le ha dado a buscar y en la busqueda a introducido un usuario.
			if($usuario3!="" && $actividad=="")
			{
				$instruccion = "select * from monitores where Nombre_Monitor='$usuario3' LIMIT $comienzo,$num" ;
				$instruccion2 = "select * from monitores where Nombre_Monitor='$usuario3'";
			}
									
			//Si se le ha dado a buscar y en la busqueda a introducido un usuario y teléfono.
			if($usuario3!="" && $actividad!="")
			{
				$instruccion = "select * from monitores where Nombre_Monitor='$usuario3' and actividad='$actividad' LIMIT $comienzo,$num" ;
				$instruccion2 = "select * from monitores where Nombre_Monitor='$usuario3' and actividad='$actividad'";
			}
									
			//Si no se ha introduccido nada y se ha pulsado buscar.
			if($usuario3=="" && $actividad=="")
			{
				$instruccion = "select * from monitores LIMIT $comienzo,$num" ;
				$instruccion2 = "select * from monitores";
			}
									
		}
		else
		{		
			//Si no se ha pulsado buscar.
			$instruccion = "select * from monitores LIMIT $comienzo,$num" ;
			$instruccion2 = "select * from monitores";
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
					print "<a class='botompag' href='" . "monitores.php" . "?comienzo=" . ($comienzo - $num) . "'><img src='../img/botonanterior.jpg' width='50' border='0'></img></a>";
				}
								
				if(($comienzo+$num)<$nfilas_t)
				{
					print "<a class='botompag' href='" . "monitores.php" . "?comienzo=" . ($comienzo + $num) . "'><img src='../img/botonsiguiente.jpg' width='50' border='0'></img></a>";
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
			print ("<TH>Actividad</TH>\n");
			print ("<TH>Número de Cursos</TH>\n");
        	print ("<TH>Ver Detalles</TH>\n");
			print ("<TH>Actualizar</TH>\n");
         	print ("<TH>Borrar</TH>\n");
         	print ("</TR>\n");

        	for ($i=0; $i<$nfilas; $i++)
         	{
            	$resultado = mysql_fetch_array ($consulta);
           		print ("<TR>\n");
           		print ("<TD>" . $resultado['nombre_monitor'] . "</TD>\n");
            	print ("<TD>" . $resultado['actividad_monitor'] . "</TD>\n");
				$resulta2=$resultado['id_monitor'];
				$instruccion4 = "select * from cursos where id_monitor='$resulta2'";									
				$consulta4 = mysql_query ($instruccion4, $conexion)
					or die ("Fallo en la consulta10");
				$nfilas4 = mysql_num_rows ($consulta4);
            	print ("<TD align='center'>$nfilas4</TD>\n");
            	print ("<TD><a href='verdetallesmonitores.php?id=" . $resultado['id_monitor'] . "'><center><img src='../img/iconodetalles.jpg' border='0'></img></center></a></TD>\n");
				print ("<TD><a href='actualizarmonitores.php?id=" . $resultado['id_monitor'] . "'><center><img src='../img/iconodetalles.jpg' border='0'></img></center></a></TD>\n");
           		print ("<TD><a href='borrarusuariomonitores.php?id=" . $resultado['id_monitor'] . "'><center><img src='../img/iconoborrar.jpg' border='0'></img></center></a></TD>\n");
           		print ("</TR>\n");
        	}

         		print ("</TABLE></center>\n");
				$_SESSION['consulta1']=$instruccion2;
				//$_SESSION['consulta2']=$usuario;
				$_SESSION['pag']="monitores";
				?>
				
				<?PHP
				
		}
      	else
         	print ("No hay Monitores disponibles, con las caracteristicas introducidas");
   			
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