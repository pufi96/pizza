<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!defined("URL")){
        include_once "assets/fixed/defines.php";
    }
    if(empty($_SESSION["user"])){
        $_SESSION["message"] = ["message" => "Login to your account.", "success" => false];
        header("Location:".URL."/login.php?id=6");
        exit;
    
    }
    require_once "assets/fixed/header.php";
    require_once "assets/fixed/nav.php";
    require_once "assets/fixed/homeSlider.php";
?>
<div class="container my-5">
  <?php require_once "assets/fixed/messages.php" ?>
  <?php require_once "assets/fixed/showProfile.php" ?>
</div>
<?php
    require_once "assets/fixed/footer.php";
?>