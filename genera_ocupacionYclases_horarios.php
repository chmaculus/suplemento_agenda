<?php

/*
1s1m1h1d 
#------------------------------------------
#:::::::1s1m1h1d 
infantil
tenis c:29 --
futbol 4 a 8 c:50 --
desarrollo motor c:104 *
patinaje artistico c:101 *


insert into clases (ActividadID, FrecuenciaID, Mostrar, Nombre, Subtitulo, Descripcion, Capacidad, TipoID, PrecioID, Actualizado, EdadID) values ('51', '2', '1', 'FUTBOL DE SALON', '', '', '100', '1', '1961', '1629834214', '3');



2021-08-18
alter table actividades disable keys;
insert into actividades set id=14, actividad="DANZA NIÑOS", path="actcaminatas", activado=1;
alter table actividades enable keys;

insert into lugares_actividad set lugarid=24, actividadid=10;
insert into lugares_actividad set lugarid=24, actividadid=7;


#-------------------------------------------------------
consulta que trae el listado de actividades
select
	c.ID as idClase,
	a.*,
	EdadID as id_rango_edad
from
	clases_horarios h
inner join clases c on
	c.ID = h.ClaseID
inner join actividades a on
	c.ActividadID = a.ID
inner join clases_vigencia cv on
	cv.ClaseID = c.ID
where
	FROM_UNIXTIME(Hasta) > CURDATE()
	and from_unixtime(Vigencia_hasta) > curdate()
group by
	EdadID,
	ActividadID
order by
	EdadID ;
#-------------------------------------------------------






*/


include("connect.php");
//date_default_timezone_set("UTC");
date_default_timezone_set("America/Argentina/Buenos_Aires");


echo "#".date("Y-m-d H:i:s")."<br>";


$mes=9;
$anio=2023;
/* comparar epoch generado con epoch de base de datos posible generador de errores */


$dias=cal_days_in_month(CAL_GREGORIAN, $mes, $anio);

echo "#dias $dias \n";

$vigencia_desde=mktime(0,0,0,$mes,1,$anio);
//$vigencia_desde=$vigencia_desde+10800;//cocrreccion hora servidor
echo "#vigencia desde: ".$vigencia_desde."<br>";

$vigencia_hasta=mktime(23,59,59,$mes,$dias,$anio);
//$vigencia_hasta=$vigencia_hasta+10800;//correccion hora servidor
echo "#vigencia hasta: ".$vigencia_hasta."<br>";

$excec=0;


#---------------------------------------------------------------
#ocupacion y clases_horarios
$q2='select distinct id_clase from grilla where id_clase=134 order by id_actividad, hora_desde';

 //$q2='select distinct id_clase from grilla order by id_actividad, hora_desde';

echo "# ".$q2.";<br>";


$res2=mysql_query($q2);
if(mysql_error()){echo mysql_error();}

	while($row2=mysql_fetch_array($res2)){
		echo "#------------------------------------------------------------<br>";
		echo "#id clase: ".$row2["id_clase"]."<br>";

		//$aa=mysql_result(mysql_query('select * from grilla where '),0,0)

		#------------------------------------------------------------
		#vigencias
		$q='update clases_vigencia set Estado="0" where Estado = 1 AND ClaseID ="'.$row2["id_clase"].'"';
		if($excec==1){
				//mysql_query($q);if(mysql_error()){echo mysql_error()."<br>";}
				//echo $q.";<br><br>";
		}
		echo $q.";<br><br>";

		$q='insert into clases_vigencia set Estado="1", ClaseID ="'.$row2["id_clase"].'", vigencia_desde="'.$vigencia_desde.'", vigencia_hasta="'.$vigencia_hasta.'"';
		if($excec==1){
				//mysql_query($q);if(mysql_error()){echo mysql_error()."<br>";}
		}
		echo $q.";<br><br>";
		#------------------------------------------------------------




		for($i=1;$i<=$dias;$i++){
			echo "#count dia: ".$i."<br>";
			$fechaf=mktime(0,0,0,$mes,$i,$anio);
			$fechaf=$fechaf+3600;//correccion hora servidos

			$ddia=date("N",$fechaf);
			$q='select * from grilla where id_clase="'.$row2["id_clase"].'" and dia_semana="'.$ddia.'"';
			echo "#".$q.";<br>";
			$res3=mysql_query($q);

			while($row3=mysql_fetch_array($res3)){
				$hdesde=$fechaf+$row3["hora_desde"];
				//$hdesde=$hdesde+(2*60*60);//correccion hora servidor

				$hhasta=$fechaf+$row3["hora_hasta"]-1;
				//$hhasta=$hhasta+(2*60*60);//correccion hora servidor
				//echo date("Y-m-d H:i:s",$hdesde)." ".date("Y-m-d H:i:s",($hhasta))."<br>";
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
			

			if($excec==1){
				mysql_query($q);if(mysql_error()){echo mysql_error()."<br>";}
			}
			echo $q.";<br><br>";
		}// end while
	}//end foreach dias

}//end while grilla
#---------------------------------------------------------------

