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
        header("Location:" . URL . "index.php?id=1");
        exit;
    }
    include_once "regex.php";
    if(empty($_POST['nameCounter']) || !preg_match($reText, $_POST['nameCounter'])){
        $errors['nameCounter'] = 'Name is required and can only be in text format.';
    }
    if(empty($_POST['numberCounter']) || !preg_match($ewNumber, $_POST['numberCounter'])){
        $errors['numberCounter'] = 'Number is required and can only be in number format.';
    }
    if(empty($_POST['iconCounter']) || !preg_match($reIcon, $_POST['iconCounter'])){
        $errors['iconCounter'] = 'Icon is required and must start with lowercased character and can contain special caracter: - .';
    }
    
    if(!empty($errors)){
        $error = "Couldn't edit counter.";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:".URL."/dashboard/counter.php");
        exit;
    }
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('UPDATE counter
                                    SET nameCounter=:nameCounter,numberCounter=:numberCounter,iconCounter=:iconCounter
                                    WHERE counter.idCounter=:id');
    $statement->bindParam('nameCounter', $_POST['nameCounter']);
    $statement->bindParam('numberCounter', $_POST['numberCounter']);
    $statement->bindParam('iconCounter', $_POST['iconCounter']);
    $statement->bindParam('id', $_POST['idCounter']);
    if($statement->execute()){
        $result = "Counter is successfully edited in database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    } else{
        $error = "Couldn't edit counter.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    header("Location:".URL."dashboard/counter.php");
?>