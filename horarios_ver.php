<center>
<?php
include("connect.php");
include("funciones.php");

/*
traer nombre de clase
listado de dias y horas
*/

echo '<table border="1">';



$q='select * from grilla where id_clase='.$_GET["id_clase"].' order by hora_desde, dia_semana';
//echo $q."<br>";
$res=mysql_query($q);
if(mysql_error()){echo "$q <br>".mysql_error();}

while($row=mysql_fetch_array($res)){
	echo '<tr>';
	echo "<td>".dia_semana($row["dia_semana"])."</td>";
	echo "<td>".date("H:i:s",$row["hora_desde"])."</td>";
	echo "<td>".date("H:i:s",$row["hora_hasta"])."</td>";
	echo '<td><button>Modificar</button></td>';
	echo '<td><button>Eliminar</button></td>';
	echo '</tr>';
}



?>

</table>