<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro de alumnos</title>
</head>
<body>
	<h2>Registro de alumnos de 3°A Programación</h2>
	<form method="POST">
		Nombre del alumno:
		<input type="text" name="nombre">
		<br><br>
		Edad del alumno:
		<input type="text" name="edad">
		<br><br>
		Pasatiempo del alumno:
		<input type="text" name="pasatiempo">
		<br><br>
		<button type="submit" name="guardar">Guardar</button>
	</form>
	<?php
	if (isset($_POST["guardar"])) {
		$nombre=$_POST["nombre"];
		$edad=$_POST["edad"];
		$pasatiempo=$_POST["pasatiempo"];
		file_put_contents("nombres.txt", $nombre.PHP_EOL, FILE_APPEND);
		file_put_contents("edades.txt", $edad.PHP_EOL, FILE_APPEND);
		file_put_contents("pasatiempos.txt", $pasatiempo.PHP_EOL, FILE_APPEND);
		echo "<p>Datos guardados correctamente.</p>";
	}
	?>
	<h3>Nombres registrados</h3>
	<?php
	if (file_exists("nombres.txt")) {
		$nombres=file_get_contents("nombres.txt");
		echo nl2br($nombres);
	}
	else {
		echo "No existen registros.";
	}
	?>

	<h3>Edades registradas</h3>
	<?php
	if (file_exists("edades.txt")) {
		$edades=file_get_contents("edades.txt");
		echo nl2br($edades);
	}
	else {
		echo "No existen registros.";
	}
	?>

	<h3>Pasatiempos registrados</h3>
	<?php
	if (file_exists("pasatiempos.txt")) {
		$pasatiempos=file_get_contents("pasatiempos.txt");
		echo nl2br($pasatiempos);
	}
	else {
		echo "No existen registros.";
	}
	?>
	<form method="POST">
		<button type="submit" name="limpiar">Limpiar</button>
	</form>
	<?php
	if (isset($_POST["limpiar"])) {
		file_put_contents("nombres.txt", "");
		file_put_contents("edades.txt", "");
		file_put_contents("pasatiempos.txt", "");
	}
	?>
</body>
</html>