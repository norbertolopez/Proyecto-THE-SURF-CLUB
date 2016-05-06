<?php
include_once("db_configuration.php");
//session_start(); 
//include('databaseConnection.php');
?>
<html LANG="es">
	<head>
		<title>The Surf Club</title>
		<LINK REL="stylesheet" TYPE="text/css" HREF="../css/estilos.css" charset="UTF-8">
	</head>
	<body>
		<center>
		
			<div class="pagina">
				
				<div class="log">
					<div style="text-align:left;float:left; padding-left:10px;"><?php $dia=date("j");
													  $mes=date("n");
													  $ano=date("y");
													  print "Hoy es $dia del $mes de 20$ano";?></div>
					<?php 
					//Aquí mostramos al usuario, o la opción de loguear, o la de cerrar sesión si ya esta logueado
					
					if (isset($_SESSION['usuario']))
					{
						$usuario=$_SESSION['usuario'];
					?>
						¡Bienvenido <?php print "$usuario";?>!
						<a href="cerrarsesion.php">Cerrar Sessión</a>
					<?php 
					}
					else
					{
						print"<a href='iniciosesion.php'>Iniciar Sessión</a>";
					}
					?>
					
				</div>
				<div class="clearl">
				</div>
				<div class="clearr">
				</div>
				<div class="cabezera">
					<img src="../img/cabezera.jpg"></img>
				</div>
				<div class="clearl">
				</div>
				<div class="clearr">
				</div>
				<div class="localizacion">
				</div>
				<hr color="#73777C"></hr>
				
				<div class="menu">
					<div class="menutitulo">
						Acceso General
					</div>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="inicio.php">Inicio</a></div>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="actividades.php">Actividades</a></div>
							<?php
							if (!isset($_SESSION['usuario']))
							{
							 ?>
								<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="iniciosesion.php">Inicio de Sesión</a></div>
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
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="monitores.php">Monitores</a></div>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="playas.php">Playas</a></div>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="clientes.php">Clientes</a></div>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="cursos.php">Cursos</a></div>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="contratacion.php">Contratación</a></div>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="material.php">Material</a></div>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="alquiler.php">Alquiler</a></div>
							
							<?php
							// Conectar con el servidor de base de datos.
							$conexion = mysql_connect ($db_host, $db_user, $db_password)
								 or die ("No se puede conectar con el servidor");

							// Seleccionar base de datos.
							mysql_select_db ($db_name)
								or die ("No se puede seleccionar la base de datos");

							//Encriptamos la contraseña.
							$usuariol=$_SESSION['usuario'];
							
							// Enviar consulta para saber si dicho usuario y clave estan en la base de datos.
							$instruccion = "select * from usuarios where usuario='$usuariol'";
							$consulta = mysql_query ($instruccion, $conexion)
								or die ("Fallo en la consulta");
							$resultado = mysql_fetch_array ($consulta);
                        
                        //si se cumple la condicion tipo sera admin , y si dolar session es admin (verdadero) nos //mostrara el apartado alta de usuarios
							if ($resultado['tipo']=="admin")
							{
                                $_SESSION['admin']="si";
							?>
								<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="nuevousuario.php">Altas de Usuarios</a></div>
							<?php
							}
							?>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="cerrarsesion.php">Salir</a></div>
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
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="http://www.ripcurl.com"><img src="../img/tuenti.jpg" width="33"></img>&nbsp Rip Curl School</a></div>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="http://www.billabong.com"><img src="../img/twitter.jpg" width="33"></img>&nbsp Billabong Camp</a></div>
							<div class="botonmenu"><img src="../img/botonmenu.jpg" height="20px" width="20px" border="0"></img></div><div class="listamenu"><a href="http://www.quiksilver.com"><img src="../img/facebook.jpg" width="33"></img>&nbsp Quiksilver Point</a></div>
					<div class="clearl">
					</div>
				</div>
			
				
				<div class="contenido">