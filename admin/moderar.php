<?php
$_SESSION['php']="editar.php";
include ("../con.php");
include ("security.php");
include ("user_filter.php");
if($_GET["s"]=="ok"){
    echo '<script type="text/javascript">';
    echo 'window.alert("Publicación eliminada con éxito");';
    echo '</script>';
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderación </title>
    <link rel="stylesheet" href="../recursos/estilo.css">
</head>

<body>
    <header>
        <h1 class="titulo">Galería</h1>
    </header>
    <div class="contenedor">
        <section>
<?php
session_start();
$SQL="SELECT * FROM publicaciones";
$RS = mysqli_query($con, $SQL);
echo "<h1 class=tit align=center>Interfaz de moderación, elimina las publicaciónes inapropiadas</h1>";
echo '<table align=center>';
$contador = 0;
if (!isset($_GET["id"])){
    while ($fila = mysqli_fetch_assoc($RS)) {
        if ($contador % 3 == 0) { 
            echo '<tr>';
        }

        echo '<td><a href=moderar.php?id='.$fila['ID_Publicación'].'><img class=imga src="../'. $fila['Imagen'] . '" alt="Imagen"></a></td>';

        $contador++;

        if ($contador % 3 == 0) { 
            echo '</tr>';
        }
    }

    if ($contador % 3 != 0) { 
        echo '</tr>';
    }

    echo '</table>';
}elseif(isset($_GET['id'])){
			$SQL = "SELECT * FROM publicaciones  WHERE ID_Publicación=".$_GET['id'];
			$RS=mysqli_query($con,$SQL);
			$fila=mysqli_fetch_assoc($RS);
			?>
		<table>
		<tr><td>
		<h2>ELIMINAR PUBLICACIÓN</h2>
		<form  method="post" action="eli.php">
					
						
			
			
					
		<p>¿Estas seguro que deseas eliminar <img width=10% src="../<?php echo $fila['Imagen'];?>"></img> ? &nbsp;&nbsp;
			    
			
		<input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <input type="hidden" name="file" value="<?php echo $fila['Imagen'];?>" />
		<input type="submit" name="conf" value="Confirmar" />
		</form>	
 </td></tr></table>



<?php
}
mysqli_close($con);
?>
</section>
</body>
<footer>
<a href="../logout.php"><img class="logout" align="right" width="30px" src="../recursos/logout.png" alt="Cerrar sesión"></a>
</footer>
</html>
