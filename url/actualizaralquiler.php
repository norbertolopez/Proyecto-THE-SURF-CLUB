<?php

session_start();
include("encabezado.php");
include_once("db_configuration.php");
print "<LINK REL='stylesheet' TYPE='text/css' HREF='../css/estilos.css'>";
if (!isset($_SESSION['usuario']))
					{
						print("Para ver este contenido debe estar logueado");
						echo "<META HTTP-EQUIV='refresh' CONTENT='3; URL=../index.php'>";
					}
else
{
				$error="";
// $err ponemos estado falso , pero en el momento que tengamos un error lo pasamos a verdadero ( si ponemos nombre //vacio se traducira en verdadero)
				$err=false;
				
				// Subir fichero
      			$copiarFichero = false;
      			$id=$_REQUEST['id'];
        		
   						// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ($db_host, $db_user, $db_password)
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ($db_name)
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
                    if(isset($nombreFichero)){
						$imgagen2=$nombreFichero;
    }
						
   						// Enviar consulta para selecionar los detalles de la id pasados por URL.
   						$sesion2=$_SESSION['usuario'];
						$instruccion = "select * from alquiler where id_alquiler='$id'" ;
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consulta");        						
         				$resultado = mysql_fetch_array ($consulta);
				
				
      			if (isset($_REQUEST['enviarl']))
   				{
     				//Comprobación de Errores.
                    //trim:Elimina espacio en blanco de lo que metamos en la variable o de lo que tengamos. 
                    
                    //$error: es el error de variable que pintariamos
   					if (trim($_REQUEST['nombrel'])=="")
     				{
     					$error["nombrel"]="Campo marcado (*) requerido";
     					$err=true;
   					}
     				
     				
					
					if (trim($_REQUEST['apellidol'])=="")
     				{
     					$error["apellidol"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
				
   				}
      			
      			if(isset($_REQUEST['enviarl']) && $error=="")
   				{ 
   						// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ($db_host, $db_user, $db_password)
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ($db_name)
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
   						// Enviar consulta para insertar contacto en la agenda.

						 	$instruccion="update alquiler set duracion_alquiler='".$_REQUEST['nombrel']."',costo_alquiler='".$_REQUEST['apellidol']."', fecha_inicio_alquiler='".$_REQUEST['iniciol']."',fecha_fin_alquiler='".$_REQUEST['finl']."' WHERE id_alquiler='$id'";
						 	$consulta=mysql_query($instruccion,$conexion)
						 		or die("Fallo en la actualización");
						 	mysql_close ($conexion);

         					
   					?>
   					<div class="titulomenu">¡Enorabuena ha actualizado satifactoriamente el alquiler!</div>
   					<div class="cuerpomenu">
   					<table  border="0">
   						<tr>
   							<td style="font-weight:bold;">Características:</td>
   							<td style="font-weight:bold;">Información:</td>
   						</tr>
   						<tr>
   							<td>Duracion Alquiler:</td>
   							<td><?php print($_REQUEST['nombrel'])?></td>
   						</tr>
   						<tr>
   							<td>Coste del Alquiler:</td>
   							<td><?php print($_REQUEST['apellidol'])?></td>
   						</tr>
                        <tr>
   							<td>Fecha Inicio alquiler:</td>
   							<td><?php print($_REQUEST['iniciol'])?></td>
   						</tr>
                        <tr>
   							<td>Fecha Fin alquiler:</td>
   							<td><?php print($_REQUEST['finl'])?></td>
   						</tr>
   						
   					</table>
   					<br/>
   					</div>
   					<div class="preguntalogin">Haz clik <a href="alquiler.php">aquí</a> para volver a alquileres</div>
      				<?php
   				}
   				else
   				{
			?>
      			
						<div class="titulomenu">Actualizar Alquiler > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
						Cumplimenta este formulario para actualizar el alquiler
							<form ACTION="actualizaralquiler.php?id=<?PHP print "$id"; ?>" METHOD="POST" ENCTYPE="multipart/form-data">
						<br/>
						<fieldset class="formulariol">
								Duracion del Alquiler *:<input type="number"  name="nombrel" value="<?PHP 
								if (isset($_REQUEST['enviarl']))
									print($_REQUEST['nombrel']);
								else
									print($resultado['duracion_alquiler']);
								?>"></input>
                
								<?php
                     if (isset($error['nombrel'])) {
                    if ($error['nombrel']!="")
									print("<span class='error'>".$error['nombrel']."</span>");
                     }
								?>
							<br/>
							<br/>
								Costo del alquiler *:<input type="text"  name="apellidol" value="<?PHP
                    
                    
								if (isset($_REQUEST['enviarl'])) {
									print($_REQUEST['apellidol']);
                                    
                                }
								else
                                {
									print($resultado['costo_alquiler']);
                    
                    }
								?>"></input>
								<?php
                          if (isset($error['apellidol'])) {
                                   if ($error['apellidol']!="")
									print("<span class='error'>".$error['apellidol']."</span>");
                          }
								?>
							<br/>
                            <br/>
                            <?php
                            $connection = new mysqli ("localhost","root","","thesurfclub");
                    
                        $result4=$connection->query("select * from alquiler where id_alquiler='$id';");
                    while($obj4=$result4->fetch_object()){
                        $valuaso=$obj4->fecha_inicio_alquiler;
                        echo "Fecha Inicio del alquiler *:<input type='date' value='$valuaso'  name='finl'></input>";
                    }
                       
?>
                
								<?php
                     if (isset($error['iniciol'])) {
                    if ($error['iniciol']!="")
									print("<span class='error'>".$error['iniciol']."</span>");
                     }
								?>
							<br/>
                            <br/>
                             <?php
                            $connection = new mysqli ("localhost","root","","thesurfclub");
                    
                        $result5=$connection->query("select * from alquiler where id_alquiler='$id';");
                    while($obj5=$result5->fetch_object()){
                        $valuaso2=$obj5->fecha_fin_alquiler;
                        echo "Fecha Fin del alquiler *:<input type='date' value='$valuaso2'  name='finl'></input>";
                    }
                       
?>
                
								<?php
                     if (isset($error['finl'])) {
                    if ($error['finl']!="")
									print("<span class='error'>".$error['finl']."</span>");
                     }
								?>
							<br/>
							
											<p class="error">Los campos marcados con (*) son obligatorios</p>
							<center>
								<input type="submit" name="enviarl" value="Enviar">
								<input type="reset" name="borrarl" value="Borrar">
							</center>
						</fieldset>
						</form>
						</div>				
				
<?php 
}
}
	include("pie.php");
?>