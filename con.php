<?php
//Inicio la sesión
session_start();
$con = mysqli_connect("172.201.218.186","gal_pi","911HPgyCpdPphWN","galeria");
// Verificar la conexión
if (!$con) {
    die("Falló la conexión a la base de datos MySQL: " . mysqli_connect_error());
}
?>
