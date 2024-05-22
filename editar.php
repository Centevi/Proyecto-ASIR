<?php
$_SESSION['php']="editar.php";
include ("con.php");
include ("security_profile.php");
include ("user_filter.php");
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Publicación </title>
    <link rel="stylesheet" href="recursos/estilo.css">
</head>

<body>
    <header>
        <h1 class="titulo">Galería</h1>
    </header>
    <div class="contenedor">
        <section class="seccion">
        <?php
$SQL="SELECT * FROM publicaciones WHERE ID_Usuario=".$_SESSION['IDU'];
$RS = mysqli_query($con, $SQL);
echo "<h1 class=tit align=center>¿Qué imagen quieres editar?</h1>";
echo '<table align=center>';
$contador = 0;

if (!isset($_GET["id"])){
    while ($fila = mysqli_fetch_assoc($RS)) {
        if ($contador % 3 == 0) { 
            echo '<tr>';
        }

        echo '<td><a href=editar.php?id='.$fila['ID_Publicación'].'><img class="imga" src="' . $fila['Imagen'] . '" alt="Imagen"></a></td>';

        $contador++;

        if ($contador % 3 == 0) { 
            echo '</tr>';
        }
    }

    if ($contador % 3 != 0) { 
        echo '</tr>';
    }

    echo '</table>';
} elseif(isset($_GET["id"]) && !isset($_POST['Editar'])) { 
    $SQL="SELECT * FROM publicaciones WHERE ID_Publicación=".$_GET['id'];
    $RS = mysqli_query($con, $SQL);
    $fila = mysqli_fetch_assoc($RS);
    $titulo=$fila['Título'];
    $descripcion=$fila['Descripción'];
    $idp=$fila['ID_Publicación'];
    $idu=$fila['ID_Usuario'];
    $img=$fila['Imagen']; 
    $date=date('Y-m-d H:i:s');
?>
        </section class="editar">
        <table align=center>
        <form action="edieli.php" method="post" ENCTYPE="multipart/form-data">
        <input type=hidden name="ID_Publicación" value="<?php echo $idp ?>">
        <input type=hidden name="ID_Usuario" value="<?php echo $idu ?>">
        <input type=hidden name="date" value="<?php echo $date ?>">
        <input type=hidden name="Imagen" value="<?php echo $img ?>">
        <input type=hidden name="qh" value="editar">
        <tr>
            <td colspan=2><img class=editi src="<?php echo $img ?>"></td>
        </tr>
            <tr>
                <td><label for="titulo">Título:</label></td>
                <td><input type="text" name="Título" id="titulo" value="<?php echo $titulo ?>" required></td>
            </tr>
            <tr>
                <td><label for="descripcion">Descripción:</label></td>
                <td><textarea name="Descripción" id="descripcion" required><?php echo $descripcion ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" name="Editar" value="Editar"></td>
            </tr>
        </form>
        </table>
<?php
}
?> 
        
        </div>
        <footer>
            <p>Galería Vicent Smith™</p>
        </footer>
    
    </body>
    
    </html>

