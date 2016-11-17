<?php
  
   include('class.ezpdf.php');
   include_once("db_configuration.php");
   session_start();
   $pdf =& new Cezpdf('a4');
	include("../lib/fecha.php");
	$instruccion=$_SESSION['consulta1'];
	$instruccion2=$_SESSION['consulta2'];
	$pag=$_SESSION['pag'];


	$datacreator = array (
  
                          'Title'=>'PDF The Surf Club',
  
                          'Author'=>'Norberto López',
  
                          'Subject'=>'PDF con Tablas',
  
                          'Creator'=>'thesurfclub@gmail.com',

                          'Producer'=>'The Surf Club'
 
                          );
 
    $pdf->addInfo($datacreator);


	
if ($pag=="monitores")
{		
// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ($db_host, $db_user, $db_password)
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
		mysql_select_db ($db_name)
			or die ("No se puede seleccionar la base de datos");
		$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta1");
	   
	   $nfilas = mysql_num_rows ($consulta);
		
		for ($i=0; $i<$nfilas; $i++)
		{
			$resultado = mysql_fetch_array ($consulta);
			$resulta2=$resultado['id_monitor'];
			$instruccion4 = "select * from cursos where id_monitor='$resulta2'";									
			$consulta4 = mysql_query ($instruccion4, $conexion)
				or die ("Fallo en la consulta10");
			$nfilas4 = mysql_num_rows ($consulta4);
				$data[] = array('nombre'=>$resultado['nombre_monitor'], 'num'=>$nfilas4);
		}
		$titles = array('nombre'=>'<b>Nombre</b>', 'num'=>'<b>Numero de Cursos</b>');
		mysql_close ($conexion);
		   
	 
		  $pdf->ezText("<b>Lista de Número de Cursos impartidos por Cada monitor</b>\n",16);	  
}

if ($pag=="verdetalles")
{
// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ($db_host, $db_user, $db_password)
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
		mysql_select_db ($db_name)
			or die ("No se puede seleccionar la base de datos");
		$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta1");
		$resultado = mysql_fetch_array ($consulta);
		$data[] = array('info'=>Nombre, 'dato'=>$resultado['nombre_monitor']);
		$data[] = array('info'=>Apellido, 'dato'=>$resultado['apellidos_monitor']);
		$data[] = array('info'=>DNI, 'dato'=>$resultado['dni_monitor']);
		$data[] = array('info'=>Actividad, 'dato'=>$resultado['actividad_monitor']);
		$data[] = array('info'=>Telefono, 'dato'=>$resultado['telefono_monitor']);
		$data[] = array('info'=>Email, 'dato'=>$resultado['email_monitor']);
		$consulta2 = mysql_query ($instruccion2, $conexion)
			or die ("Fallo en la consulta1");
		$nfilas2 = mysql_num_rows ($consulta2);
		for ($i=0; $i<$nfilas2; $i++)
		{
								$resultado2 = mysql_fetch_array ($consulta2);
								$data[] = array('info'=>Curso, 'dato'=>$resultado2['nombre_curso']);
		}
		$titles = array('info'=>'<b>Info.</b>', 'dato'=>'<b>Datos</b>');
		
		   
	 mysql_close ($conexion);
		$pdf->ezText("<b>Detalles de Cada monitor</b>\n",16);
}
   
if ($pag=="cursos")
{
// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ($db_host, $db_user, $db_password)
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
		mysql_select_db ($db_name)
			or die ("No se puede seleccionar la base de datos");
	$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta1");
	$nfilas = mysql_num_rows ($consulta);
	
	for ($i=0; $i<$nfilas; $i++)
         	{
            	$resultado = mysql_fetch_array ($consulta);
				$idal=$resultado['id_curso'];
				$instruccionp = "select count(id_cliente) from clientes where id_curso='$idal'";
				$consultap = mysql_query ($instruccionp, $conexion)
					or die ("Fallo en la consulta1as");
				$resultadop = mysql_fetch_array ($consultap);
            	$diafa=$resultadop['count(id_cliente)'];
           		$data[] = array('nombre'=>$resultado['nombre_curso'], 'deporte'=>$resultado['deporte'], 'duracion'=>$resultado['duracion_cursos'], 'alumnos'=>$diafa);
        	}
			$titles = array('nombre'=>'<b>Nombre Curso</b>', 'deporte'=>'<b>Deporte</b>' , 'duracion'=>'<b>Duracion </b>' , 'alumnos'=>'<b>Numero de Alumnos</b>');
		mysql_close ($conexion);
		   
	 
		  $pdf->ezText("<b>Lista de Número de Cursos impartidos por Cada monitor</b>\n",16);
}

if ($pag=="playas")
{
// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ($db_host, $db_user, $db_password)
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
		mysql_select_db ($db_name)
			or die ("No se puede seleccionar la base de datos");
	$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta1");
	$nfilas = mysql_num_rows ($consulta);
	
	for ($i=0; $i<$nfilas; $i++)
         	{
				$resultado = mysql_fetch_array ($consulta);
            	$idal=$resultado['id_playa'];
				$instruccionp = "SELECT count(id_curso) from cursos where id_playa='$idal'";
				$consultap = mysql_query ($instruccionp, $conexion)
					or die ("Fallo en la consulta1as");
				$resultadop = mysql_fetch_array ($consultap);
            	$diafa=$resultadop['count(id_curso)'];
           		$data[] = array('nombre'=>$resultado['nombre_playa'], 'duracion'=>$resultado['longitud_playa'], 'alumnos'=>$diafa);
        	}
			$titles = array('nombre'=>'<b>Nombre</b>', 'duracion'=>'<b>Longitud </b>' , 'alumnos'=>'<b>Número de Cursos</b>');
		mysql_close ($conexion);
		   
	 
		  $pdf->ezText("<b>Lista de Playas</b>\n",16);
}

