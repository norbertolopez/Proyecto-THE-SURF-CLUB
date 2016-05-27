<?php

session_start();
include("encabezado.php");
include_once("db_configuration.php");
print "<LINK REL='stylesheet' TYPE='text/css' HREF='../css/estilos.css'>";
?>
<?php if (!isset($_GET["idd"])): ?>

<?php
                    $connection = new mysqli ($db_host, $db_user, $db_password ,$db_name) or die ("No se puede conectar con el servidor");

                        $result5=$connection->query("select * from cursos join playas where cursos.id_playa = playas.id_playa;");
                 echo "<table>";
                echo "<h4>Seleccione un curso de la lista para el cliente seleccionado:</h4>";
                echo "<tr>";
                    echo "<td><h5>Playa</h5></td>";
                    echo "<td><h5>Curso</h5></td>";
                    echo "<td><h5>Modalidad</h5></td>";
                echo "</tr>";

                    while($obj5=$result5->fetch_object()){
                        echo "<tr>";
                        echo "<td>".$obj5->nombre_playa."</td>";
                        echo "<td>".$obj5->nombre_curso."</td>";
                        echo "<td>".$obj5->deporte."</td>";
                        $cursaso=$obj5->id_curso;
                        echo "<td>"."<a href='anadircliente.php?idd=$cursaso&idcli=".$_GET['id']."'>"."<img src='../img/añadircli.png' width='30'></img></a>"."</td>";
                        echo "</tr>";
                        
                        
                    }
                        
                       
                       
                        
                        
                        
                    
echo "</table>";
                   
?>

    	<?php else: ?>	

<?php
                        
    $connection = new mysqli ($db_host, $db_user, $db_password ,$db_name) or die ("No se puede conectar con el servidor");                     
                      
    $cursito=$_GET["idd"];
    $clientaso=$_GET["idcli"];
                        
    $instruccionaso = "insert into clientecursos(id_curso,id_cliente) values ($cursito, $clientaso);";
                        
    $result8=$connection->query($instruccionaso);
                        
                        echo "<h2>El cliente se ha añadido correctamente</h2></br></br>";
                        echo "<div class='preguntalogin'>Haz clik <a href='cursos.php'>aquí</a> para ir a la lista de cursos</div>";


?>
<?php endif ?>	

<?php include("pie.php"); ?> 