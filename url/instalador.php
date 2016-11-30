<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Instalación Film Review</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  </head>
  <body style="background-color:darkred; ">

	<div style="width:1000px;margin: 0 auto;margin-top:1%;">
		<div class='form-group col-lg-10'>
			<h2 style="margin-left:15px;margin-bottom:15px;color:white;text-decoration: underline;">Instalador Aplicación Web</h2>
			<div class="form-group" >
					<?php
					include('server_information.php');
					?>
			</div>
		</div>
			  
		<div class='form-group col-lg-5'>
			<form enctype="multipart/form-data" action="instalador.php" method="post">
				<div class="form-group">
					<input type="text" name="user" class="form-control input-lg " placeholder="Usuario (acceso BD)" required>
				</div>
		</div>
		
		<div class="form-group col-lg-5">
			<div class="form-group">
				<input type="password" name="pass" class="form-control input-lg" placeholder="Contraseña (acceso BD)">
			</div>
		</div>
		
		<div class="form-group col-lg-5">
			<div class="form-group">
				<input type="text" name="formhost" class="form-control input-lg" placeholder="Host de la BD " required>
			</div>
		</div>
		
		<div class="form-group col-lg-5">
		  <div class="form-group">
			  <input type="text" name="formbd" class="form-control input-lg" placeholder="Nombre de la BD" required>
			</div>
		</div>
		
		<div class="form-group col-lg-10" style="height:auto;">
			<div class="form-group" >
				<h4 style="color:white;">Archivo .sql</h4>
				<input type='hidden' name='MAX_FILE_SIZE' value='3000000' >
				<input class="form-group" style="background-color:white;border-radius:10px;height:auto;align:center;padding:10px 10px 10px 10px;" id="input-2" name="filesql" type="file" class="file" multiple data-show-upload="false" data-show-caption="true" placeholder="Archivo .sql" required >
			</div>
		</div>
		
		<div class="form-group col-lg-10" style="height:auto;">
			<div class="form-group" >
				<h4 style="color:white;">Nombre de la nueva Base de datos:</h4>
				<input type="text" name="newbd" class="form-control input-lg" placeholder="Nombre de la nueva BD" required>
			</div>
		</div>
		
		<div class="form-group col-lg-5">
			<input style="background-color:white;color:#0C5484; float:right;" type="submit" value="Instalar" class="btn btn-primary pull-left">
		</div>
	</form>	
</div>
	<?php
          if(isset($_POST["user"])){
              $usuario=$_POST["user"];
              $password=$_POST["pass"];
              $bd=$_POST["formbd"];
			  $host=$_POST["formhost"];
			  $newbd=$_POST["newbd"];
			  $connection= new mysqli($host, $usuario, $password, $bd);
              if ($connection->connect_errno) {
                   printf("Connection failed: %s\n", $connection->connect_error);
                   exit();
              }
			  else{
				 $dir_subida ='';
				$fichero_subido = $dir_subida . basename($_FILES['filesql']['name']);
				  if (move_uploaded_file($_FILES['filesql']['tmp_name'], $fichero_subido)) {
						echo "El fichero es válido y se subió con éxito.\n";
					} else {
						echo "¡Posible ataque de subida de ficheros!\n";
					}
				   $filename = $_FILES['filesql']['name'];
                  // MySQL host
                  $mysql_host = $host;
                  // MySQL username
                  $mysql_username = $usuario;
                  // MySQL password
                  $mysql_password = $password;
                  // Database name
                  $mysql_database = $bd;
                  // Connect to MySQL server
                  // Temporary variable, used to store current query
                  $templine = '';
				  $file_nombre=explode(".sql", $filename);
//				  $text="create database if not exists `".$file_nombre[0]."`;"."\n"."use `".$file_nombre[0]."`;"."\n"."--"; 
				  $text2="\n"."create database if not exists `".$newbd."`;"."\n"."use `".$newbd."`;"."\n"."\n"."--";
				  $file3 = fopen($filename, "r+");
					fwrite($file3, $text2);
				  fclose($file3);
                  // Read in entire file
                  $lines = file($filename);
                  // Loop through each line
                  foreach ($lines as $line){
					  // Skip it if it's a comment
					  if (substr($line, 0, 2) == '--' || $line == '')
						  continue;
					  // Add this line to the current segment
					  $templine .= $line;
					  // If it has a semicolon at the end, it's the end of the query
					  if (substr(trim($line), -1, 1) == ';'){
							  // Perform the query
							  $connection->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
							  // Reset temp variable to empty1
							  $templine = '';
						  }
                  }
                   echo "Base de datos completa importada correctamente";
				   
				$file = fopen("db_configuration.php", "w");
					fwrite($file, "<?php"."\n");
					fwrite($file, "$"."db_user="."'".$usuario."';"."\n");
					fwrite($file, "$"."db_password="."'".$password."';"."\n");
					fwrite($file, "$"."db_host="."'".$host."';"."\n");
					fwrite($file, "$"."db_name="."'".$newbd."';"."\n");
					fwrite($file, "?>"."\n");
				fclose($file);
				$file2 = fopen("../../../index.php", "w");
					fwrite($file2, "<?php"."\n");
					fwrite($file2, "header('Location: /Proyecto-THE-SURF-CLUB/url/index.php');"."\n");
					fwrite($file2, "?>"."\n");
				fclose($file2);
				$fichero = 'favicon.ico';
				$nuevo_fichero = '../favicon.ico';
				if (copy($fichero, $nuevo_fichero)) {
					echo "Todo correcto al copiar $fichero...\n";
				}
				else{
					echo "error al copiar $fichero...\n";
				}
				unlink("instalador.php");
				unlink($filename);
				unlink("favicon.ico");
				unlink("server_information.php");
                header('Location: ../../../index.php');
              }
			}
          
	?>
    </div>
  </body>
</html>
