<?php
session_start();
?>

<?php

include_once("./db_configuration.php");
include("encabezado.php");

?>
<html>
	<head>
		<title>THE SURF CLUB</title>
		<LINK REL="stylesheet" TYPE="text/css" HREF="css/estilos.css" >
	</head>
	<body>
		<center>
		
			<div class="pagina">
				<div class="log">
					
					<?php 
					//Aquí mostramos al usuario, o la opción de loguear, o la de cerrar sesión si ya esta logueado
					
					if (isset($_SESSION['usuario']))
					{
						$usuario=$_SESSION['usuario'];
					?>
						¡Bienvenido <?php print "$usuario";?>!
						<a href="url/cerrarsesion.php">Cerrar Sessión</a>
					<?php 
					}
					else
					{
						print"<a href='url/iniciosesion.php'>Iniciar Sessión</a>";
					}
					?>
					
				</div>
				<div class="cabezera">
					<img src="img/cabezera.jpg"></img>
				</div>
				<div class="clearl">
				</div>
				<div class="clearr">
				</div>
				<div class="localizacion">
				</div>
				<hr color="#2EFE64"></hr>
				
				<div class="menu">
					<div class="menutitulo">
						Acceso General
					</div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/inicio.php">Inicio</a></div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/actividades.php">Actividades</a></div>
							<?php
							if (!isset($_SESSION['usuario']))
							{
							 ?>
								<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/iniciosesion.php">Inicio de Sesion</a></div>
							<?php
							 }
							?>
							<div class="clearl">
					</div>
					<div class="clearr">
					</div>
					<div style="height:20px"></div>
					<?php
					if (isset($_SESSION['usuario']))
					{
					?>
					<div class="menutitulo">
						Acceso Privado
					</div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/monitores.php">Monitores</a></div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/playas.php">Playas</a></div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/clientes.php">Clientes</a></div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/cursos.php">Cursos</a></div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/contratacion.php">Contratación</a></div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/material.php">Material</a></div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/alquiler.php">Alquiler</a></div>
							
							<?php
							// Conectar con el servidor de base de datos.
							$conexion = mysql_connect ("localhost", "root", "")
								 or die ("No se puede conectar con el servidor");

							// Seleccionar base de datos.
							mysql_select_db ("thesurfclub")
								or die ("No se puede seleccionar la base de datos");

							//Encriptamos la contraseña.
							$usuariol=$_SESSION['usuario'];
							
							// Enviar consulta para saber si dicho usuario y clave estan en la base de datos.
							$instruccion = "select * from usuarios where usuario='$usuariol'";
							$consulta = mysql_query ($instruccion, $conexion)
								or die ("Fallo en la consulta");
							$resultado = mysql_fetch_array ($consulta);
							if ($resultado['tipo']=="admin")
							{
							?>
								<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/nuevousuario.php">Altas de Usuarios</a></div>
							<?php
							}
							else
							{
							?>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/perfil.php">Editar Perfil</a></div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/eliminarusuario.php">Borrar Perfil</a></div>
							<?PHP
								}
							?>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="url/cerrarsesion.php">Salir</a></div>
					<?php
					}
					?>
					<div class="clearl">
					</div>
					<div class="clearr">
					</div>
					<div style="height:20px"></div>
					<div class="menutitulo">
						Patrocinadores
					</div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="http://www.ripcurl.com"><img src="img/tuenti.jpg" width="33"></img>&nbsp Rip Curl</a></div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="http://www.billabong.com"><img src="img/twitter.jpg" width="33"></img>&nbsp Billabong</a></div>
							<div class="botonmenu"><img src="img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="http://www.quiksilver.com"><img src="img/facebook.jpg" width="33"></img>&nbsp Quiksilver</a></div>
<?php include("./url/cambiar_color_tema.php"); ?>
					<div class="clearl">
					</div>
				</div>
				
				<div class="contenido">
					<div class="inicio">
						Bienvenidos a <span style="font-size:24px">THE SURF CLUB</span>
						<img src="img/inicio1.jpg" height="300px" width="300px"></img>
						<div class="preguntalogin">
							¡Únete al mayor SURF CAMP del mundo!
						</div>
					</div>	
				</div>
				</div>
				<div class="clearl">
				</div>
				<div class="clearr">
				</div>
				<div class="pie2">Web Creada y Diseñada por Norberto López</div>
		</center>
	</body>
</html>