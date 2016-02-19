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
				include("../lib/fecha.php");
				$error="";
				$usuariol=$_REQUEST['usuariol'];
				$nombrem=$_REQUEST['nombrem'];
				$contraseñal=$_REQUEST['contraseñal'];
				$nombrel=$_REQUEST['nombrel'];
				$apellidol=$_REQUEST['apellidol'];
				$direcionl=$_REQUEST['direcionl'];
				$dnil=$_REQUEST['dnil'];
				$direcionl=$_REQUEST['direcionl'];
				$telefonol=$_REQUEST['telefonol'];
				$emaill=$_REQUEST['emaill'];
				$enviarl=$_REQUEST['enviarl'];
				$borrarl=$_REQUEST['borrarl'];
				$err=false;
				
				// Subir fichero
      			$copiarFichero = false;
      			
      			if (isset($enviarl))
   				{
     				//Comprobación de Errores.
					
					if (trim($nombrem)=="")
     				{
     					$error["nombrem"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
					if (trim($telefonol)=="")
     				{
     					$error["telefonol"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
					if (trim($dnil)=="")
     				{
     					$error["dnil"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
     				if (!is_numeric($dnil))
					{
						$error["dnil"]="Debe introducir un Numero";
						$err=TRUE;
					}
					
					if (!is_numeric($direcionl))
					{
						$error["direcionl"]="Debe introducir un Numero";
						$err=TRUE;
					}
					
					if (!preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$emaill))
					{
						$error["emaill"]="Fecha introducida incorrecta";
						$err=TRUE;
					}
     			
					if (!preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$telefonol))
					{
						$error["telefonol"]="Fecha introducida incorrecta";
						$err=TRUE;
					}
				
     				if (trim($emaill)=="")
     				{
     					$error["emaill"]="Campo marcado (*) requerido";
     					$err=true;
     				}
 				
   					if (trim($direcionl)=="")
     				{
     					$error["direcionl"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					if ($error=="")
					{
						$instruccionp="select id_monitor from monitores where id_monitor='$nombrem'";
						$consultap = mysql_query ($instruccionp, $conexion)
        					 or die ("Fallo en la consultass322");     
						$resultadop=mysql_fetch_array($consultap);
						$idcliente=$resultadop['id_monitor'];
						$nfilasp = mysql_num_rows ($consultap);
     				
	        			if ($nfilasp == 0)
	        			{
	        				$error["nombrem"]="No existe ese material";
	     					$err=true;
	        			}
					}
     			
   				}
      			
      			if(isset($enviarl) && $error=="")
   				{ 
   						// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ("localhost", "root", "")
        					 or die ("No se puede conectar con el servidor");
						
   						// Seleccionar base de datos
     					mysql_select_db ("thesurfclub")
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
						$emaill=cambiaf_a_mysql($emaill);
						$telefonol=cambiaf_a_mysql($telefonol);
   						// Enviar consulta para insertar contacto en la agenda.
						$instruccion = "insert into contrato (duracion_contrato,fecha_inicio_contrato,fecha_fin_contrato,costo_contrato,id_monitor) values ('$dnil','$telefonol','$emaill','$direcionl','$idcliente')";
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consultass32alquiler");        					
         				mysql_close ($conexion);
						$emaill=cambiaf_a_normal($emaill);
						$telefonol=cambiaf_a_normal($telefonol);
         			?>
   					<div class="titulomenu">¡Enorabuena ha ingresado satifactoriamente un nuevo Contrato!</div>
   					<div class="cuerpomenu">
   					<table  border="0">
   						<tr>
   							<td style="font-weight:bold;">Características:</td>
   							<td style="font-weight:bold;">Información:</td>
   						</tr>
   						<tr>
   							<td>ID Monitor:</td>
   							<td><?php print("$nombrem")?></td>
   						</tr>
   						<tr>
   							<td>Duracion:</td>
   							<td><?php print("$dnil")?></td>
   						</tr>
   						<tr>
   							<td>Fecha Inicio:</td>
   							<td><?php print("$telefonol")?></td>
   						</tr>
   						<tr>
   							<td>Fecha Fin:</td>
   							<td><?php print("$emaill")?></td>
   						</tr>
   						<tr>
   							<td>Costo:</td>
   							<td><?php print("$direcionl")?></td>
   						</tr>
   					</table>
   					<br/>
   					</div>
   					<div class="preguntalogin">Haz clik <a href="contratacion.php">aquí</a> para volver a la agenda</div>
      				<?php
   				}
   				else
   				{
			?>
						<div class="titulomenu">Agregar Contrato > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
						Cumplimenta este formulario para agregar a un Contrato
							<form ACTION="nuevousuario2contratacion.php" METHOD="POST">
						<br/>
						<fieldset class="formulariol">
								Duración *:<input type="text"  name="dnil"></input>
								<?php if ($error[dnil]!="")
									print("<span class='error'>$error[dnil]</span>");
								?>
							<br/>
							<br/>

								Fecha Inicio *:<input type="text"  name="telefonol"></input>
								<?php if ($error[telefonol]!="")
									print("<span class='error'>$error[telefonol]</span>");
								?>
							<br/>
							<br/>
								Fecha Fin *:<input type="text"  name="emaill"></input>
								<?php if ($error[emaill]!="")
									print("<span class='error'>$error[emaill]</span>");
								?>
							<br/>
							<br/>
								Costo *:<input type="text"  name="direcionl"></input>
								<?php if ($error[direcionl]!="")
									print("<span class='error'>$error[direcionl]</span>");
								?>
							<br/>
							<br/>
								ID Monitor *:<input type="text"  name="nombrem"></input>
								<?php if ($error[nombrem]!="")
									print("<span class='error'>$error[nombrem]</span>");
								?>
							<br/>
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