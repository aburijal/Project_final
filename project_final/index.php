<?php
session_start();
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page = "home.php";
    include "main.php";


} elseif (isset($_GET['x']) && $_GET['x'] == 'dapur') {
    $page = "dapur.php";
    include "main.php";


} elseif (isset($_GET['x']) && $_GET['x'] == 'pemesanan') {
    $page = "pemesanan.php";
    include "main.php";


}elseif (isset($_GET['x']) && $_GET['x'] == 'menu') {
    $page = "menu.php";
    include "main.php";


} elseif (isset($_GET['x']) && $_GET['x'] == 'itempesanan') {
    $page = "item_pesanan.php";
    include "main.php";


}elseif (isset($_GET['x']) && $_GET['x'] == 'user') {
    if($_SESSION['level_kantinkampus']==1){
        $page = "user.php";
        include "main.php";
    }else{
        $page = "home.php";
        include "main.php";
    }




} elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
    include "login.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'logout') {
    include "proses/proses_logout.php";
} else {
    $page = "home.php";
    include "main.php";
}
?>