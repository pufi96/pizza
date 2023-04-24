<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!defined("URL")){
        include_once "assets/fixed/defines.php";
    }
    if(empty($_SESSION["user"])){
        header("Location:".URL."/login.php?id=6");
        exit;
    }
    unset($_SESSION["user"]);
    $_SESSION["message"]=["success"=>true,"message"=>"Logout is successfull."];
    header("Location:".URL."/login.php?id=6");
?>