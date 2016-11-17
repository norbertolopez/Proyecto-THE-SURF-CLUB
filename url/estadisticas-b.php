<?PHP
   header ("Content-type: image/png");
   
// Calcular ángulos
   $clientes = $_REQUEST['clientes'];
   $monitores = $_REQUEST['monitores'];
   $gestores = $_REQUEST['gestores'];
   $administradores = $_REQUEST['administradores'];
   $total = $clientes + $monitores+$gestores+$administradores;

   $porcentaje1 = round (($clientes/$total)*100);
   $angulo1 = 3.6 * $porcentaje1;
   $porcentaje2 = round (($monitores/$total)*100);
   $angulo2 = 3.6 * $porcentaje2;
   $porcentaje3 = round (($gestores/$total)*100);
   $angulo3 = 3.6 * $porcentaje3;
   $porcentaje4 = round (($administradores/$total)*100);
   $angulo4 = 3.6 * $porcentaje4;

// Crear imagen
   $imagen = imagecreate (300, 400);
   $colorfondo = imagecolorallocate ($imagen, 255, 255, 255); // CCCCCC
   $color1 = imagecolorallocate ($imagen, 0, 255, 0); // FF0000
   $color2 = imagecolorallocate ($imagen, 255, 0, 0); // 00FF00
   $color3 = imagecolorallocate ($imagen, 48,97,229); // 00FF00
   $color4 = imagecolorallocate ($imagen, 255, 190, 15); // 00FF00
   $colortexto = imagecolorallocate ($imagen, 0, 0, 0); // 000000

// Mostrar tarta
	$p2=$angulo1+$angulo2;
	$p3=$angulo1+$angulo2+$angulo3;
	
   imagefilledrectangle ($imagen, 0, 0, 300, 300, $colorfondo);
   imagefilledarc ($imagen, 150, 120, 200, 200, 0, $angulo1, $color1, IMG_ARC_PIE);
   imagefilledarc ($imagen, 150, 120, 200, 200, $angulo1, $p2, $color2, IMG_ARC_PIE);
   imagefilledarc ($imagen, 150, 120, 200, 200, $p2, $p3, $color3, IMG_ARC_PIE);
   imagefilledarc ($imagen, 150, 120, 200, 200, $p3, 360, $color4, IMG_ARC_PIE);

// Mostrar leyenda
   imagefilledrectangle ($imagen, 60, 250, 80, 260, $color1);
   $texto1 = "Número de Alumnos: " . $clientes . " (" . $porcentaje1 . "%)";
   imagestring ($imagen, 3, 90, 250, $texto1, $colortexto);
   imagefilledrectangle ($imagen, 60, 270, 80, 280, $color2);
   $texto2 = "Número de Monitores: " . $monitores . " (" . $porcentaje2 . "%)";
   imagestring ($imagen, 3, 90, 270, $texto2, $colortexto);
   imagefilledrectangle ($imagen, 60, 290, 80, 300, $color3);
   $texto3 = "Número de Gestores: " . $gestores . " (" . $porcentaje3 . "%)";
   imagestring ($imagen, 3, 90, 290, $texto3, $colortexto);
   imagefilledrectangle ($imagen, 60, 310, 80, 320, $color4);
   $texto4 = "Número de Admin: " . $administradores . " (" . $porcentaje4 . "%)";
   imagestring ($imagen, 3, 90, 310, $texto4, $colortexto);

   imagepng ($imagen);
   imagedestroy ($imagen);
?>
