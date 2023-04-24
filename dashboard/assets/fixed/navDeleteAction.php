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
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('DELETE FROM nav
                                    WHERE nav.idNav=:id');
    $statement->bindParam('id',$_GET['id']);
    if($statement->execute()){
        $result = "Navigation is successfully deleted from database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    } else{
        $error = "Couldn't delete navigation.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    header("Location:".URL."/dashboard/nav.php");
?>