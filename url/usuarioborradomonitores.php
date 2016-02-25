<?php

session_start();
include("encabezado.php");
print "<LINK REL='stylesheet' TYPE='text/css' HREF='../css/estilos.css'>";
$id=$_REQUEST['id'];
$img=$_REQUEST['img'];

   						// Conectar con el servidor de base de datos.
      					$conexion = mysql_connect ("localhost", "root", "")
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos.
     					mysql_select_db ("thesurfclub")
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
                        if (isset($nombreFichero)){
						$imgagen2=$nombreFichero;
                        }
						
   						// Enviar consulta que borre el usuario pasado por url.
   						$sesion2=$_SESSION['usuario'];
						$instruccion = "delete from monitores where id_monitor='". $id . "'";
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consulta");
							 
						//Vamos a borrar el fichero fisico que tambien le hemos pasado por URL.
            			$nombreFichero = "../img/" . $img;
            			unlink ($nombreFichero);
         				mysql_close ($conexion);	
        
   					?>
   					<div class="titulomenu">Monitor Borrado ></div>
   					<div class="cuerpomenu">
   						El Monitor ha sido borrado satisfactoriamente.
   						<?php echo "<META HTTP-EQUIV='refresh' CONTENT='5; URL=monitores.php'>";?>
   					<div class="preguntalogin">Será redireccionado a Monitores en 5 segundos.</div>
   					</div>
<?PHP
	include("pie.php");
?>