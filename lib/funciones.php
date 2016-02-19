<?php

function par($paridad)
					{
						$num=$paridad%2;
						if ($num==0)
							print"<p>¡Numero Par!</p>";
						else
							print"<p>¡Numero Impar</p>";
						print"<br/><a href='index.php'>[Nueva Consulta]</a>";
					}
					


function may ($x)
{
	$x=strtoupper($x);
	print("<p>La frase En mayusculas es $x");
	print"<br/><a href='index2.php'>[Nueva Consulta]</a>";
}

function ciu ($x)
{
	$a=count($x);
	for ($i=0;$i<$a;$i++)
	{
		$b=substr( $x[$i], 0, 3 );
		$y[$b]=$x[$i];
	}
	ksort($y);
	print_r ($y);
	print"<br/><a href='index3.php'>[Nueva Consulta]</a>";
}

function num ($x, $y)
{
	if ($x>$y)
	{
		$z=$x-$y;
		$p=$y;
		$f=$x;
		
	}
	else
	{
		$z=$y-$x;
		$p=$x;
		$f=$y;
	}
	$w[0]=$p;
	for ($i=1;$i<$z;$i++)
	{
		$a=$p+$i;
		$w[$i]=$a;
	}
	$w[$z]=$f;
	$salida=implode(' ',$w);
	print "$salida";
	print"<br/><a href='index4.php'>[Nueva Consulta]</a>";
}
?>