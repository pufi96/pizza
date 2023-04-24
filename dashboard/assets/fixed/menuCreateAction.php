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
    if(empty($_POST['nameMenu']) || !preg_match($reText, $_POST['nameMenu'])){
        $errors['nameMenu'] = 'Name is required and can only be in text format.';
    }
    if(empty($_POST['descMenu']) || !preg_match($reText, $_POST['descMenu'])){
        $errors['descMenu'] = 'Description is required and can only be in text format.';
    }
    if(!empty($_POST['srcImgMenu']) || !empty($_POST['altImgMenu']) || !empty($_POST['srcImgMenu'])){
        if(empty($_POST['srcImgMenu']) || !preg_match($reSrc, $_POST['srcImgMenu'])){
            $errors['srcImgMenu'] = 'Image source is required and can only be in text format.';
        }
        if(empty($_POST['altImgMenu']) || !preg_match($reText, $_POST['altImgMenu'])){
            $errors['postHeading'] = 'Image description is required and can only be in text format.';
        }
        if(empty($_FILES['uploadImgMenu'])){
            $errors['fileUpload'] = 'Please upload image';
        }else{
            $types=['image/jpeg','image/jpg','image/png','image/gif'];
            if(!in_array($_FILES['uploadImgMenu']['type'],$types)){
                $errors['fileUpload'] = 'Please upload '.implode(' ',$types).'.';
            }
            if($_FILES['uploadImgMenu']['error'] != 0){
                $errors['fileUpload'] = "Couldn't upload image.";
            }
            if($_FILES['uploadImgMenu']['size'] > 5242880){
                $errors['fileUpload'] = "Image size must be under 5MB.";
            }
        }
    }
    if(empty($_POST['priceMenu']) || !preg_match($reNumber, $_POST['priceMenu'])){
        $errors['priceMenu'] = 'Price is required and can only be in number format.';
    }
    if(empty($_POST['isVisible'])){
        $errors['isVisible'] = 'Visibility is required.';
    }
    if(!empty($errors)){
        $error = "Couldn't create menu.";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:".URL."/dashboard/menu.php");
        exit;
    }
    $types=['image/jpeg'=>'jpeg','image/jpg'=>"jpg",'image/png'=>"png",'image/gif'=>"gif"];
    require_once "../../../config/connection.php";
    $visible = (int) $_POST['isVisible'];
    $extension = $types[$_FILES['uploadImgMenu']['type']];
    $price =$_POST['priceMenu'];
    $connection = getConnection();
    $connection->beginTransaction();
    $statement=$connection->prepare('INSERT INTO menu(nameMenu,descMenu,srcImgMenu,extImgMenu,altImgMenu,priceMenu,visibleMenu)
                                    VALUE(:nameMenu,:descMenu,:srcImgMenu,:extImgMenu,:altImgMenu,:priceMenu,:visibleMenu)');
    $statement->bindParam('nameMenu', $_POST['nameMenu']);
    $statement->bindParam('descMenu', $_POST['descMenu']);
    $statement->bindParam('srcImgMenu', $_POST['srcImgMenu']);
    $statement->bindParam('extImgMenu', $extension);
    $statement->bindParam('altImgMenu', $_POST['altImgMenu']);
    $statement->bindParam('priceMenu', $price);
    $statement->bindParam('visibleMenu', $visible);
    if($statement->execute()){
        $result = "Menu is successfully created in database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    } else{
        $connection->rollBack();
        $error = "Couldn't create menu.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
        header("Location:".URL."/dashboard/menu.php");
        exit;
    }
    $uploadImg = move_uploaded_file($_FILES['uploadImgMenu']['tmp_name'], '../../../images/'.$_POST['srcImgMenu'].'.'.$types[$_FILES['uploadImgMenu']['type']]);
    if(!$uploadImg){
        $connection->rollBack();
        $error = "Couldn't upload image.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
        header("Location:".URL."/dashboard/menu.php");
        exit;
    }else{
        $connection->commit();
    }
    header("Location:".URL."/dashboard/menu.php");
?>