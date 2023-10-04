<script type="application/javascript">
	function validarFormulario() {
		var selectInput = document.getElementById('tipo_contrato');
		var selectedOption = selectInput.options[selectInput.selectedIndex].value;
		if (selectedOption === '') {
			alert('Seleccione una opción en tipo de clase');
			return false;
		}

		var selectInput = document.getElementById('frecuencia');
		var selectedOption = selectInput.options[selectInput.selectedIndex].value;
		if (selectedOption === '') {
			alert('Seleccione una opción en frecuencia');
			return false;
		}

		var selectInput = document.getElementById('rango_edades');
		var selectedOption = selectInput.options[selectInput.selectedIndex].value;
		if (selectedOption === '') {
			alert('Seleccione una opción en publico destinado');
			return false;
		}

		var selectInput = document.getElementById('id_lugar');
		var selectedOption = selectInput.options[selectInput.selectedIndex].value;
		if (selectedOption === '') {
			alert('Seleccione una opción en lugar');
			return false;
		}
		
		var selectInput = document.getElementById('desde');
		var selectedOption = selectInput.options[selectInput.selectedIndex].value;
		if (selectedOption === '') {
			alert('Seleccione una opción en hora desde');
			return false;
		}
		
		var selectInput = document.getElementById('hasta');
		var selectedOption = selectInput.options[selectInput.selectedIndex].value;
		if (selectedOption === '') {
			alert('Seleccione una opción en hora hasta');
			return false;
		}
		
		// return true;
	}
</script>


<?php
include("connect.php");
?>


<center>
<form action="update.php" method="post" enctype="multipart/form-data" id="myForm" onsubmit="return validarFormulario();">
<table border="1">
<tr>
	<td>Nombre Clase</td>
	<td><input type="text" name="clase" required></td>
</tr>
<tr>
	<td>Descripcion</td>
	<td><input type="text" name="descripcion"  required></td>
</tr>
<tr>
	<td>Tipo de clase</td>
	<td>
		<select name="tipo_contrato" id="tipo_contrato">
		<option value="" label="" selected>Seleccione tipo</option>
		<?php
		$res=mysql_query("select * from tipo_contrato");
		if(mysql_error()){echo mysql_error();}
		while($row=mysql_fetch_array($res)){
			echo '<option value="'.$row[0].'" label="'.$row[1].'">'.$row[1].'</option>';
		}
		?>
		</select>
	</td>
</tr>
<tr>
	<td>Frecuencia</td>
	<td>
		<select name="frecuencia" id="frecuencia">
		<option value="" label="" selected>Seleccione frecuencia</option>
		<?php
		$res=mysql_query("select * from frecuenciaclases");
		if(mysql_error()){echo mysql_error();}
		while($row=mysql_fetch_array($res)){
			echo '<option value="'.$row[0].'" label="'.$row[1].'"></option>';
		}
		?>
		</select>
	</td>
</tr>
<tr>
	<td>Publico destinado</td>
	<td>
		<select name="rango_edades" id="rango_edades">
		<option value="" label="" selected  required="">Seleccione publico</option>
		<?php
		$res=mysql_query("select * from rango_edades");
		if(mysql_error()){echo mysql_error();}
		while($row=mysql_fetch_array($res)){
			echo '<option value="'.$row[0].'" label="'.$row[1].'"></option>';
		}
		?>
		</select>
	</td>
</tr>
<tr>
	<td>Capacidad personas</td>
	<td>
		<input type="text" name="capacidad" size="5"  required>
	</td>
</tr>

<tr>
	<td>Lugar</td>
	<td>
		<select name="id_lugar" id="id_lugar">
		<option value="" label="" selected>Seleccione lugar</option>
		<?php
		$res=mysql_query("select * from lugares where Activado_lugar=1 order by Lugar");
		if(mysql_error()){echo "je: ".mysql_error();}
		while($row=mysql_fetch_array($res)){
			echo '<option value="'.$row[0].'" label="'.$row[2].'">'.$row[2].'</option>';
		}
		?>
		</select>
	</td>
</tr>

<tr>
	<td>Activada</td>
	<td><input type="checkbox" name="activada" value="1" checked></td>
</tr>

<tr>
	<td>Descripcion Precio</td>
	<td><input type="text" name="descripcion_precio" size="30"></td>
</tr>

<tr>
	<td>Precio</td>
	<td><input type="text" name="precio" size="5" required></td>
</tr>

<tr>
	<td>Clase Dias y hora</td>
	<td>
		<table border="1">
		<tr>
			<td>Lunes</td>
			<td><input type="checkbox" name="lun" value="1"></td>
		</tr>
		<tr>
			<td>Martes</td>
			<td><input type="checkbox" name="mar" value="1"></td>
		</tr>
		<tr>
			<td>Miercoles</td>
			<td><input type="checkbox" name="mie" value="1"></td>
		</tr>
		<tr>
			<td>Jueves</td>
			<td><input type="checkbox" name="jue" value="1"></td>
		</tr>
		<tr>
			<td>Viernes</td>
			<td><input type="checkbox" name="vie" value="1"></td>
		</tr>
		<tr>
			<td>Sabado</td>
			<td><input type="checkbox" name="sab" value="1"></td>
		</tr>
		<tr>
			<td>Domingo</td>
			<td><input type="checkbox" name="dom" value="1"></td>
		</tr>
		</table>


		<table border="1">

		<tr>
			<td>Desde</td>
			<td><select name="desde" id="desde">
			<option value="" label="" selected>Seleccione Hora desde</option>
			<?php
				for($i=0;$i<=23;$i++){
					for($j=0;$j<=45;$j=$j+15){
						$aa=($i*60*60)+($j*60);
						if(strlen($i)==1){$ab="0".$i;}else{$ab=$i;}
						if(strlen($j)==1){$ac="0".$j;}else{$ac=$j;}
						echo '<option value="'.$aa.'" label="'.$ab.":".$ac.'"</option>'.chr(10);
					}
				}
			?>
			</select></td>
		</tr>

		<tr>
			<td>Hasta</td>
			<td><select name="hasta" id="hasta">
			<option value="" label="" selected>Seleccione Hora hasta</option>
			<?php
				for($i=0;$i<=23;$i++){
					for($j=0;$j<=45;$j=$j+15){
						$aa=($i*60*60)+($j*60);
						if(strlen($i)==1){$ab="0".$i;}else{$ab=$i;}
						if(strlen($j)==1){$ac="0".$j;}else{$ac=$j;}
						echo '<option value="'.$aa.'" label="'.$ab.":".$ac.'"</option>'.chr(10);
					}
				}
			?>
			</select></td>
		</tr>

		</table>
	</td>
</tr>

<tr>
	<td>Permite descuento</td>
	<td><input type="checkbox" name="permite_descuento" value="1" ></td>
</tr>

<tr>
	<td>Mostrar en asistencias</td>
	<td><input type="checkbox" name="mostrar_asistencia" value="1"></td>
</tr>

</table>
<input type="submit" name="ACEPTAR" value="ACEPTAR">
</form>


