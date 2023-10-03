<?php



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

// exit;















include("connect.php");

if($_POST["activada"]==1){
	$activada=1;
}else{
	$activada=0;
}


$q='insert into actividades actividad='.$_POST["clase"].', 
    activado='.$activada.', 
    mostrar_asistencias='.$_POST["mostrar_asistencia"].'
    ';
mysql_query($q);
if(mysql_error()){echo mysql_error()."<br>";}
$last_id_actividad=mysql_insert_id($id_connection);

$q='insert into lista_precios_actividades set
                Descripcion="'.$_POST["descripcion_precio"].'",
                Parent="99999",
                ActividadID="'.$last_id_actividad.'",
                UnidadID="5",
                Precio="'.$_POST["precio"].'",
                Actualizado="'.time().'",
                Activado_lpa='.$activada.',
                permite_descuento="'.$_POST["permite_descuento"].'",
                mostrar="1"
';
echo $q."<br>";
// mysql_query($q);
// if(mysql_error()){echo mysql_error()."<br>";}
// $last_id_precio=mysql_insert_id($id_connection);



$q='insert into clases set nombre="'.$_POST["clase"].'",
            ActividadID="'.$last_id.'",
            mostrar='.$activada.',
            Descripcion="'.$_POST["descripcion"].'",
            TipoID="'.$_POST["tipo_contrato"].'",
            PrecioID="'.$last_id_precio.'",
            capacidad="'.$_POST["capacidad"].'",
            Actualizado="'.time().'",
            Activado__clases='.$activada.',
            EdadID="'.$_POST["rango_edades"].'",
            vigencia_desde="'.time().'",
            vigencia_hasta="'.time()+(60*60*24*365).'"
';
echo $q."<br>";
// mysql_query($q);
// if(mysql_error()){echo mysql_error()."<br>";}
// $last_id_clase=mysql_insert_id($id_connection);

$q='insert into clases_vigencia set ClaseID="'.$last_id_clase.'"
			Vigencia_desde="'.time().'",
			Vigencia_hasta="'.time()+(60*60*24*365).'",
			Estado="1"
';
echo $q."<br>";
// mysql_query($q);
// if(mysql_error()){echo mysql_error()."<br>";}

$q='insert into lugares_actividad set 
						LugarID="'.$_POST["id_lugar"].'",
						ActividadID="'.$last_id_actividad.'",
						Actualizado="'.time().'"

';
echo $q."<br>";
// mysql_query($q);
// if(mysql_error()){echo mysql_error()."<br>";}


/*
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