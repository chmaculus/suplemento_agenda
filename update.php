<?php


$now=time();


echo "clase: ".$_POST["clase"]."<br>";
echo "tipo: ".$_POST["tipo_clase"]."<br>";
echo "frecuencia: ".$_POST["frecuencia"]."<br>";
echo "rango_edades: ".$_POST["rango_edades"]."<br>";
echo "capacidad: ".$_POST["capacidad"]."<br>";
echo "id_lugar: ".$_POST["id_lugar"]."<br>";
echo "activada: ".$_POST["activada"]."<br>";
echo "mostrar_asistencia: ".$_POST["mostrar_asistencia"]."<br>";
echo "descripcion_precio: ".$_POST["descripcion_precio"]."<br>";
echo "lun: ".$_POST["lun"]."<br>";
echo "mar: ".$_POST["mar"]."<br>";
echo "mie: ".$_POST["mie"]."<br>";
echo "jue: ".$_POST["jue"]."<br>";
echo "vie: ".$_POST["vie"]."<br>";
echo "sab: ".$_POST["sab"]."<br>";
echo "dom: ".$_POST["dom"]."<br>";


include("connect.php");

$dias=cal_days_in_month(CAL_GREGORIAN, date("n"), date("Y"));

$epoch=mktime(0,0,0,date("n"),1,date("Y"));
$epochmastres=$epoch+(60*60*24*120);



if($_POST["activada"]==1){
	$activada=1;
}else{
	$activada=0;
}

if($_POST["permite_descuento"]==1){
	$permite_descuento=1;
}else{
	$permite_descuento=0;
}

if($_POST["mostrar_asistencia"]==1){
	$mostrar_asistencia=1;
}else{
	$mostrar_asistencia=0;
}


$q='insert into actividades set 
	actividad="'.$_POST["clase"].'",
	path="test",
    activado='.$activada.', 
    mostrar_asistencias='.$mostrar_asistencia.'
    ';
echo "q1: ".$q."<br>";
mysql_query($q);
if(mysql_error()){echo mysql_error()."<br>";}
$last_id_actividad=mysql_insert_id($id_connection);

$q='insert into lista_precios_actividades set
                Descripcion="'.$_POST["descripcion_precio"].'",
                Parent=99999,
                ActividadID='.$last_id_actividad.',
                UnidadID=5,
                Precio='.$_POST["precio"].',
                Actualizado='.$now.',
                Activado_lpa='.$activada.',
                permite_descuento='.$permite_descuento.',
                mostrar=1';
echo "q2: ".$q."|<br>";
mysql_query($q);
if(mysql_error()){echo mysql_error()."<br>";}
$last_id_precio=mysql_insert_id($id_connection);



$q='insert into clases set nombre="'.$_POST["clase"].'",
            ActividadID='.$last_id_actividad.',
            mostrar='.$activada.',
            Descripcion="'.$_POST["descripcion"].'",
            TipoID='.$_POST["tipo_contrato"].',
            PrecioID='.$last_id_precio.',
            capacidad='.$_POST["capacidad"].',
            Actualizado='.$now.',
            Activado_clases='.$activada.',
            EdadID='.$_POST["rango_edades"].',
			FrecuenciaID='.$_POST["frecuencia"].',
			Subtitulo="Test",
			parent=99999,
            vigencia_desde='.$now.',
            vigencia_hasta='.($now+(60*60*24*365));


echo "q33: ".$q."|<br>";
mysql_query($q);
if(mysql_error()){echo mysql_error()."<br>";}
$last_id_clase=mysql_insert_id($id_connection);







for($epoch;$epoch <= $epochmastres;$epoch=$epoch+(60*60*24)){

	echo $epoch."<br>";
	$epoch_desde=$epoch+$_POST["desde"];
	$epoch_hasta=$epoch+$_POST["hasta"];
	echo "desde: ".date("Y-m-d H:i:s", $epoch_desde)."<br>";
	echo "hasta: ".date("Y-m-d H:i:s", $epoch_hasta)."<br>";

	#------------------------------------------------
	if($_POST["lun"]==1 and date("N",$epoch)==1){
		$q='insert into ocupacion set 
							LugarID='.$_POST["id_lugar"].', 
							Desde='.$epoch_desde.', 
							Hasta='.$epoch_hasta.', 
							tipo=1, 
							UsuarioID=100001, 
							Usuario_extraID=0, 
							Precio_reserva=0, 
							Precio_cantidad_ID=0, 
							Precio_servicios=0,
							Actualizado='.$now.',
							Creado='.$now.',
							Estado=0,
							Facturado=0,
							OperadorNombre="Gen1",
							Observaciones="generador alternativo de clase",
							Fecha_enviado=0,
							COD_RES=0
							 ';
		echo "ucu1: $q <br> ";
		mysql_query($q);
		if(mysql_error()){echo mysql_error()."<br>";}
		$last_id_ocupacion=mysql_insert_id($id_connection);
		$q='insert into clases_horarios (Desde,
					Hasta,
					ClaseID,
					OcupacionID,
					Tipo,
					Estado_ch,
					GrupoID)
					values ("'.$epoch_desde.'",
					"'.$epoch_desde.'",
					"'.$last_id_clase.'",
					'.$last_id_ocupacion.',
					"2",
					"0",
					"'.$now.'")';
		echo "clase hora: $q <br> ";
		mysql_query($q);
		if(mysql_error()){echo mysql_error()."<br>";}
	}
	#fin lunes
	#------------------------------------------------
}



















