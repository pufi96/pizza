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
        $_SESSION["message"] = ["message" => "Login to your account.", "success" => false];
        header("Location:".URL."/register.php?id=7");
        exit;
    }
    include_once "regex.php";
    if(empty($_POST['fName']) || !preg_match($reName, $_POST['fName'])){
        $errors['fName'] = 'First name is required. First name must have at least 3 characters and first letter upper and max 20 characters.';
    }
    if(empty($_POST['lName']) || !preg_match($reName, $_POST['lName'])){
        $errors['lName'] = 'Last name is required. Last name must have at least 3 characters and first letter upper and max 20 characters.';
    }
    if(empty($_POST['email']) || !preg_match($reEmail, $_POST['email'])){
        $errors['email'] = 'Email is required.';
    }
    if(!empty($_POST['password'])){
        if(!preg_match($rePassword, $_POST['password'])){
            $errors['password'] = 'Password must have minimum 8 caracters which have 1 upper case, 1 lower case, number and special caracter.';
        }
    }
    if(!empty($_POST['passwordConfirm'])){
        if(!preg_match($rePassword, $_POST['passwordConfirm'])){
            $errors['passwordConfirm'] = 'Password must have minimum 8 caracters which have 1 upper case, 1 lower case, number and special caracter.';
        }
        if($_POST['passwordConfirm'] != $_POST['passwordConfirm']){
            $errors['passwordConfirm'] = 'Passwords must match.';
        }
    }
    
    if(empty($_POST['address']) || !preg_match($reAddress, $_POST['address'])){
        $errors['address'] = 'Address is required.';
    }
    if(!empty($errors)){
        $error = "Failed registration";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:".URL."/register.php?id=7");
        exit;
    }
    require_once "../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('UPDATE users
                                    SET firstName=:firstName,lastName=:lastName,password=:password,email=:email,address=:address
                                    WHERE users.idUser=:id');
    $statement->bindParam('firstName', $_POST['fName']);
    $statement->bindParam('lastName', $_POST['lName']);
    $hashedPassword = md5($_POST['password']);
    $statement->bindParam('password', $hashedPassword);
    $statement->bindParam('email', $_POST['email']);
    $statement->bindParam('address', $_POST['address']);
    $statement->bindParam('id', $_SESSION["user"]->idUser);
    if($statement->execute()){
        $result="Profile successfull changed.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    }else{
        $error="Failed change into database. ";
        $_SESSION["message"]=["message"=>$error,"success"=>true];
    }
    header("Location:".URL."/profile.php?id=6");
?>