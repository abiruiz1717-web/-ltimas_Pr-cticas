<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Guardar información</title>
</head>
<body>
	<h2>Guardar información en un archivo</h2>

<?php
	$nombre="Laila Cossio";
	file_put_contents("alumnos.txt",$nombre.PHP_EOL,
		FILE_APPEND);
	echo "Información guardada correctamente.";
	echo "<br><br>";

	$nombre="Luis Soto";
	file_put_contents("alumnos.txt",$nombre.PHP_EOL,
		FILE_APPEND);
	echo "Información guardada correctamente.";
	echo "<br><br>";
?>
<?php
	echo "<br><br>";
	$contenido=file_get_contents("alumnos.txt");
	echo nl2br($contenido);
?>
</body>
</html>