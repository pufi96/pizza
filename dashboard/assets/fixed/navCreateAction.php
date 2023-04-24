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
    if(empty($_POST['nameNav']) || !preg_match($reName, $_POST['nameNav'])){
        $errors['nameNav'] = 'Name is required.';
    }
    if(empty($_POST['linkNav']) || !preg_match($reLink, $_POST['linkNav'])){
        $errors['linkNav'] = 'Link is required.';
    }
    if(!empty($errors)){
        $error = "Couldn't create new navigation.";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:".URL."/dashboard/nav.php");
        exit;
    }
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('INSERT INTO nav(nameNav,hrefNav,visibleNav) VALUES (:nameNav,:hrefNav,:visibleNav)');
    $statement->bindParam('nameNav', $_POST['nameNav']);
    $statement->bindParam('hrefNav', $_POST['linkNav']);
    $statement->bindParam('visibleNav', $_POST['isVisible']);
    if($statement->execute()){
        $result = "Navigation is successfully added in database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    } else{
        $error = "Couldn't add navigation.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    header("Location:".URL."/dashboard/nav.php");
?>