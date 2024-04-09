<?php
    session_start();
    include ("../con.php");
    include ("security.php");
    include ("user_filter.php");
        $SQL= "DELETE FROM publicaciones WHERE ID_Publicación=".$_POST['id'];
        unlink($_POST['file']);
    if(mysqli_query($con,$SQL)){
        header("Location: moderar.php?s=ok");
    } else {echo "ERROR";}
?>