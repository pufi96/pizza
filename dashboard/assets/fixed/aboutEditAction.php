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
        header("Location:".URL."index.php?id=1");
        exit;
    }
    include_once "regex.php";
    if(empty($_POST['nameAbout']) || !preg_match($reText, $_POST['nameAbout'])){
        $errors['nameAbout'] = 'Name is required and can only be in text format.';
    }
    if(empty($_POST['descAbout']) || !preg_match($reText, $_POST['descAbout'])){
        $errors['descAbout'] = 'Description is required and can only be in text format.';
    }
    if(!empty($_POST['srcImgAbout']) || !empty($_POST['altImgAbout']) || !empty($_POST['srcImgAbout'])){
        if(empty($_POST['srcImgAbout']) || !preg_match($reSrc, $_POST['srcImgAbout'])){
            $errors['srcImgAbout'] = 'Image source is required and can only be in text format.';
        }
        if(empty($_POST['altImgAbout']) || !preg_match($reText, $_POST['altImgAbout'])){
            $errors['postHeading'] = 'Image description is required and can only be in text format.';
        }
        if(empty($_FILES['uploadImgAbout'])){
            $errors['fileUpload'] = 'Please upload image';
        }else{
            $types=['image/jpeg','image/jpg','image/png','image/gif'];
            if(!in_array($_FILES['uploadImgAbout']['type'],$types)){
                $errors['fileUpload'] = 'Please upload '.implode(' ',$types).'.';
            }
            if($_FILES['uploadImgAbout']['error'] != 0){
                $errors['fileUpload'] = "Couldn't upload image.";
            }
            if($_FILES['uploadImgAbout']['size'] > 5242880){
                $errors['fileUpload'] = "Image size must be under 5MB.";
            }
        }
    }
    if(!empty($errors)){
        $error = "Couldn't edit about.";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:".URL."/dashboard/about.php");
        exit;
    }
    $types=['image/jpeg'=>'jpeg','image/jpg'=>"jpg",'image/png'=>"png",'image/gif'=>"gif"];
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $connection->beginTransaction();
    $statement=$connection->prepare('UPDATE about
                                    SET nameAbout=:nameAbout,descAbout=:descAbout,srcImgAbout=:srcImgAbout,extImgAbout=:extImgAbout,altImgAbout=:altImgAbout
                                    WHERE about.idAbout=:id');
    $statement->bindParam('nameAbout', $_POST['nameAbout']);
    $statement->bindParam('descAbout', $_POST['descAbout']);
    $statement->bindParam('srcImgAbout', $_POST['srcImgAbout']);
    $statement->bindParam('extImgAbout', $types[$_FILES['uploadImgAbout']['type']]);
    $statement->bindParam('altImgAbout', $_POST['altImgAbout']);
    $statement->bindParam('id', $_POST['idAbout']);
    if($statement->execute()){
        $result = "About is successfully edited in database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    } else{
        $error = "Couldn't edit about.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    unlink("../../../images/".$_POST['currentSrcImgAbout'].'.'.$_POST['currentExtImgAbout']);
    $uploadImg = move_uploaded_file($_FILES['uploadImgAbout']['tmp_name'], '../../../images/'.$_POST['srcImgAbout'].'.'.$types[$_FILES['uploadImgAbout']['type']]);
    if(!$uploadImg){
        $connection->rollBack();
    }else{
        $connection->commit();
    }
    header("Location:".URL."dashboard/about.php");
?>