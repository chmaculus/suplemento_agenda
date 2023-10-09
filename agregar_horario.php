<center>
	<form method="post" action="update_horario.php">
<table border ="1">
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
<input type="submit" name="ACEPTAR" value="ACEPTAR">

</form>