/*
SELECT
	c.ID as idClase,
	a.*,
	EdadID AS id_rango_edad
FROM
	clases_horarios h
INNER JOIN
                 clases c ON
	c.ID = h.ClaseID
INNER JOIN
                 actividades a ON
	c.ActividadID = a.ID
INNER JOIN
                 clases_vigencia cv ON
	cv.ClaseID = c.ID
WHERE
	FROM_UNIXTIME(Hasta) > CURDATE()
	AND from_unixtime(Vigencia_hasta) > curdate()
GROUP BY
	EdadID,
	ActividadID
ORDER BY
	EdadID;



SELECT
	c.ID as idClase,
	a.*,
	EdadID AS id_rango_edad
FROM
	clases_horarios h, clases c , actividades a , clases_vigencia cv 
WHERE
	FROM_UNIXTIME(Hasta) > CURDATE()
	AND from_unixtime(Vigencia_hasta) > CURDATE() 
	AND c.ID = h.ClaseID
	AND c.ActividadID = a.ID
	AND cv.ClaseID = c.ID
GROUP BY
	EdadID,
	ActividadID
ORDER BY
	actividad desc;

SELECT
	c.ID as idClase,
	a.*,
	EdadID AS id_rango_edad
FROM
	clases_horarios h, clases c , actividades a , clases_vigencia cv 
WHERE
	FROM_UNIXTIME(Hasta) > "2021-03-01"
	AND from_unixtime(Vigencia_hasta) > "2021-07-01" 
	AND c.ID = h.ClaseID
	AND c.ActividadID = a.ID
	AND c.ID = cv.ClaseID 
GROUP BY
	EdadID,
	ActividadID
ORDER BY
	actividad desc;

SELECT
	c.ID as idClase,
	a.*,
	EdadID AS id_rango_edad
FROM
	clases_horarios h, clases c , actividades a , clases_vigencia cv 
WHERE
	FROM_UNIXTIME(Hasta) > "2021-07-01"
	AND from_unixtime(Vigencia_hasta) > "2021-07-01" 
	AND c.ID = h.ClaseID
	AND c.ActividadID = a.ID
	AND c.ID = cv.ClaseID 
GROUP BY
	EdadID,
	ActividadID
ORDER BY
	actividad desc;


select
	c.ID,
	h.Desde ,
	h.Hasta
FROM
	clases_horarios h,
	clases c ,
	actividades a ,
	clases_vigencia cv
where
	FROM_UNIXTIME(Hasta) > "2021-03-01"
	AND from_unixtime(Vigencia_hasta) > "2021-03-01" 
	and c.ID = cv.ClaseID
	AND c.ID = h.ClaseID
	and (c.id = 95
		or c.id = 25
		or c.id = 29
		or c.id = 30
		or c.id = 31
		)
		group by c.ID 
order by
	Desde ,
	hasta
;



select * FROM clases_vigencia cv where ClaseID =95 order by Vigencia_desde desc;

select * FROM clases_vigencia cv where ClaseID =25 order by Vigencia_desde desc;

select * FROM clases_vigencia cv where ClaseID =29 order by Vigencia_desde desc;

select * FROM clases_vigencia cv where ClaseID =30 order by Vigencia_desde desc;

select * FROM clases_vigencia cv where ClaseID =31 order by Vigencia_desde desc;

select * from clases c where Activado_clases =1;

select * from actividades;

select * from clases_horarios ch where ClaseID =95 order by desde DESC ;

select * from clases_horarios ch where ClaseID =25 order by desde DESC ;

select * from clases_horarios ch where ClaseID =29 order by desde DESC ;

select * from clases_horarios ch where ClaseID =30 order by desde DESC ;

select * from clases_horarios ch where ClaseID =31 order by desde DESC ;

select
	*
from
	clases_horarios ch
where
	(ClaseID = 95
		or ClaseID = 25 or ClaseID = 29 or ClaseID = 30 or ClaseID = 31)
		group by Desde ,hasta
	order by
		desde DESC ;



*/





?>