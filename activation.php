<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(empty($_GET)){
        $_SESSION["message"] = ["message" => "Register to your account.", "success" => false];
        header("Location:/register.php?id=7");
        exit;
    }
    if(empty($_GET['key'])){
        $_SESSION["message"] = ["message" => "Register to your account.", "success" => false];
        header("Location:/register.php?id=7");
        exit;
    }
    if(empty($_GET['id'])){
        $_SESSION["message"] = ["message" => "Register to your account.", "success" => false];
        header("Location:/register.php?id=7");
        exit;
    }
    $id = $_GET['id'];
    $key = $_GET['key'];
    require_once "config/connection.php";
    $connection = getConnection();
    $statement=$connection->prepare('   SELECT *
                                        FROM users
                                        WHERE users.idUser = :id AND users.secretKey=:key AND users.status = 0');
    $statement->bindParam('id', $id);
    $statement->bindParam('key', $key);
    if(!$statement->execute()){
        header("Location:/login.php?id=6");
        exit;
    }
    $fetch=$statement->fetch();
    if(empty($fetch)){
        header("Location:/login.php?id=6");
        exit;
    }
    $statementU = $connection->prepare('UPDATE users
                                        SET status=1
                                        WHERE users.idUser=:id AND users.secretKey=:key');
    $statementU->bindParam('id', $id);
    $statementU->bindParam('key', $key);
    if($statementU->execute()){
        $_SESSION["message"] = ["message" => "Account is successfull activate.", "success" => true];
    header("Location:/login.php?id=6");
    }else{
        
    $_SESSION["message"] = ["message" => "Account is not successfull activate.", "success" => false];   
    header("Location:/login.php?id=6");
    }
?>