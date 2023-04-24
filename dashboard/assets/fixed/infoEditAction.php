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
        header("Location:".URL."index.php?id=1");
        exit;
    }
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('UPDATE info
                                    SET nameInfo=:nameInfo,textInfo=:textInfo,descInfo=:descInfo,iconInfo=:iconInfo
                                    WHERE info.idInfo=:id');
    $statement->bindParam('nameInfo', $_POST['nameInfo']);
    $statement->bindParam('textInfo', $_POST['textInfo']);
    $statement->bindParam('descInfo', $_POST['descInfo']);
    $statement->bindParam('iconInfo', $_POST['iconInfo']);
    $statement->bindParam('id',$_GET['id']);
    if($statement->execute()){
        $result = "Informations are successfully edited in database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    } else{
        $error = "Couldn't edit Informations.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    header("Location:".URL."dashboard/info.php");
?>