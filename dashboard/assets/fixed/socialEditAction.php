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
        $errors['nameSocial'] = 'Name is required and can only be in text format.';
    }
    if(empty($_POST['linkSocial']) || !preg_match($reLink, $_POST['linkSocial'])){
        $errors['linkSocial'] = 'Link is required and can only be in text format.';
    }
    if(empty($_POST['iconSocial']) || !preg_match($reIcon, $_POST['iconSocial'])){
        $errors['iconSocial'] = 'Icon is required and must start with lowercased character and can contain special caracter: - .';
    }
    if(!empty($errors)){
        $error = "Couldn't edit social.";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:".URL."/dashboard/social.php");
        exit;
    }
    $visible = (int) $_POST['isVisible'];
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('UPDATE social
                                    SET nameSocial=:nameSocial,hrefSocial=:hrefSocial,iconSocial=:iconSocial,visibleSocial=:visibleSocial
                                    WHERE social.idSocial=:id');
    $statement->bindParam('nameSocial', $_POST['nameSocial']);
    $statement->bindParam('hrefSocial', $_POST['linkSocial']);
    $statement->bindParam('iconSocial', $_POST['iconSocial']);
    $statement->bindParam('visibleSocial', $visible);
    $statement->bindParam('id',$_GET['id']);
    if($statement->execute()){
        $result = "Social is successfully edited in database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    } else{
        $error = "Couldn't edit social.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    header("Location:".URL."/dashboard/social.php");
?>