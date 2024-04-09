<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería Vicent Smith</title>
    <link rel="stylesheet" href="recursos/estilo.css">
</head>
<style>
    .tabla-publicacion {
    padding-left:10%;
    padding-top:10%;
    display: inline-block;
    width: 100%;
    border-collapse: collapse;
}

.tabla-publicacion td {
    padding: 8px;
}
.tabla-publicacion img {
    border: solid black;
    border-radius: 5px;
    width: 400px;
    height: auto;
    
}
a {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
    cursor: pointer;
  }
  
  a:hover {
    background-color: #45a049;
  }
  
  a:active {
    background-color: #3e8e41;
  }

</style>

<body>
<header>
        <h1 class="titulo">Galería</h1>
</header>
        <?php 
            include("con.php");
            $SQL ="SELECT * FROM publicaciones WHERE ID_Publicación=".$_GET["id"];
            $RS=mysqli_query($con,$SQL);
            while($fila = mysqli_fetch_assoc($RS)) {
                $SQL_USER = "SELECT * FROM usuarios WHERE ID_Usuario=".$fila['ID_Usuario'];
                $RS_USER = mysqli_query($con, $SQL_USER);
                $fila_user = mysqli_fetch_assoc($RS_USER);
                echo "<table class='tabla-publicacion'>";
                echo "<tr>";
                echo "<td><img src='".$fila['Imagen']."' alt='Imagen'></td>";
                echo "<td>";
                echo "<p><a href='perfil_public.php?usr=".$fila_user['Nombre']."'>".$fila_user['Nombre']."</a></p>";
                echo "<p>&nbsp;</p>";
                echo "<p>&nbsp;</p>";
                echo "<p>".$fila['Título']."</p>";
                echo "<p>&nbsp;</p>";
                echo "<p>&nbsp;</p>";
                echo "<p>".$fila['Descripción']."</p>";
                echo "<p>&nbsp;</p>";
                echo "<p>&nbsp;</p>";
                echo "<p>&nbsp;</p>";
                echo "</td>";
                echo "</tr>";
                echo "</table>";
            }
            ?>


    <footer>
    <p>Galería Vicent Smith™</p>
    </footer>

</body>

</html>
