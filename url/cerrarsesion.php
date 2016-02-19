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
	<div class="titulomenu">Salir > </div><div class="imagentitulo"></div> 
	<div class="cuerpomenu">
		¡Ha salido de The Surf Club, esperamos volver a verle pronto!
		<br/>
		<br/>
		<img src="../img/salir12.gif" height="150px" width="150px"></img>
		<br/>
		<br/>
		<center><i>Será redireccionado a la página de inicio.</i></center>
<?php 
		//Con esta instrucción cerramos sesión(destruimos).
		session_destroy ();	
		//Con este meta, redirecionamos a la pagina index.php
		echo "<META HTTP-EQUIV='refresh' CONTENT='5; URL=../index.php'>";
?>
	</div>				
<?PHP
}
include("pie.php");
?>