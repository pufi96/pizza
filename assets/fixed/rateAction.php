<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $result=["success"=>false,"message"=>"Your must login if you want to rate.","data"=>null];
    header("Content-Type: application/json");
    if(empty($_SESSION["user"])){
        echo json_encode($result); 
        exit;
    }
    if(empty($_POST)){
        echo json_encode($result);
        exit;
    }
    if(empty($_POST['idMenu'])){
        echo json_encode($result);
        exit;
    }
    if(empty($_POST['ratingValue'])){
        echo json_encode($result);
        exit;
    }
    require_once "config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->query(" SELECT COUNT(*)
                                        FROM menu");
    $statement->execute();
    $fetchCount = $statement->fetchColumn();
    $numberOfPages = (int) ceil($fetchCount/6);
    if(!$check->execute()){
        $result["message"]="Error with database server.";
        echo json_encode($result);
        exit;
    }
    if(!empty($check->fetch())){
        $result["message"]="You have already rate.";
        echo json_encode($result);
        exit;
    }
    $statement=$connection->prepare('INSERT INTO rating(idMenu,idUser,ratingValue) VALUES (:idMenu,:idUser,:ratingValue)');
    $statement->bindParam('idMenu', $_POST['idMenu']);
    $statement->bindParam('idUser', $_SESSION['user']->idUser);
    $statement->bindParam('ratingValue', $_POST['ratingValue']);
    if($statement->execute()){
        $statement=$connection->prepare('   SELECT `idMenu`, AVG(`ratingValue`) as `average`
                                            FROM `rating` 
                                            WHERE `idMenu` = :idMenu
                                            GROUP BY `idMenu` LIMIT 1');
        $statement->bindParam('idMenu', $_POST['idMenu']);
        if($statement->execute()){
            $dbResult=$statement->fetch();
            $result =["success"=>true,"message"=>"Rating was successfull.","data"=>number_format($dbResult->average,1)];
            echo json_encode($result);
        }else{
            $result =["success"=>false,"message"=>"Rating couldn't load from database."];
            echo json_encode($result);
        }
    }else{
        $result =["success"=>false,"message"=>"Rating couldn't save in database."];
        echo json_encode($result);
    }
?>