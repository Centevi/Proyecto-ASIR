<?php
include ("con.php");
$usuario=$_GET["usr"];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de <?php echo $usuario;?> </title>
    <link rel="stylesheet" href="recursos/estilo.css">
</head>

<body>
    <header>
        <h1 class="titulo"> &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;Galería &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;</h1>
        <a href="index.php"><img  class="logout" width=30px src="recursos/home.png"></a>
    </header>
    <div class="contenedor">
        <section>
        <?php
    $datos_usuario="SELECT * FROM usuarios WHERE Nombre='$usuario'";
    $rs_datos=mysqli_query($con,$datos_usuario);
    while($ususario_datos = mysqli_fetch_assoc($rs_datos)){
    $u=$ususario_datos["ID_Usuario"]; 
    $SQL = "SELECT * FROM publicaciones WHERE ID_Usuario=$u  ORDER BY RAND()";
    $RS=mysqli_query($con,$SQL);
    echo '<table align=center>';
    $contador = 0;
    if (!isset($_GET["id"])){
        while ($fila = mysqli_fetch_assoc($RS)) {
            if ($contador % 3 == 0) { 
                echo '<tr>';
            }
            echo '<td><img class=imga src="' . $fila['Imagen'] . '" alt="Imagen"></td>';
    
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
}

    
    ?>
        </section>
        <aside>
            <?php
                echo "Usuario: $usuario<br><hr>";
                $SQL2="SELECT a.Biografía FROM artistas a INNER JOIN usuarios u ON a.ID_Usuario = u.ID_Usuario WHERE a.ID_Usuario=$u";
                $RS2=mysqli_query($con,$SQL2);
                if($fila2=mysqli_fetch_assoc($RS2)){
                    echo "Biografía: ".$fila2["Biografía"]."<br>";
                }
                mysqli_close($con);
            ?>
        </aside>
    </div>
    <footer>
        <p>Galería Vicent Smith™</p>
    </footer>

</body>

</html>
