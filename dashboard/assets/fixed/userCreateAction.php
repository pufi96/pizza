<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION["user"])) {
        $_SESSION["message"] = ["message" => "Login to your account.", "success" => false];
        header("Location:/login.php?id=6");
        exit;
    }
    
    if ($_SESSION["user"]->nameRole != "Admin") {
        $_SESSION["message"] = ["message" => "Your not authorised for this page.", "success" => false];
        header("Location:/index.php?id=1");
        exit;
    }
    if(empty($_POST)){
        header("Location:/index.php?id=1");
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
    $checkMail=$connection->prepare('SELECT (*)
                                    FROM users
                                    WHERE users.email = :email');
    $checkMail->bindParam('email', $_POST['email']);
    if($checkMail->execute()){
        $errors['email'] = 'Error with database. Contact Administrator.';
    }
    if($checkmail->fetch()){
        $error['email'] = 'Email is already in use.';
    }
    if(empty($_POST['password']) || !preg_match($rePassword, $_POST['password'])){
        $errors['password'] = 'Password must have minimum 8 caracters which have 1 upper case, 1 lower case, number and special caracter.';
    }
    if(!empty($_POST['gender'])){
        if($_POST['gender']!="female"){
            if($_POST['gender']!="male"){
                $errors['gender'] = 'Gender is required.';
            }
        }
    }
    if(empty($_POST['address']) || !preg_match($reAddress, $_POST['address'])){
        $errors['address'] = 'Address is required.';
    }
    if(!empty($errors)){
        $error = "Failed user creating";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:/dashboard/users.php");
        exit;
    }
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('INSERT INTO users(firstName,lastName,password,email,gender,address) 
                                    VALUES (:firstName,:lastName,:password,:email,:gender,:address)');
    $statement->bindParam('firstName', $_POST['fName']);
    $statement->bindParam('lastName', $_POST['lName']);
    $hashedPassword = md5($_POST['password']);
    $statement->bindParam('password', $hashedPassword);
    $statement->bindParam('email', $_POST['email']);
    $statement->bindParam('gender', $_POST['gender']);
    $statement->bindParam('address', $_POST['address']); 
    if($statement->execute()){
        $result="Successfull created user.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    }else{
        $error="Failed insert into database. ";
        $_SESSION["message"]=["message"=>$error,"success"=>true];
    }
    header("Location:/dashboard/user.php");
?>