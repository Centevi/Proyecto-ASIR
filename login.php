<?php
session_start();
include ("con.php");

if(!isset($_POST['Submit'])){
echo "    <style>
            .tablaLogin{
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 1px solid black;
            border-radius: 10px;
            }
          body{
            background-color:aliceblue;
          }
          </style>";
?>

<form action="login.php" method="POST">
  <table align=center class=tablaLogin >
    <tr>
      
        <?php 
        if (isset($_GET["error"]) && $_GET["error"]=="data"){
          echo '<td colspan="2" align="center" bgcolor=red><span style="color:#fffff"><b>Inténtalo otra vez!! </b></span>';
        }  else {
          echo '<td colspan="2" align="center"> <span class="Estilo3">Introduce tus datos</span>';
        }
        ?>
      </td>
    </tr>
    <tr>
      <td align="right" >Usr:</td>
      <td><input name="usuario" type="Text" maxlength="50"></td>
    </tr>
    <tr>
      <td align="right">Pwd:</td>
      <td><input name="pass" type="password"  maxlength="50"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="Submit" type="Submit" value="Enviar"></td>
    </tr>
  </table>
<?php
} else {
  $cifrada = hash('sha256',$_POST['pass']);
  $SQL = "SELECT * FROM usuarios";
  $RS = mysqli_query($con, $SQL);

  while($fila = mysqli_fetch_assoc($RS)){
    $usr = filter_var($fila['Nombre'], FILTER_SANITIZE_STRING);
    $pass = $fila['Contraseña'];
    $id=$fila['ID_Usuario'];
    if($fila['Tipo_Usr']=="USER"){
      $_SESSION["tipo"]="USER";
    }
    elseif($fila['Tipo_Usr']=="ADMIN"){
      $_SESSION["tipo"]="ADMIN";}
    elseif($fila['Tipo_Usr']=="ARTIST"){
      $_SESSION["tipo"]="ARTIST";}
    if ($_POST["usuario"] == $usr && $cifrada == $pass){  
      session_start();
      $_SESSION["usuario"] = $usr;
      $_SESSION["IDU"] = $id;
      $_SESSION["autentificado"] = "SI";
      header ("Location: perfil.php");
      exit;
    } else {
      header("Location: login.php?error=data");
    }
  }
}
?>


