<?php

session_start();
include("encabezado.php");
print "<LINK REL='stylesheet' TYPE='text/css' HREF='../css/estilos.css'>";

				//Rescato datos del formulario.
				$error="";
				$usuariol=$_REQUEST['usuariol'];
				$contraseñal=$_REQUEST['contraseñal'];
				$enviarl=$_REQUEST['enviarl'];
				$borrarl=$_REQUEST['borrarl'];
				$err=FALSE;
      			
      			if (isset($enviarl))
   				{
					//Compruebo que el usuario no este en blanco.
     				if (trim($usuariol)=="")
     				{
     					$error["usuariol"]="Campo marcado (*) requerido";
     					$err=TRUE;
   					}
     				
   					// Conectar con el servidor de base de datos.
      				$conexion = mysql_connect ("localhost", "root", "")
        				or die ("No se puede conectar con el servidor");

   					// Seleccionar base de datos
     				mysql_select_db ("thesurfclub")
         				or die ("No se puede seleccionar la base de datos");

   					// Enviar consulta para comprobar si el usuario ya existe.
					$instruccion = "select usuario from usuarios where usuario='$usuariol'";
					$consulta = mysql_query ($instruccion, $conexion)
        				 or die ("Fallo en la consulta112");
        			 
        			$nfilas = mysql_num_rows ($consulta);
        		
        			if ($nfilas!=0)
        			{
        				$error["usuariol"]="El usuario ya existe";
     					$err=TRUE;
        			}
   			
         			mysql_close ($conexion);	
   				
   					//Control de errores de contraseña.
     				if (trim($contraseñal)=="")
     				{
     					$error["contraseñal"]="Campo marcado (*) requerido";
     					$err=TRUE;
     				}
     			
     				if (!preg_match('/^[0-9, a-z, A-Z]{8}$/', $contraseñal))
     				{
     					$error["contraseñal"]="Contraseña invalida (8 caracteres dell 0 al 9, a-z, A-Z)";
     					$err=TRUE;
     				}	
   				}
      			
				//Si no hay errores me conecto a la base de datos e introduzco al usuario con su clave.
      			if(isset($enviarl) && $err==FALSE)
   				{
   						// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ("localhost", "root", "")
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ("thesurfclub")
         					or die ("No se puede seleccionar la base de datos");

   						// Enviar consulta
						$salt=substr($usuariol, 0,2);
						$clave2=crypt ($contraseñal, $salt);
						
						$instruccion = "insert into usuarios (usuario,clave,tipo) values ('$usuariol','$clave2','gestor')";
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consulta333");
   												
						/*//Cuando creamos un usuario, ademas de meterlo en sesión creamos una tabla, donde seran almacenados los usuarios de su agenda.
        				$instruccion2="

        				CREATE TABLE `friends_diary_db`.`agenda_$usuario2` (
										`id` INT( 5 ) NOT NULL AUTO_INCREMENT ,
										`nombre` VARCHAR( 30 ) NOT NULL ,
										`telefono` VARCHAR( 9 ) NOT NULL ,
										`email` VARCHAR( 30 ) NOT NULL ,
										`direcion` VARCHAR( 40 ) NOT NULL ,
										`edad` VARCHAR( 10 ) NULL ,
										`sexo` VARCHAR( 10 ) NULL ,
										`comentarios` VARCHAR( 125 ) NULL ,
										`imagen` VARCHAR( 200 ) NOT NULL ,
										PRIMARY KEY ( `id` )
						) ENGINE = MYISAM";        				
        				
        				$consulta2 = mysql_query ($instruccion2, $conexion)
        					 or die ("Fallo en la consulta444");*/
        				
         				mysql_close ($conexion);	
					?>  		
					
					<div class="titulomenu">Comprobando usuario > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
							Usuario Gestor Añadido Correctamente.
						</div>
				</div>
        		<?php
        		} 
   				else
   				{
				?>
   						<div class="titulomenu">Nuevo Usuario > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
						Cumplimenta este formulario para añadir un usuario
							<form ACTION="nuevousuario.php" METHOD="POST" ENCTYPE="multipart/form-data">
						<br/>
						<fieldset class="formulariol">
								Usuario *:<input type="text"  name="usuariol"></input>
								<?php if ($error[usuariol]!="")
									print("<span class='error'>$error[usuariol]</span>");
								?>
							<br/>
							<br/>
								Contraseña *:<input type="password"  name="contraseñal"></input>
								<?php if ($error[contraseñal]!="")
									print("<span class='error'>$error[contraseñal]</span>");
								?>
							<br/>
							<br/>
								<center>
								<input type="submit" name="enviarl" value="Enviar">
								<input type="reset" name="borrarl" value="Borrar">
							</center>
							<div class="error">Los campos marcados con (*) son obligatorios</div>
						</fieldset>
						</form>
						</div>				
				
				<?php 
				}
				include("pie.php");
				?>