if ($pag=="clientes")
{		
// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ($db_host, $db_user, $db_password)
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
		mysql_select_db ($db_name)
			or die ("No se puede seleccionar la base de datos");
		$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta1");
	   
	   $nfilas = mysql_num_rows ($consulta);
		
		for ($i=0; $i<$nfilas; $i++)
		{
			$resultado = mysql_fetch_array ($consulta);
			$resulta2=$resultado['id_cliente'];
				$data[] = array('nombre'=>$resultado['nombre_cliente'], 'num'=>$resultado['apellidos_cliente']);
		}
		$titles = array('nombre'=>'<b>Nombre Cliente</b>', 'num'=>'<b>Apellido de Clientes</b>');
		mysql_close ($conexion);
		   
	 
		  $pdf->ezText("<b>Lista de Clientes</b>\n",16);	  
}

if ($pag=="contrato")
{
// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ($db_host, $db_user, $db_password)
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
		mysql_select_db ($db_name)
			or die ("No se puede seleccionar la base de datos");
	$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta1");
	$nfilas = mysql_num_rows ($consulta);
	
	for ($i=0; $i<$nfilas; $i++)
         	{
				$resultado = mysql_fetch_array ($consulta);
            	$idal=$resultado['id_monitor'];
				$instruccionp = "select nombre_monitor from monitores where id_monitor='$idal'";
				$consultap = mysql_query ($instruccionp, $conexion)
					or die ("Fallo en la consulta1as");
				$resultadop = mysql_fetch_array ($consultap);
            	$diafa=$resultado['fecha_fin_contrato'];
				$diafa=cambiaf_a_normal($diafa);
           		$data[] = array('nombre'=>$resultadop['nombre_monitor'], 'duracion'=>$resultado['duracion_contrato'], 'alumnos'=>$diafa);
        	}
			$titles = array('nombre'=>'<b>Nombre</b>', 'duracion'=>'<b>Duración </b>' , 'alumnos'=>'<b>Fecha Fin</b>');
		mysql_close ($conexion);
		   
	 
		  $pdf->ezText("<b>Lista de contrato</b>\n",16);
}

if ($pag=="material")
{		
// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ($db_host, $db_user, $db_password)
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
		mysql_select_db ($db_name)
			or die ("No se puede seleccionar la base de datos");
		$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta1");
	   
	   $nfilas = mysql_num_rows ($consulta);
		
		for ($i=0; $i<$nfilas; $i++)
		{
			$resultado = mysql_fetch_array ($consulta);
			$resulta2=$resultado['id_cliente'];
				$data[] = array('nombre'=>$resultado['nombre_material'], 'num'=>$resultado['modelo_material'], 'numa'=>$resultado['tipo_material']);
		}
		$titles = array('nombre'=>'<b>Nombre</b>', 'num'=>'<b>Modelo</b>', 'numa'=>'<b>Tipo</b>');
		mysql_close ($conexion);
		   
	 
		  $pdf->ezText("<b>Lista de Material</b>\n",16);	  
}

if ($pag=="alquiler")
{
// Conectar con el servidor de base de datos.
		$conexion = mysql_connect ($db_host, $db_user, $db_password)
			or die ("No se puede conectar con el servidor");

		// Seleccionar base de datos.
		mysql_select_db ($db_name)
			or die ("No se puede seleccionar la base de datos");
	$consulta = mysql_query ($instruccion, $conexion)
			or die ("Fallo en la consulta1");
	$nfilas = mysql_num_rows ($consulta);
	
	for ($i=0; $i<$nfilas; $i++)
         	{
				$resultado = mysql_fetch_array ($consulta);
				$idal2=$resultado['id_cliente'];
				$instruccionp2 = "select nombre_cliente from clientes where id_cliente='$idal2'";
				$consulta2 = mysql_query ($instruccion2, $conexion)
					or die ("Fallo en la consulta1as");
				$consultap2 = mysql_query ($instruccionp2, $conexion)
					or die ("Fallo en la consulta1sa");
				$resultado2 = mysql_fetch_array ($consulta2);
				$resultadop2 = mysql_fetch_array ($consultap2);
            	$diafa=$resultado['fecha_fin_alquiler'];
				$diafa=cambiaf_a_normal($diafa);
           		$data[] = array('nombre'=>$resultado2['nombre_material'],'modelo'=>$resultado2['modelo_material'],'tipo'=>$resultado2['tipo_material'], 'duracion'=>$resultadop2['nombre_cliente'], 'alumnos'=>$resultado2['sum(costo_alquiler)']);
        	}
			$titles = array('nombre'=>'<b>Nombre Material</b>','modelo'=>'<b>Modelo Material</b>','tipo'=>'<b>Tipo Material</b>', 'duracion'=>'<b>Nombre Cliente </b>' , 'alumnos'=>'<b>Suma</b>');
		mysql_close ($conexion);
		   
	 
		  $pdf->ezText("<b>Lista de Alquiler</b>\n",16);
}

$pdf->ezTable($data,$titles,'',$options );
 
$pdf->ezText("\n\n\n",10);
 
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"),10);
 
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n",10);
 
$pdf->ezStream();
?>