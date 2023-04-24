<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
header("Content-Type: application/json");
if (empty($_POST)) {
    $result = ["success" => false, "message" => "Select valid page number.", "data" => null];
    echo json_encode($result);
    exit;
}
$text = $_POST['searchText'];
    require_once "../../config/connection.php";
    $connection = getConnection();
if(empty($text)){
    $check = $connection->query(" SELECT COUNT(*)
                                        FROM menu");
    }else{
        $check = $connection->query(" SELECT COUNT(*)
                                        FROM menu
                                        WHERE menu.nameMenu LIKE '%$text%'");
    }
if (!$check->execute()) {
    $result["message"] = "Error with database server.";
    echo json_encode($result);
    exit;
}
if(empty($_POST['idPag'])){
    $idPag = 6;
}else{
    $idPag = $_POST['idPag'];
    if ($idPag < 0) {
        $idPag = 0;
    }
    $fetchCount = $check->fetchColumn();
    $numberOfPages = (int) ceil($fetchCount / 6);
    if ($idPag < 0) {
        $idPag = 0;
    }elseif ($idPag > $numberOfPages) {
        $idPag = $numberOfPages - 1;
    }else{
        $idPag--;
    }
    $getOffset = $idPag * 6;
}
$connection = getConnection();
if(empty($text)){
    $statement = $connection->query("   SELECT *, m.idMenu as idMenu, AVG(r.ratingValue) as average
                                        FROM menu AS m
                                        LEFT JOIN rating as r ON m.idMenu=r.idMenu
                                        GROUP BY m.idMenu 
                                        LIMIT 6 
                                        OFFSET $getOffset",);
}else{
    $statement = $connection->query(" SELECT *, m.idMenu as idMenu, AVG(r.ratingValue) as average
                                    FROM menu AS m
                                    LEFT JOIN rating as r ON m.idMenu=r.idMenu
                                    WHERE m.nameMenu LIKE '%$text%'
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
    $result = ["success" => true,"message" => "Menu is successfully loaded from database.", "data" => $dbResult];
    echo json_encode($result);
    exit;
} else {
    $result = ["success" => false, "message" => "Menu couldn't load from database."];
    echo json_encode($result);
}