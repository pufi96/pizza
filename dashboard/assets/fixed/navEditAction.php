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
    if(empty($_POST['isVisible'])){
        var_dump($_POST['isVisible']);
        $errors['isVisible'] = 'Visibility is required.';
    }
    if(!empty($errors)){
        $error = "Couldn't edit navigation.";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:".URL."/dashboard/nav.php");
        exit;
    }
    $visible = (int) $_POST['isVisible'];
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('UPDATE nav
                                    SET nameNav=:nameNav,hrefNav=:hrefNav,visibleNav=:visibleNav
                                    WHERE nav.idNav=:id');
    $statement->bindParam('nameNav', $_POST['nameNav']);
    $statement->bindParam('hrefNav', $_POST['linkNav']);
    $statement->bindParam('visibleNav', $visible);
    $statement->bindParam('id',$_GET['id']);
    if($statement->execute()){
        $result = "Navigation is successfully edited in database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    } else{
        $error = "Couldn't edit navigation.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    header("Location:".URL."/dashboard/nav.php");
?>