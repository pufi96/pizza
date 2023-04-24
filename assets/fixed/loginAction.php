<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!defined("URL")){
        include_once "defines.php";
    }
    if(!empty($_SESSION["user"])){
        header("Location:".URL."/profile.php?id=10");
        exit;
    }
    if(empty($_POST)){
        header("Location:".URL."/profile.php?id=10");
        exit;
    }
    include_once "regex.php";
    if(empty($_POST['email']) || !preg_match($reEmail, $_POST['email'])){
        $errors = 'Email is required';
        $_SESSION["message"]=["message"=>$errors,"success"=>false];
        header("Location:".URL."/login.php?id=6");
        exit;
    }
    if(empty($_POST['password']) || !preg_match($rePassword, $_POST['password'])){
        $errors = 'Password is required';
        $_SESSION["message"]=["message"=>$errors,"success"=>false];
        header("Location:".URL."/login.php?id=6");
        exit;
    }
    require_once "../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('SELECT * FROM users INNER JOIN roles ON users.idRole=roles.idRole WHERE email = :email AND password = :password LIMIT 1');
    $statement->bindParam('email', $_POST['email']);
    $hashedPassword = md5($_POST['password']);
    $statement->bindParam('password', $hashedPassword);
    $statement->execute();
    $result = $statement->fetch();
    if(empty($result)){
        $errors="Wrong email or password.";
        $_SESSION["message"]=["message"=>$errors,"success"=>false];
        header("Location:".URL."/login.php?id=6");
        exit;
    }
    $_SESSION["user"]=$result;
    $_SESSION["message"]=["message"=>"Successfull login","success"=>true];
    header("Location:".URL."/profile.php?id=10");
?>