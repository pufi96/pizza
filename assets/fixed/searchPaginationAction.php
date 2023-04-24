<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
header("Content-Type: application/json");
if (empty($_POST)) {
    $result = ["success" => false, "message" => "Enter valid text.", "messagePage"=>"Enter valid text", "data" => null, "dataPage"=>0];
    echo json_encode($result);
    exit;
}

$check = $_POST['searchText'];
require_once "../../config/connection.php";
$connection = getConnection();

if(isset($check)===true && $check ===''){
    $statementPage = $connection->query("SELECT COUNT(*)
                                            FROM menu");
}else{
    $statementPage = $connection->query("SELECT COUNT(*)
                                            FROM menu
                                            WHERE menu.nameMenu LIKE '%$check%'");
}
if($statementPage->execute()) {
    if($fetchCount=$statementPage->fetchColumn()){
        $numberOfPages = (int) ceil($fetchCount / 6);
        if($numberOfPages>1){
            $result = ["success" => true, "messagePage" => "Number of pagination buttons ", "dataPage" => $numberOfPages];
        }else{
            $result = ["success" => true, "messagePage" => "There is less then 6 items", "dataPage" => 0];
        }
    }else{
        $result = ["success" => false, "message" => "There is no data for searched text.", "dataPage" => null];
        echo json_encode($result);
        exit;
    }
}else{
    $result = ["success" => false, "message" => "Error with database server.", "dataPage" => null];
    echo json_encode($result);
    exit;
}
if(empty($_POST['idPag'])){
    $idPag = 0;
}else{
    $idPag = $_POST['idPag'];
    if ($idPag < 0) {
        $idPag = 0;
    }elseif ($idPag > $numberOfPages) {
        $idPag = $numberOfPages - 1;
    }else{
        $idPag--;
    }   
}
$getOffset = $idPag * 6;
$connection = getConnection();
if(isset($check)===true && $check ===''){
    $statement = $connection->query("   SELECT *, m.idMenu as idMenu, AVG(r.ratingValue) as average
                                        FROM menu AS m
                                        LEFT JOIN rating as r ON m.idMenu=r.idMenu
                                        GROUP BY m.idMenu 
                                        LIMIT 6 
                                        OFFSET $getOffset",);
}else{
    
    $statement = $connection->query("   SELECT *, m.idMenu as idMenu, AVG(r.ratingValue) as average
                                        FROM menu AS m
                                        LEFT JOIN rating as r ON m.idMenu=r.idMenu
                                        WHERE m.nameMenu LIKE '%$check%'
                                        GROUP BY m.idMenu 
                                        LIMIT 6 
                                        OFFSET $getOffset",);
}
if($statement->execute()) {
    $dbResult = $statement->fetchAll();
    if(empty($dbResult)){
        $result = ["success" => true,"message" => "There is no data for searched text.", "data" => null];
        echo json_encode($result);
        exit;
    }
    $result = ["success" => true,"message" => "Menu is successfully loaded from database.", "data" => $dbResult, "dataPage" => $numberOfPages];
    echo json_encode($result);
    exit;
} else {
    $result = ["success" => false, "message" => "Menu couldn't load from database."];
    echo json_encode($result);
    exit;
}