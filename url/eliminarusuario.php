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
						<div class="titulomenu">Eliminación de usuario > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
							<?PHP
								$usuario2=$_SESSION['usuario'];
							   $enviar = $_REQUEST['enviar'];
							   if (isset($enviar))
							   {							
							   // Conectar con la base de datos
							      $connection = mysql_connect ("localhost", "root", "")
							         or die ("No se puede conectar al servidor");
							      mysql_select_db ("thesurfclub")
							         or die ("No se puede seleccionar BD");
								$instruccion4 = "SELECT * FROM agenda_$usuario2";
							    $consulta4 = mysql_query ($instruccion4, $connection)
							         or die ("Fallo en la selección4");
								$nfilas = mysql_num_rows ($consulta4);
									if ($nfilas==0)
									{
										$err=true;
									}
								if ($err==false)
								{
								   // Obtener votos actuales
									  $instruccion = "select * from agenda_$usuario;";
									  $consulta = mysql_query ($instruccion, $connection)
										 or die ("Fallo en la selección");
										$nfilas=mysql_num_rows($consulta);
										for ($i=0;$i<$nfilas;$i++)
										{
											$resultado = mysql_fetch_array ($consulta);
											$imagen[$i] = $resultado['imagen'];
										}
								
								   // Eliminar archivos fisicos de la base de datos.
									  foreach($imagen as $resu)
									  {
										$imagen2="../img/" . $resu;
										unlink ($imagen2);
									  }
								}
								$instruccion2 = "drop table agenda_$usuario;";
							      $consulta2 = mysql_query ($instruccion2, $connection)
							         or die ("Fallo en la selección2");
								  
								  $instruccion3 = "delete from usuarios where usuario='". $usuario . "'";
							      $consulta3 = mysql_query ($instruccion3, $connection)
							         or die ("Fallo en la selección3");
							
							   // Desconectar
							      mysql_close ($connection);
								  
								//Cerramos session
								session_destroy ();	
								
								//Con este meta, redirecionamos a la pagina index.php
								echo "<META HTTP-EQUIV='refresh' CONTENT='5; URL=../index.php'>";
							
							   // Mostrar mensaje de agradecimiento
							      print ("\n<div class='preguntalogin'>Su cuenta a sido borrada con exito de Friends's Diary, esperamos volver a verle pronto</div><br/>");
							   }
							   else
							   {
							?>
							
							¿Estas seguro que deseas borrar su cuenta de Friends's Diary?
							<br/>
							Perdera todo lo almacenado en su cuenta.
							<br/>
							<br/>
							Si es asi, pulse en este botón.
							<br/>
							<br/>
							<FORM ACTION="eliminarusuario.php" METHOD="POST">
							   <INPUT TYPE="SUBMIT" NAME="enviar" VALUE="Eliminar Usuario">
							</FORM>
							<?PHP
							   }
							?>
						</div>				
				</div>
				<?PHP
				}
				include("pie.php");
				?>