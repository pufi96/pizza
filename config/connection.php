<?php
function getConnection(){
    $SERVER = "localhost";
    $DATABASE = "id16644311_pizza_restaurant";
    $USERNAME = "id16644311_pufi";
    $PASSWORD = 'u2p2bMC!7Pzo$LhC';
    try {
        $dbh = new PDO("mysql:host=$SERVER;dbname=$DATABASE;charset=utf8", $USERNAME, $PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
        $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);    
        return $dbh;
    }
    catch(PDOException $ex){
        echo $ex->getMessage();
        return null;
    }    
}
?>