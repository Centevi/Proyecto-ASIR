<?php
session_start();
$current_page = basename($_SERVER['PHP_SELF']);

if ($_SESSION["tipo"]=="USER" OR $_SESSION["tipo"]=="ADMIN") {
    if ($current_page == 'index.php') {
        header("Location: index.php");
        exit();
    }
}
?>
