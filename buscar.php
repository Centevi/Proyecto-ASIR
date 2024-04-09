<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería Vicent Smith</title>
    <link rel="stylesheet" href="recursos/estilo.css">
</head>

<body>
<style>
    .imga{
        border: 2px solid black;
        border-radius: 5px;
        width: 300px; 
        height: 150px;
        margin-top:15%;
    }
    </style>
    <header>
        <h1 class="titulo">Galería</h1>
        <div id="search">
        <form action=buscar.php method=post>
            <input type="text" placeholder="Buscar" name="buscar">
            <button type="submit">Buscar</button>
        </form>
    </div>
    </header>
    <div class="contenedor">
        <section>
<?php
include ("con.php");
if(isset($_POST['buscar'])){
    $busqueda = filter_var($_POST["buscar"], FILTER_SANITIZE_STRING);
    $busqueda = str_replace(" ","%",$busqueda);
    $SQL= "SELECT * FROM usuarios JOIN publicaciones ON usuarios.ID_Usuario = publicaciones.ID_Usuario WHERE usuarios.Nombre LIKE '%$busqueda%' OR publicaciones.Título LIKE '%$busqueda%'";
    $RS=mysqli_query($con,$SQL);
    echo '<table align=center>';
    $contador = 0;
    while ($fila = mysqli_fetch_assoc($RS)) {
        if ($contador % 3 == 0) { 
            echo '<tr>';
        }

        echo '<td><a href="detalle.php?id='.$fila['ID_Publicación'].'"><img class="imga" src="' . $fila['Imagen'] . '" alt="Imagen"></a></td>';

        $contador++;

        if ($contador % 3 == 0) { 
            echo '</tr>';
        }
    }

    if ($contador % 3 != 0) { 
        echo '</tr>';
    }

    echo '</table>';
}
mysqli_close($con);
?>
    </div>
    <footer>
    <p>Galería Vicent Smith™</p>
    </footer>

</body>

</html>
