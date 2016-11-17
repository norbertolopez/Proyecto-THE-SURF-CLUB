<?PHP
   header ("Content-type: image/png");
   
// Calcular ángulos
   $cursos = $_REQUEST['cursos'];
   $material = $_REQUEST['material'];
   $total = $cursos + $material;

   $porcentaje1 = round (($cursos/$total)*100,2);
   $angulo1 = 3.6 * $porcentaje1;
   $porcentaje2 = round (($material/$total)*100,2);
   $angulo2 = 3.6 * $porcentaje2;

// Crear imagen
   $imagen = imagecreate (400, 300);
   $colorfondo = imagecolorallocate ($imagen, 255, 255, 255); // CCCCCC
   $color1 = imagecolorallocate ($imagen, 0, 255, 0); // FF0000
   $color2 = imagecolorallocate ($imagen, 255, 0, 0); // 00FF00
   $colortexto = imagecolorallocate ($imagen, 0, 0, 0); // 000000

// Mostrar tarta
   imagefilledrectangle ($imagen, 0, 0, 300, 300, $colorfondo);
   imagefilledarc ($imagen, 150, 120, 200, 200, 0, $angulo1, $color1, IMG_ARC_PIE);
   imagefilledarc ($imagen, 150, 120, 200, 200, $angulo1, 360, $color2, IMG_ARC_PIE);

// Mostrar leyenda
   imagefilledrectangle ($imagen, 60, 250, 80, 260, $color1);
   $texto1 = "Ingresos cursos: " . $cursos . " € (" . $porcentaje1 . "%)";
   imagestring ($imagen, 3, 90, 250, $texto1, $colortexto);
   imagefilledrectangle ($imagen, 60, 270, 80, 280, $color2);
   $texto2 = "Ingresos material: " . $material . " € (" . $porcentaje2 . "%)";
   imagestring ($imagen, 3, 90, 270, $texto2, $colortexto);

   imagepng ($imagen);
   imagedestroy ($imagen);
?>
