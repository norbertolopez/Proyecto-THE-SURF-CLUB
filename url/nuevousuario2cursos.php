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
		
				$err=false;
				
				// Subir fichero
      			$copiarFichero = false;
      			
      			if (isset($_REQUEST['enviarl']))
   				{
     				//Comprobación de Errores.
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
     			   
                
     			


     				if ($error=="")
     				{
     				// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ($db_host, $db_user, $db_password)
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ($db_name)
         					or die ("No se puede seleccionar la base de datos");
						$usuario11=$_SESSION['usuario'];
						
						
   						// Enviar consulta para comprobar que no exista un usuario, con el mismo apellido y nombre que el que queremos introducir.
						$instruccion3 = "select * from cursos where nombre_curso='".$_REQUEST['nombrel']."' and deporte='".$_REQUEST['apellidol']."'";
						$consulta3 = mysql_query ($instruccion3, $conexion)
        					 or die ("Fallo en la consultahgfghfghfgh");
        					 
	   					$nfilas3 = mysql_num_rows ($consulta3);
     				
	        			if ($nfilas3!=0)
	        			{
	        				$error["nombrel"]="Ya existe un curso, con ese Nombre";
	     					$err=true;
	        			}
	        			
	        			mysql_close ($conexion);
   					}
					
					if (trim($_REQUEST['telefonol'])=="")
     				{
     					$error["telefonol"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
					if (trim($_REQUEST['dnil'])=="")
     				{
     					$error["dnil"]="Campo marcado (*) requerido";
     					$err=true;
     				}
					
     				if (!preg_match('/^[0-9]{9}$/', $_REQUEST['telefonol']))
     				{	
     					$error["telefonol"]="Telefono Invalido, Teclee un telefono correcto";
     					$err=true;
     				}
     			
     				if (trim($_REQUEST['emaill'])=="")
     				{
     					$error["emaill"]="Campo marcado (*) requerido";
     					$err=true;
     				}
      				if (trim($_REQUEST['actividadl'])=="")
     				{
     					$error["actividadl"]="Campo marcado (*) requerido";
     					$err=true;
     				}    				
   					if (trim($_REQUEST['direcionl'])=="")
     				{
     					$error["direcionl"]="Campo marcado (*) requerido";
     					$err=true;
     				}
     			
     				if (!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_REQUEST['emaill']))
     				{	
     					$error["emaill"]="Email Invalido, Teclee un email correcto";
     					$err=true;
     				}
    				
					if (!preg_match('/^[0-9]{8}[a-z,A-Z]{1}$/',$_REQUEST['dnil']))
					{
						$error["dnil"]="DNI Incorrecto, 8digitos + 1 Letra";
						$err=TRUE;
					}

   					
   						// Conectar con el servidor de base de datos
      					$conexion = mysql_connect ($db_host, $db_user, $db_password)
        					 or die ("No se puede conectar con el servidor");

   						// Seleccionar base de datos
     					mysql_select_db ($db_name)
         					or die ("No se puede seleccionar la base de datos");
						$usuario2=$_SESSION['usuario'];
   						// Enviar consulta para insertar contacto en la agenda.
						$instruccion = "insert into cursos (id_monitor,id_playa,nombre_curso,deporte,duracion_cursos,fecha_inicio_cursos,fecha_fin_curso,costo_curso) values ('".$_REQUEST['dnil']."','".$_REQUEST['nombrel']."','".$_REQUEST['apellidol']."','".$_REQUEST['emaill']."','".$_REQUEST['telefonol']."','".$_REQUEST['direcionl']."','".$_REQUEST['actividadl']."','".$_REQUEST['ultimol']."')" ;
						$consulta = mysql_query ($instruccion, $conexion)
        					 or die ("Fallo en la consultass");        					
         				mysql_close ($conexion);
         				if ($copiarFichero)
       						  move_uploaded_file ($_FILES['imagenl']['tmp_name'],$nombreDirectorio . $nombreFichero);	
   					?>
   					<div class="titulomenu">¡El curso ha ingresado satifactoriamente!</div>
   					<div class="cuerpomenu">
   					<table  border="0">
   						<tr>
   							<td style="font-weight:bold;">Características:</td>
   							<td style="font-weight:bold;">Información:</td>
   						</tr>
   						<tr>
   							<td>Nombre del Monitor:</td>
   							<td><?php print($_REQUEST['nombrel'])?></td>
   						</tr>
   						<tr>
   							<td>Playa Asignada:</td>
   							<td><?php print($_REQUEST['apellidol'])?></td>
   						</tr>
   						<tr>
   							<td>Nombre del Curso:</td>
   							<td><?php print($_REQUEST['dnil'])?></td>
   						</tr>
   						<tr>
   							<td>Deporte:</td>
   							<td><?php print($_REQUEST['direcionl'])?></td>
   						</tr>
   						<tr>
   							<td>Duracion del Curso:</td>
   							<td><?php print($_REQUEST['telefonol'])?></td>
   						</tr>
   						<tr>
   							<td>Fecha Principio Curso:</td>
   							<td><?php print($_REQUEST['emaill'])?></td>
   						</tr>
						<tr>
   							<td>Fecha Final Curso:</td>
   							<td><?php print($_REQUEST['actividadl'])?></td>
   						</tr>  						
   						<tr>
   							<td>Costo del Curso:</td>
   							<td><?php print ($_REQUEST['ultimol'])?></td>
   						</tr>
   					</table>
   					<br/>
   					</div>
   					<div class="preguntalogin">Haz clik <a href="cursos.php">aquí</a> para volver a la agenda</div>
      				<?php
   				}
   				else
   				{
			?>
      			
						<div class="titulomenu">Agregar Curso > </div><div class="imagentitulo"></div> 
						<div class="cuerpomenu">
						Cumplimenta este formulario para agregar un cursoi
							<form ACTION="nuevousuario2cursos.php" METHOD="POST" ENCTYPE="multipart/form-data">
						<br/>
						<fieldset class="formulariol">
                            
								Nombre del monitor *:<?php
                    echo "<select name='dnil' required'>";
                    $connectionz = new mysqli("localhost", "root", "", "thesurfclub");
if ($result3=$connectionz->query("SELECT * FROM monitores;")) {
     if ($result3->num_rows===0) {
                echo "ERROR FATAL, ABORTAR MISIÓN";
              } else {
         while($obj2 = $result3->fetch_object()) {
                    echo "<option value='".$obj2->id_monitor."'>".$obj2->nombre_monitor."</option>";
                 }
         $result3->close();
         unset($obj2);
    }
 }
                    echo "Curso* :</select>";
?>
							<br/>
							<br/>
								Nombre Playa *:<?php
                    echo "<select name='nombrel' required'>";
if ($result3=$connectionz->query("SELECT * FROM playas;")) {
     if ($result3->num_rows===0) {
                echo "ERROR FATAL, ABORTAR MISIÓN";
              } else {
         while($obj2 = $result3->fetch_object()) {
                    echo "<option value='".$obj2->id_playa."'>".$obj2->nombre_playa."</option>";
                 }
         $result3->close();
         unset($obj2);
    }
 }
                    echo "Curso* :</select>";
?>
							<br/>
							<br/>
								Nombre del Curso *:<input type="text"  name="apellidol" required></input>
								<?php 
                    if (isset($error['dnil'])) {
                            if ($error['dnil']!="")
									print("<span class='error'>".$error['dnil']."</span>");
                    }
								?>
							<br/>
							<br/>

								Deporte *:<input type="text"  name="emaill" required></input>
								<?php 
                    if (isset($error['telefonol'])) {
                            if ($error['telefonol']!="")
									print("<span class='error'>".$error['telefonol']."</span>");
                    }
								?>
							<br/>
							<br/>
								Duracion del curso *:<input type="text"  name="telefonol" required></input>
								<?php 
                            if (isset($error['emaill'])) {
                            if ($error['emaill']!="")
									print("<span class='error'>".$error['emaill']."</span>");
                            }
								?>
							<br/>
							<br/>
								Fecha inicio *:<input type="date"  name="direcionl" required></input>
								<?php 
                                    if (isset($error['direcionl'])) {
                                    if ($error['direcionl']!="")
									print("<span class='error'>".$error['direcionl']."</span>");
                                    }
								?>
							<br/>
							<br/>
								Fecha fin *:<input type="date"  name="actividadl" required></input>
								<?php 
                                    if (isset($error['actividadl'])) {
                                    if ($error['actividadl']!="")
									print("<span class='error'>".$error['actividadl']."</span>");
                                    }
								?>
							<br/>

							<br/>
								Costo del Curso  *:				
								<input type="number" name="ultimol" required></input>
								<?php 
                                if (isset($error['imagenl'])) {
                                if ($error['imagenl']!="")
									print("<span class='error'>".$error['imagenl']."</span>");
                                }
								?>
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