<?php

session_start();

<?php

include_once("db_configuration.php");

?>

include("encabezado.php");
print "<LINK REL='stylesheet' TYPE='text/css' HREF='../css/estilos.css'>";

				$usuario=$_REQUEST['usuariol'];
				$clave=$_REQUEST['contrasenal'];
				$error=FALSE;
			
				if (isset ($usuario) && isset ($clave))
				{
					// Conectar con el servidor de base de datos.
      				$conexion = mysql_connect ("localhost", "root", "")
        				 or die ("No se puede conectar con el servidor");

   					// Seleccionar base de datos.
     				mysql_select_db ("thesurfclub")
         				or die ("No se puede seleccionar la base de datos");

   					//Encriptamos la contraseña.
					$salt=substr($usuario, 0,2);
					$clave2=crypt ($clave, $salt);
					
					// Enviar consulta para saber si dicho usuario y clave estan en la base de datos.
					$instruccion = "select usuario, clave from usuarios where usuario='$usuario' and clave='$clave2'" ;
					$consulta = mysql_query ($instruccion, $conexion)
        			 	or die ("Fallo en la consulta");
        			
        			$nfilas = mysql_num_rows ($consulta);
        		
					//Comprovamos que la consulta tiene almenos una fila, y en caso afirmativo, metemos al usuario en sesión.
        			if ($nfilas > 0)
        			{
        				$_SESSION['usuario']=$usuario;
        			}
        			mysql_close($conexion);
				}		
        		
        				
        		if (isset($_SESSION['usuario']))  
        		{
        		?>  		
					<div class="titulomenu">Comprobando usuario > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
							Comprobando datos de usuario, si todo es correcto sera redirigido en 5 segundos, sino pulse <a href="bienvenido.php">aquí</a>.
                            <b></b>
                            <p></p>
                            <img src="../img/entrar12.gif" height="150px" width="150px"></img>
							<?php echo "<META HTTP-EQUIV='refresh' CONTENT='3; URL=bienvenido.php'>";?>
						</div>
        		<?php
        		} 	   				      					
         		else
         		{
         			if(isset ($usuario))        				
        					$fail="Usuario o contraseña incorrectos";		
				?>				
						<div class="titulomenu">Inicio de Sesión > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
							<form ACTION="iniciosesion.php" METHOD="POST">
						<br/>
						<fieldset>
							<table>
							<tr>
								<td>Usuario:</td><td>Contraseña:</td>
							</tr>
							<tr>
								<td><input type="text"  name="usuariol"></td><td><input type="password"  name="contrasenal"></td><td><input type="submit" value="Entrar" name="iniciarsesion"></td>
							</tr>
							</table>
						<div class="error"><?php print"$fail"?></div> 
						</fieldset>
						</form>
						
						<div class="preguntalogin">
							¡Si tienes problemas con el login, haz click <a href="mailto:info@thesurfclub.com">aquí</a> para ponerte en contacto con el Administrador!<br/><br/>
							<center><img src="../img/logo1.jpg" width="180px"></img></center>
						</div>
			<?php
         		}
			?>	
						</div>
<?PHP
	include("pie.php");
?>