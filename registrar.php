<!DOCTYPE html>
<?php
session_start();
include ("con.php");

if(isset($_GET["existe"]) && $_GET["existe"] == "si"){
    echo '<script type="text/javascript">';
    echo 'window.alert("Lo siento, nombre de usuario en uso");';
    echo '</script>';
}

if(!isset($_POST["Registrarme"])){
    $SQL="SELECT Nombre FROM usuarios";
    $RS=mysqli_query($con,$SQL);
?>

<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Perfil </title>
    <link rel="stylesheet" href="recursos/estilo.css">
    <style>
        table {
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid black;
            border-radius: 10px;
        }

        body {
            background-color: aliceblue;
        }
    </style>
</head>

<body>
    <header>
        <h1 class="titulo">Galería</h1>
    </header>

    <table align=center>
        <form action="registrar.php" method="post">
            <tr>
                <td><label for="nombre">Nombre</label></td>
                <td><input type="text" name="nombre" id="nombre" maxlength="10" required></td>
            </tr>
            <tr>
                <td><label for="correo">Correo</label></td>
                <td><input type="email" name="correo" id="correo" required></td>
            </tr>
            <tr>
                <td><label for="contrasenya">Contraseña:</label></td>
                <td><input type="password" name="contrasenya" id="contrasenya" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Debe contener al menos un número, una letra mayúscula, una letra minúscula y al menos 8 o más caracteres" required></td>
            </tr>
            <tr>
                <td><label for="tipo">¿Qué Soy?</label></td>
                <td><select name="tipo">
                        <option id="tipo" selected disabled>Elige</option>
                        <option id="tipo" value="ARTIST">Artista</option>
                        <option id="tipo" value="USER">Usuario</option>
                    </select></td>
            </tr>
            <input type="hidden" name="estado" value=0>
            <tr>
                <td colspan="2"><input type="submit" name="Registrarme" value="Registrarme"></td>
            </tr>
        </form>
    </table>

    <footer>
        <p>Galería Vicent Smith™</p>
    </footer>
</body>

</html>
<?php 
}else{
    $id=rand(10000000, 99999999);
    $id_s=rand(10000000, 99999999);
    $tipo=$_POST["tipo"];
    $estado=$_POST["estado"];
    $correo=filter_var($_POST["correo"], FILTER_SANITIZE_STRING);
    $passf=filter_var($_POST["contrasenya"], FILTER_SANITIZE_STRING);
    $nombre=filter_var($_POST["nombre"], FILTER_SANITIZE_STRING);

    if(strlen($nombre) > 10){
        echo "El nombre de usuario no puede tener más de 10 caracteres.";
        exit();
    }

    $SQL="SELECT Nombre FROM usuarios WHERE Nombre='$nombre'";
    $RS=mysqli_query($con,$SQL);
    if(mysqli_num_rows($RS) > 0){
        header('Location: registrar.php?existe=si');
        exit();
    }

    $enpass=hash('sha256',$passf);
    $date=date('Y-m-d H:i:s');

    $SQL= "INSERT INTO usuarios (id, Nombre, Correo, Contraseña, Tipo, Estado) VALUES ($id, '$nombre', '$correo', '$enpass', '$tipo', $estado)";
    $SQL2= "INSERT INTO solicitudes VALUES ($id_s, $id, '$date', '$tipo', $estado)";

    if(mysqli_query($con,$SQL) && mysqli_query($con,$SQL2)){ 
        header('Location: index.php?o=ok');
        exit();
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
mysqli_close($con);
?>

