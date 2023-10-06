<center>
<?php
include("connect.php");
$query='select g.*,a.actividad, c.nombre, l.lugar from grilla g 
	join actividades a on 
	g.id_actividad=a.id
	join clases c on
	g.id_clase=c.id
	join lugares l on
	g.id_lugar=l.id

';
$result=mysql_query($query);
if(mysql_error()){echo mysql_error()."<br>".$query."<br>";}


echo '<table border="1">';
echo "<tr>";
	echo "<th>id</th>";
	echo "<th>dia_semana</th>";
	echo "<th>id_actividad</th>";
	echo "<th>id_lugar</th>";
	echo "<th>id_clase</th>";
	echo "<th>id_profesor</th>";
	echo "<th>hora_desde</th>";
	echo "<th>hora_hasta</th>";
	echo "<th>creado</th>";
	echo "<th>modificado</th>";
	echo "<th>observacion</th>";
echo "</tr>";

while($row=mysql_fetch_array($result)){
	echo "<tr>";
	echo '<td>'.$row["id"].'</td>';
	echo '<td>'.dia_semana($row["dia_semana"]).'</td>';
	echo '<td>'.$row["actividad"].'</td>';
	echo '<td>'.$row["lugar"].'</td>';
	echo '<td>'.$row["nombre"].'</td>';
	echo '<td>'.$row["id_profesor"].'</td>';
	echo '<td>'.date("H:i:s",$row["hora_desde"]).'</td>';
	echo '<td>'.date("H:i:s",$row["hora_hasta"]).'</td>';
	echo '<td>'.$row["creado"].'</td>';
	echo '<td>'.$row["modificado"].'</td>';
	echo '<td>'.$row["observacion"].'</td>';
	echo '<td><A HREF="grilla_ingreso.php?id_grilla='.$row["id"].'"><button>Modificar</button></A></td>';
	echo '<td><A HREF="grilla_eliminar.php?id_grilla='.$row["id"].'"><button>Eliminar</button></A></td>';
	echo "</tr>".chr(10);
}



function dia_semana($num){
	if($num==1){
		return "Lunes";
	}
	if($num==2){
		return "Martes";
	}
	if($num==3){
		return "Miercoles";
	}
	if($num==4){
		return "Jueves";
	}
	if($num==5){
		return "Viernes";
	}
	if($num==6){
		return "Sabado";
	}
	if($num==7){
		return "Domingo";
	}

}












?>
</table></center>
