<?php
    if(!defined("URL")){
        include_once "assets/fixed/defines.php";
    }
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_start();
    if(empty($_SESSION["user"])){
        header("Location:".URL."/login.php?id=6");
        exit;
    }
    require_once "assets/fixed/header.php";
    require_once "assets/fixed/nav.php";
    require_once "assets/fixed/homeSlider.php";
?>
<?php
    require_once "assets/fixed/footer.php";
?>