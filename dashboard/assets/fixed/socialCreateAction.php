<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!defined("URL")){
        include_once "defines.php";
    }
    if (empty($_SESSION["user"])) {
        $_SESSION["message"] = ["message" => "Login to your account.", "success" => false];
        header("Location:" . URL . "login.php?id=6");
        exit;
    }
    if ($_SESSION["user"]->nameRole != "Admin") {
        $_SESSION["message"] = ["message" => "Your not authorised for this page.", "success" => false];
        header("Location:" . URL . "index.php?id=1");
        exit;
    }
    if(empty($_POST)){
        header("Location:".URL."/index.php?id=1");
        exit;
    }
    include_once "regex.php";
    if(empty($_POST['nameSocial']) || !preg_match($reName, $_POST['nameSocial'])){
        $errors['nameSocial'] = 'Name is required.';
    }
    if(empty($_POST['linkSocial']) || !preg_match($reLink, $_POST['linkSocial'])){
        $errors['linkSocial'] = 'Link is required.';
    }
    if(empty($_POST['iconSocial']) || !preg_match($reName, $_POST['iconSocial'])){
        $errors['iconSocial'] = 'Icon is required.';
    }
    if(!empty($errors)){
        $error = "Couldn't create new social.";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:".URL."/dashboard/social.php");
        exit;
    }
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('INSERT INTO social(nameSocial,hrefSocial,iconSocial,visibleSocial) VALUES (:nameSocial,:linkSocial,:iconSocial,:visibleSocial)');
    $statement->bindParam('nameSocial', $_POST['nameSocial']);
    $statement->bindParam('hrefSocial', $_POST['linkSocial']);
    $statement->bindParam('iconSocial', $_POST['iconSocial']);
    $statement->bindParam('visibleSocial', $_POST['isVisible']);
    if($statement->execute()){
        $result = "Social is successfully added in database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    } else{
        $error = "Couldn't add social.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    header("Location:".URL."/dashboard/social.php");
?>