<?php
    session_start(); 
    $_SESSION['php']="gestion_cuentas.php";
    include("security.php");
    include("../con.php");
    $SQL="SELECT * FROM solicitudes";
    $RS=mysqli_query($con,$SQL);
    echo "<style>
    .aa {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border-radius: 5px;
        cursor: pointer;
      }
      
      .aa:hover {
        background-color: #45a049;
      }
      
      .aa:active {
        background-color: #3e8e41;
      }
    </style>
    <p><a class=aa href=moderar.php>Ir a la página de moderación</a></p><br>
          <p><a class=aa href=../logout.php>Cerrar sesión</a></p>
        <table border=1 align=center>
        <tr>
            <td>USUARIO</td>
            <td>ID SOLICITUD</td>
            <td>ID USUARIO</td>
            <td>FECHA</td>
            <td>TIPO DE SOLICITUD</td>
            <td>APROBAR</td>
            <td>RECHAZAR</td>
        </tr>
        <tr>";
        while($fila=mysqli_fetch_assoc($RS)){
            $u="SELECT nombre FROM usuarios WHERE ID_Usuario='".$fila['ID_Usuario']."'";
            $us=mysqli_query($con,$u);
            $usr=mysqli_fetch_assoc($us);
            $user=$usr["nombre"];
            $tipo=$fila["Tipo"];
        echo "<td>$user</td>";
        echo "<td>".$fila["ID_Solicitud"]."</td>";
        echo "<td>".$fila["ID_Usuario"]."</td>";
        echo "<td>".$fila["Fecha"]."</td>";
        echo "<td>".$fila["Tipo"]."</td>";
        echo "<td><a href='aprove.php?a=si&ID_Usuario=".$fila['ID_Usuario']."&usr=$user&tipo=$tipo'><img width=15px src='../recursos/si.png'></a></td>";
        echo "<td><a href='aprove.php?a=no&ID_Usuario=".$fila['ID_Usuario']."'><img width=15px src='../recursos/no.png'></a></td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_close($con);
