
<?php

include_once("./db_configuration.php");


?>

<?php
echo "<h4>*Elige un tema:</br></h4>";
echo "<a href='index.php?tema=tema1'><img style='margin: 5px 5px 5px 5px' width='50px' height='30px' src='/img/tema1.png'/></a>";
echo "<a href='index.php?tema=tema2'><img style='margin: 5px 5px 5px 5px' width='50px' height='30px' src='/img/tema2.png'/></a>";
echo "<a href='index.php?tema=tema3'><img style='margin: 5px 5px 5px 5px' width='50px' height='30px' src='/img/tema3.png'/></a></br>";
echo "<a href='index.php?tema=tema0'>(Por defecto)</a>";
if (isset($_GET['tema'])){
	$_SESSION['tema']=$_GET['tema'];
}
else {
	
}
if (isset($_SESSION['tema'])){
		if ($_SESSION['tema']=='tema1'){
				echo "<style type='text/css'>
                a{color: black;}
				a:hover{color: blue;}
                body{background: black}
                .menutitulo{background: #ff0000;}
				.log{background: #ff0000;}
				.cabezera{background: #ff0000;}
				.cabezera > h4{color: black;}
				.listamenu{background: #737373}
				.inicio{background: #737373;}
				.localizacion{background: #990000;}
                .contenido{background: #737373;}
                </style>";
		}
		elseif ($_SESSION['tema']=='tema2'){
				echo "<style type='text/css'>#sidebaraso{background: green;}
				.menutitulo{background: green;}
				.cabezera{background: green;}
				.cabezera > h4{color: black;}
				.log{background: black}
				.listamenu{background: black;}
				body{background: grey}
				a{color: green;}
				a:hover{color: blue;}
                .contenido{background: darkgreen;}
				.inicio{background: darkgreen;}'></style>";
            
		}
		
		elseif ($_SESSION['tema']=='tema3'){
				echo "<style type='text/css'>#sidebaraso{background: white;}
				.menutitulo{background: white;}
				.cabezera{background: white;}
				.log > h4{color: black;}
				.listamenu{background: grey;}
				body{background: blue;}
				.inicio{background: blue;}
				a{color: black;}
				a:hover{color: blue;}
                .contenido{background: blue;}
				.localizacion{background: #D8D8D8; color: black}'></style>";
		}
		else {
		}
}
	else {}
//elementos a cambiar color:
                  
//				  tema1          tema2           tema3        
//--------------------------------------------------------				  
//#sidebaraso---> rojo --------- verde --------- blanco
//#sidebar------> rojo --------- verde --------- blanco
//#login--------> rojo --------- verde --------- blanco
//body----------> negro -------- gris ---------- azul
//#main---------> gris --------- negro --------- burdeos
//#contenido----> gris --------- negro --------- burdeos
//#footerright--> rojo oscuro -- verde oscuro -- gris
?>