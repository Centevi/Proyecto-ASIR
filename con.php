<?php
//Inicio la sesión
session_start();
$con = mysqli_connect("20.229.169.29","pi_gal","X0nt4s3n1@","galeria");

// Verificar la conexión
if (!$con) {
    die("Falló la conexión a la base de datos MySQL: " . mysqli_connect_error());
}
?>
