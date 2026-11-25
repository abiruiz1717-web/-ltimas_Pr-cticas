<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Tabla de calificaciones</title>
</head>
<body>
	<h2>Crear una tabla de 5 alumnos</h2>
	<form method="POST">
		<label>Introduzca el nombre del alumno:</label>
		<input type="text" name="nm" id="nm">
		<br>
		<label>Calificación de la primera unidad:</label>
		<input type="number" min=5 max=10 name="c1" id="c1">
		<br>
		<label>Calificación de la segunda unidad:</label>
		<input type="number" min=5 max=10 name="c2" id="c2">
		<br>
		<label>Calificación de la tercera unidad:</label>
		<input type="number" min=5 max=10 name="c3" id="c3">
		<br><br>

		<button type="button" onclick="agregar()">Agregar</button>
		<input type="hidden" name="datosNM" id="datosNM">
		<input type="hidden" name="datosC1" id="datosC1">
		<input type="hidden" name="datosC2" id="datosC2">
		<input type="hidden" name="datosC3" id="datosC3">
		<br><br>
		<p id="mensaje">Alumnos registrados: 0 de 5</p>
		<button type="submit" name="guardar" id="guardar" disabled>Guardar datos</button>
	</form>
	<script>
		let alumnos=[];
		let calificacion1=[];
		let calificacion2=[];
		let calificacion3=[];
		function agregar() {
			let nm=document.getElementById("nm").value;
			let c1=document.getElementById("c1").value;
			let c2=document.getElementById("c2").value;
			let c3=document.getElementById("c3").value;
			if (nm=="") {
				alert("Escriba un nombre");
				return;
			}
			if (c1=="" || c2=="" || c3=="") {
				alert("Escriba una calificación de 5-10");
				return;
			}
			if (alumnos.length<5) {
				alumnos.push(nm);calificacion1.push(c1);calificacion2.push(c2);calificacion3.push(c3)
				document.getElementById("datosNM").value=JSON.stringify(alumnos);
				document.getElementById("nm").value="";
				document.getElementById("datosC1").value=JSON.stringify(calificacion1);
				document.getElementById("c1").value="";
				document.getElementById("datosC2").value=JSON.stringify(calificacion2);
				document.getElementById("c2").value="";
				document.getElementById("datosC3").value=JSON.stringify(calificacion3);
				document.getElementById("c3").value="";

				document.getElementById("mensaje").innerHTML="Alumnos registrados: "+alumnos.length+" de 5";
				if (alumnos.length==5) {
					document.getElementById("guardar").disabled=false;
					document.getElementById("mensaje").innerHTML="Ya ha registrado los 5 alumnos";
				}
			}
		}
	</script>
	<?php
	$guardarNM=$_POST['datosNM']??'';
	$guardarC1=$_POST['datosC1']??'';
	$guardarC2=$_POST['datosC2']??'';
	$guardarC3=$_POST['datosC3']??'';
	if (isset($_POST['guardar'])) {
		$vectorNM=json_decode($_POST['datosNM'],true);$vectorC1=json_decode($_POST['datosC1'],true);$vectorC2=json_decode($_POST['datosC2'],true);$vectorC3=json_decode($_POST['datosC3'],true);
	}
	?>
	<br><br>
	<form method="POST">
		<input type="hidden" name="datosNM" value='<?php echo $guardarNM;?>'>
		<input type="hidden" name="datosC1" value='<?php echo $guardarC1;?>'>
		<input type="hidden" name="datosC2" value='<?php echo $guardarC2;?>'>
		<input type="hidden" name="datosC3" value='<?php echo $guardarC3;?>'>
    <button type="submit" name="tabla" value="tabla">Crear tabla</button>
     	<?php
     	if (isset($_POST['tabla'])) {
     		$vectorNM=json_decode($_POST['datosNM'],true);
     		$vectorC1=json_decode($_POST['datosC1'],true);
     		$vectorC2=json_decode($_POST['datosC2'],true);
     		$vectorC3=json_decode($_POST['datosC3'],true);
     		?>
     		<table border="1">
				<tr>
					<th>Alumno</th>
					<th>Unidad 1</th>
					<th>Unidad 2</th>
					<th>Unidad 3</th>
					<th>Promedio</th>
					<th>Aprobó/Reprobó</th>
				</tr>
     		<?php
     		$tP=0;$tU1=0;$tU2=0;$tU3=0;$aA=0;$aR=0;
			for ($i=0;$i<count($vectorNM);$i++){
				$p=($vectorC1[$i]+$vectorC2[$i]+$vectorC3[$i])/3;
				$tP+=($vectorC1[$i]+$vectorC2[$i]+$vectorC3[$i])/3;
				$tU1+=$vectorC1[$i];$tU2+=$vectorC2[$i];$tU3+=$vectorC3[$i];
				echo "<tr><td>".$vectorNM[$i]."</td>";
				echo "<td align='center'>",$vectorC1[$i],"</td>";
				echo "<td align='center'>",$vectorC2[$i],"</td>";
				echo "<td align='center'>",$vectorC3[$i],"</td>";
				echo "<td align='center'>",number_format($p,1),"</td>";
				if ($p>=6) {
					echo "<td>Aprobó</td></tr>";
					$aA++;
				}
				else {
					echo "<td>Reprobó</td></tr>";
					$aR++;
				}
			}
			?>
		</table>
	<?php
	echo "<br>Promedio general del grupo: ",number_format($tP/5,1);
	echo "<br>Promedio de 1ra unidad: ",number_format($tU1/5,1);
	echo "<br>Promedio de 2da unidad: ",number_format($tU2/5,1);
	echo "<br>Promedio de 3ra unidad: ",number_format($tU3/5,1);
	echo "<br>Total de alumnos aprobados: ",$aA;
	echo "<br>Total de alumnos reprobados: ",$aR;
}
?>
</body>
</html>