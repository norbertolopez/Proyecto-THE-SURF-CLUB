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
	?>
	<div class="titulomenu">¡Bienvenido <?php print "$usuario";?>! > </div><div class="imagentitulo"></div> 
	<div class="cuerpomenu">
		¡Bienvenido a The Surf Club <?php print "$usuario";?>!, Tu web sobre el mejor centro de aprendizaje y especificacion al surf.
		<br/>
		<br/>
		Ahora ya podrá acceder al menú de aceso privado.
		<br/>
		<br/>
		Esperamos que su visita sea de lo mas agradable.
        
        <br>
        
        <img src="../img/foca.gif" height="170px" width="310px"></img>
        
	</div>	
	<?PHP
	}
		include("pie.php");
	?>