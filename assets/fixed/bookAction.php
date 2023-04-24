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

    $dateCurrent = date("Y-m-d");

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

    if(empty($_POST['number']) || !preg_match($reNumber, $_POST['number'])){

        $errors['number'] = 'Number must have min 7 numbers and max 11 numbers.';

    }

    if(empty($_POST['date']) || DateTime::createFromFormat("Y-m-d",$_POST['date']) < DateTime::createFromFormat("Y-m-d",$dateCurrent)){

        $errors['date'] = 'Date is required and must be selected at least 1 day ahead.';

    }

    if(empty($_POST['time']) || !preg_match($reTime, $_POST['time'])){

        $errors['time'] = 'Time is required. And must be 08:00 - 20:59.';

    }

    if(!empty($_POST['message']) && !preg_match($reText, $_POST['message'])){

        $errors['messageBook'] = 'Message is not in text format.';

    }

    if(!empty($errors)){

        $error = "Booking form wasn't successfull.";

        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];

        header("Location:".URL."/book.php?id=4");

        exit;

    }

    $dateTimeBooked = $_POST['date']." ".$_POST['time'].":00";

    require_once "../../config/connection.php";

    $connection = getConnection();

    $statement=$connection->prepare('INSERT INTO book (firstNameBook,lastNameBook,numberBook,emailBook,bookedDatetimeBook,currentDatetimeBook,messageBook) VALUES (:firstNameBook,:lastNameBook,:numberBook,:emailBook,:bookedDatetimeBook,:currentDatetimeBook,:messageBook)');

    $statement->bindParam('firstNameBook', $_POST['fName']);

    $statement->bindParam('lastNameBook', $_POST['lName']);

    $statement->bindParam('numberBook', $_POST['number']);

    $statement->bindParam('emailBook', $_POST['email']);

    $statement->bindParam('bookedDatetimeBook', $dateTimeBooked);

    $statement->bindParam('currentDatetimeBook', $dateTimeCurrent);

    $statement->bindParam('messageBook', $_POST['message']);

    if($statement->execute()){

        $result="Successfull booked.";

        $_SESSION["message"]=["message"=>$result,"success"=>true];

    }else{

        $error="Booking wasn't successfull.";

        $_SESSION["message"]=["message"=>$error,"success"=>false];

    }

    header("Location:".URL."/book.php?id=4");

?>