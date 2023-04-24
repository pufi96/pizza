<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!defined("URL")){
        include_once "defines.php";
    }
    if(empty($_POST)){
        $result="Booking form wasn't successfull.";
        $_SESSION["message"]=["message"=>$result,"success"=>false];
        header("Location:".URL."/book.php?id=4");
        exit;
    }
    $dateTimeCurrent = date("Y-m-d H:i:s");
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
    if(empty($_POST['message']) && !preg_match($reText, $_POST['message'])){
        $errors['messageContact'] = 'Message is required and must be in text format.';
    }
    if(!empty($errors)){
        $_SESSION["message"]=["message"=>"Form is not valid.","success"=>false,"errors"=>$errors];
        header("Location:".URL."/contact.php?id=5");
        exit;
    }
    require_once "../../config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('INSERT INTO contact(firstNameContact,lastNameContact,emailContact,messageContact,currentDatetimeContact) VALUES (:firstNameContact,:lastNameContact,:emailContact,:messageContact,:dateTimeCurrent)');
    $statement->bindParam('firstNameContact', $_POST['fName']);
    $statement->bindParam('lastNameContact', $_POST['lName']);
    $statement->bindParam('emailContact', $_POST['email']);
    $statement->bindParam('messageContact', $_POST['message']);
    $statement->bindParam('dateTimeCurrent', $dateTimeCurrent);
    if($statement->execute()){
        $result="Message is sent.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    }else{
        $error="Messing wasn't successfull sent.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    header("Location:".URL."/contact.php?id=5");
?>