<?php
session_start();
include("con.php");
include("security_profile.php");
include("user_filter.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Perfil</title>
    <link rel="stylesheet" href="recursos/estilo.css">
</head>

<body>
    <header>
        <h1 class="titulo">Galería</h1>
        <a href="logout.php"><img class="logout" width="30px" src="recursos/logout.png" alt="Cerrar sesión"></a>
    </header>
    <div class="contenedor">
        <section>
            <?php
            if ($_GET["s"] == "ok") {
                echo '<script type="text/javascript">';
                echo 'window.alert("Actualizado con éxito");';
                echo '</script>';
            }
            $SQL = "SELECT * FROM publicaciones WHERE ID_Usuario=" . $_SESSION['IDU'] . " ORDER BY RAND()";
            $RS = mysqli_query($con, $SQL);
            echo '<table align="center">';
            $contador = 0;
            if (!isset($_GET["id"])) {
                while ($fila = mysqli_fetch_assoc($RS)) {
                    if ($contador % 3 == 0) {
                        echo '<tr>';
                    }
                    echo '<td><img class="imga" src="' . $fila['Imagen'] . '" alt="Imagen"></td>';
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
            ?>
        </section>
        <aside>
            <?php
            echo "Usuario: " . $_SESSION["usuario"] . "<br><hr>";
            $SQL2 = "SELECT a.Biografía FROM artistas a INNER JOIN usuarios u ON a.ID_Artista = u.ID_Artista WHERE u.IDU = " . $_SESSION['IDU'];
            $RS2 = mysqli_query($con, $SQL2);
            $fila2 = mysqli_fetch_assoc($RS2);
            echo "Biografía: " . $fila2['Biografía'];
            ?>
        </aside>
    </div>
</body>

</html>
