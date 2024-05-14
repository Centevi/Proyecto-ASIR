<?php
//Inicio la sesión
session_start();
$con = mysqli_connect("XXXXXXXXXXXXXXXX","XXXXXXXXXXXXXXXXX","XXXXXXXXXXXXXXXXXXXXX","XXXXXXXXXXXX");

// Verificar la conexión
if (!$con) {
    die("Falló la conexión a la base de datos MySQL: " . mysqli_connect_error());
}
?>
