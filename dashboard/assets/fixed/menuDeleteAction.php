<?php
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!defined("URL")){
        include_once "defines.php";
    }
    include_once "checkUser.php";
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
        if(!empty($_FILES['uploadImgMenu'])){
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
    if(is_null($_POST['isVisible'])){
        $errors['isVisible'] = 'Visibility is required.';
    }
    if(!empty($errors)){
        $error = "Couldn't edit menu.";
        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];
        header("Location:".URL."/dashboard/menu.php");
        exit;
    }
    $visible =(int) $_POST['isVisible'];
    $types=['image/jpeg'=>'jpeg','image/jpg'=>"jpg",'image/png'=>"png",'image/gif'=>"gif"];
    $date = new DateTime();
    $uniqueDate = $date->getTimestamp();
    require_once "../../../config/connection.php";
    $connection = getConnection();
    $connection->beginTransaction();
        $statement=$connection->prepare('UPDATE menu
                                        SET nameMenu=:nameMenu,descMenu=:descMenu,
                                        priceMenu=:priceMenu,visibleMenu=:visibleMenu
                                        WHERE menu.idMenu=:id');
        $statement->bindParam(':nameMenu', $_POST['nameMenu']);
        $statement->bindParam(':descMenu', $_POST['descMenu']);
        $statement->bindParam(':priceMenu', $_POST['priceMenu']);
        $statement->bindParam(':visibleMenu', $visible);
        $statement->bindParam(':id', $_POST['idMenu']);
        if(!$statement->execute()){
            $connection->rollBack();
            $error = "Couldn't edit menu.";
            $_SESSION["message"]=["message"=>$error,"success"=>false];
            header("Location:".URL."/dashboard/menu.php");
            exit;
        }
    if(!empty($_FILES['uploadImgMenu'])){
        $statement=$connection->prepare('UPDATE menu
                                        SET srcImgMenu=:srcImgMenu,dateImgMenu=:dateImgMenu,extImgMenu=:extImgMenu,altImgMenu=:altImgMenu,
                                        WHERE menu.idMenu=:id');
        $statement->bindParam(':srcImgMenu', $_POST['srcImgMenu']);
        $statement->bindParam(':dateImgMenu', );
        $statement->bindParam(':extImgMenu', $types[$_FILES['uploadImgMenu']['type']]);
        $statement->bindParam(':altImgMenu', $_POST['altImgMenu']);
        $statement->bindParam(':priceMenu', $_POST['priceMenu']);
        $statement->bindParam(':id', $_POST['idMenu']);
        if(!$statement->execute()){
            $connection->rollBack();
            $error = "Couldn't edit menu.";
            $_SESSION["message"]=["message"=>$error,"success"=>false];
            header("Location:".URL."/dashboard/menu.php");
            exit;
        }
        $link ="../../../images/".$_POST['currentSrcImgMenu'].'_'.$_POST['currentDateImgMenu'].'.'.$_POST['currentExtImgMenu'];
        if(file_exists($link)){
            unlink($link);
        }
        $uploadImg = move_uploaded_file($_FILES['uploadImgMenu']['tmp_name'], '../../../images/'.$_POST['srcImgMenu'].'_'.$uniqueDate.'.'.$types[$_FILES['uploadImgMenu']['type']]);
        if(!$uploadImg){
            $connection->rollBack();
            $error = "Couldn't edit menu.";
            $_SESSION["message"]=["message"=>$error,"success"=>false];
            header("Location:".URL."/dashboard/menu.php");
            exit;
        }
    }
    if($connection->commit()){
        $result = "Menu is successfully edited in database.";
        $_SESSION["message"]=["message"=>$result,"success"=>true];
    }else{
        $error = "Menu is not successfully edited in database.";
        $_SESSION["message"]=["message"=>$error,"success"=>false];
    }
    header("Location:".URL."/dashboard/menu.php");
?>