#------------------------------------------------------
if($_POST["lun"]==1){
	$q='insert into grilla set 
						dia_semana=1,
						id_actividad='.$last_id_actividad.',
						id_lugar='.$_POST["id_lugar"].',
						id_clase='.$last_id_clase.',
						hora_desde='.$_POST["desde"].',
						hora_hasta='.$_POST["hasta"].',
						creado='.$now.'

	';
	echo $q."<br>";
	mysql_query($q);
	if(mysql_error()){echo mysql_error()."<br>";}
}


if($_POST["mar"]==1){
	$q='insert into grilla set 
						dia_semana=2,
						id_actividad='.$last_id_actividad.',
						id_lugar='.$_POST["id_lugar"].',
						id_clase='.$last_id_clase.',
						hora_desde='.$_POST["desde"].',
						hora_hasta='.$_POST["hasta"].',
						creado='.$now.'

	';
	echo $q."<br>";
	mysql_query($q);
	if(mysql_error()){echo mysql_error()."<br>";}
}


if($_POST["mie"]==1){
	$q='insert into grilla set 
						dia_semana=3,
						id_actividad='.$last_id_actividad.',
						id_lugar='.$_POST["id_lugar"].',
						id_clase='.$last_id_clase.',
						hora_desde='.$_POST["desde"].',
						hora_hasta='.$_POST["hasta"].',
						creado='.$now.'

	';
	echo $q."<br>";
	mysql_query($q);
	if(mysql_error()){echo mysql_error()."<br>";}
}


if($_POST["jue"]==1){
	$q='insert into grilla set 
						dia_semana=4,
						id_actividad='.$last_id_actividad.',
						id_lugar='.$_POST["id_lugar"].',
						id_clase='.$last_id_clase.',
						hora_desde='.$_POST["desde"].',
						hora_hasta='.$_POST["hasta"].',
						creado='.$now.'

	';
	echo $q."<br>";
	mysql_query($q);
	if(mysql_error()){echo mysql_error()."<br>";}
}


if($_POST["vie"]==1){
	$q='insert into grilla set 
						dia_semana=5,
						id_actividad='.$last_id_actividad.',
						id_lugar='.$_POST["id_lugar"].',
						id_clase='.$last_id_clase.',
						hora_desde='.$_POST["desde"].',
						hora_hasta='.$_POST["hasta"].',
						creado='.$now.'

	';
	echo $q."<br>";
	mysql_query($q);
	if(mysql_error()){echo mysql_error()."<br>";}
}


if($_POST["sab"]==1){
	$q='insert into grilla set 
						dia_semana=6,
						id_actividad='.$last_id_actividad.',
						id_lugar='.$_POST["id_lugar"].',
						id_clase='.$last_id_clase.',
						hora_desde='.$_POST["desde"].',
						hora_hasta='.$_POST["hasta"].',
						creado='.$now.'

	';
	echo $q."<br>";
	mysql_query($q);
	if(mysql_error()){echo mysql_error()."<br>";}
}


if($_POST["dom"]==1){
	$q='insert into grilla set 
						dia_semana=7,
						id_actividad='.$last_id_actividad.',
						id_lugar='.$_POST["id_lugar"].',
						id_clase='.$last_id_clase.',
						hora_desde='.$_POST["desde"].',
						hora_hasta='.$_POST["hasta"].',
						creado='.$now.'

	';
	echo $q."<br>";
	mysql_query($q);
	if(mysql_error()){echo mysql_error()."<br>";}
}


#------------------------------------------------------


$q='insert into clases_vigencia set 
			ClaseID="'.$last_id_clase.'",
			Vigencia_desde='.$now.',
			Vigencia_hasta='.($now+(60*60*24*365)).',
			Estado=1
';
echo $q."<br>";
mysql_query($q);
if(mysql_error()){echo mysql_error()."<br>";}

$q='insert into lugares_actividad set 
						LugarID="'.$_POST["id_lugar"].'",
						ActividadID="'.$last_id_actividad.'",
						Actualizado="'.$now.'"

';
echo $q."<br>";
mysql_query($q);
if(mysql_error()){echo mysql_error()."<br>";}


/*
tabla grilla
tabla clases
tabla actividades
tabla lista_precio_actividades
tabla clases_vigencia
tabla ocupacion
tabla clases_horarios
tabla lugares_actividad

clase
espacio donde se practica
precios de la clase
horarios
capacidad x clase






actualizar clases_vigencia
				$q='insert 	into
				ocupacion (Desde,
	 			Hasta,
				Tipo,
				UsuarioID,
				Usuario_extraID,
				Observaciones,
				Actualizado,
				Creado,
				Facturado,
				Fecha_enviado,
				COD_RES,
				OperadorNombre,
				Precio_reserva,
				Precio_servicios,
				Precio_cantidad_ID,
				LugarID,
				Estado)
				values ("'.$hdesde.'",
				"'.$hhasta.'",
				"2",
				"100000",
				"0",
				"0",
				"'.$vigencia_desde.'",
				"'.$vigencia_desde.'",
				"0",
				"0",
				"0",
				"OCUPACION CLONADAA",
				"0",
				"0",
				"0",
				"'.$row3["id_lugar"].'",
				"0")';

				if($excec==1){
					mysql_query($q);if(mysql_error()){echo mysql_error()."<br>";}
				}
			echo $q.";<br><br>";
			
			//$hdesde=$hdesde+(5*60*60);//correccion hora servidor
			//$hhasta=$hhasta+(5*60*60);//correccion hora servidor

			
			$q='insert
			into
			clases_horarios (Desde,
			Hasta,
			ClaseID,
			OcupacionID,
			Tipo,
			Estado_ch,
			GrupoID)
			values ("'.$hdesde.'",
			"'.$hhasta.'",
			"'.$row3["id_clase"].'",
			last_insert_id(),
			"2",
			"0",
			"'.$vigencia_desde.'")';
			


*/



?>