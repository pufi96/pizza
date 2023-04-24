<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once "defines.php";
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
    
    if(empty($_POST['subHeading']) || !preg_match($reText, $_POST['subHeading'])){
        $errors['subHeading'] = 'Sub heading is required and can only be in text format.';
    }
    if(empty($_POST['mainHeading']) || !preg_match($reText, $_POST['mainHeading'])){
        $errors['mainHeading'] = 'Main heading is required and can only be in text format.';
    }
    if(empty($_POST['postHeading']) || !preg_match($reText, $_POST['postHeading'])){
        $errors['postHeading'] = 'Post heading is required and can only be in text format.';
    }
    if(!empty($_POST['srcImgSlider']) || !empty($_POST['altImgSlider']) || !empty($_POST['srcImgSlider'])){
        if(empty($_POST['srcImgSlider']) || !preg_match($reSrc, $_POST['srcImgSlider'])){
            $errors['srcImgSlider'] = 'Image source is required and can only be in text format.';
        }
        if(empty($_POST['altImgSlider']) || !preg_match($reText, $_POST['altImgSlider'])){
            $errors['postHeading'] = 'Image description is required and can only be in text format.';
        }
        if(empty($_FILES['uploadImgSlider'])){
            $errors['fileUpload'] = 'Please upload image';
        }else{
            $types=['image/jpeg','image/jpg','image/png','image/gif'];
            if(!in_array($_FILES['uploadImgSlider']['type'],$types)){
                $errors['fileUpload'] = 'Please upload '.implode(' ',$types).'.';
            }
            if($_FILES['uploadImgSlider']['error'] != 0){
                $errors['fileUpload'] = "Couldn't upload image.";
            }
            if($_FILES['uploadImgSlider']['size'] > 5242880){
                $errors['fileUpload'] = "Image size must be under 5MB.";
            }
        }
    }
    if(!empty($errors)){
        $error = "Couldn't create new slider.";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:".URL."/dashboard/slider.php");
        exit;
    }
    $types=['image/jpeg'=>'jpeg','image/jpg'=>"jpg",'image/png'=>"png",'image/gif'=>"gif"];
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $connection->beginTransaction();
    $statement=$connection->prepare('INSERT INTO slider(subHeading,mainHeading,postHeading,srcImgSlider,extImgSlider,altImgSlider) VALUES (:subHeading,:mainHeading,:postHeading,:srcImgSlider,:extImgSlider,:altImgSlider)');
    $statement->bindParam('subHeading', $_POST['subHeading']);
    $statement->bindParam('mainHeading', $_POST['mainHeading']);
    $statement->bindParam('postHeading', $_POST['postHeading']);
    $statement->bindParam('srcImgSlider', $_POST['srcImgSlider']);
    $statement->bindParam('extImgSlider', $types[$_FILES['uploadImgSlider']['type']]);
    $statement->bindParam('altImgSlider', $_POST['altImgSlider']);
    
    if($statement->execute()){
        $result = "Slider is successfully added in database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    } else{
        $error = "Couldn't add slider.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    $uploadImg = move_uploaded_file($_FILES['uploadImgSlider']['tmp_name'], '../../../images/'.$_POST['srcImgSlider'].'.'.$types[$_FILES['uploadImgSlider']['type']]);
    if(!$uploadImg){
        $connection->rollBack();
    }else{
        $connection->commit();
    }
    header("Location:".URL."/dashboard/slider.php");
?>