<?php

    if(session_status() == PHP_SESSION_NONE) {

        session_start();

    }

    if(!defined("URL")){

        include_once "assets/fixed/defines.php";

    }

    if(!empty($_SESSION["user"])){

        header("Location:".URL."/profile.php?id=10");

        exit;

    }

    if(empty($_POST)){

        header("Location:".URL."/register.php?id=7");

        exit;

    }

    use PHPMailer\PHPMailer\PHPMailer;

    use PHPMailer\PHPMailer\Exception;

    include_once "assets/fixed/regex.php";

    if(empty($_POST['fName']) || !preg_match($reName, $_POST['fName'])){

        $errors['fName'] = 'First name is required. First name must have at least 3 characters and first letter upper and max 20 characters.';

    }

    if(empty($_POST['lName']) || !preg_match($reName, $_POST['lName'])){

        $errors['lName'] = 'Last name is required. Last name must have at least 3 characters and first letter upper and max 20 characters.';

    }                               

    if(empty($_POST['email']) || !preg_match($reEmail, $_POST['email'])){

        $errors['email'] = 'Email is required.';

    }

    require_once "config/connection.php";

    $connection = getConnection();

    $connection->beginTransaction();

    $checkMail=$connection->prepare('SELECT COUNT(*)

                                    FROM users

                                    WHERE users.email = :email');

    $checkMail->bindParam('email', $_POST['email']);

    if(!$checkMail->execute()){

        $errors['email'] = 'Error with database. Contact Administrator.';

    }

    if ((int) $checkMail->fetchColumn()){

        $errors['inUse'] = 'Email is already in use.';

    }

    if(empty($_POST['password']) || !preg_match($rePassword, $_POST['password'])){

        $errors['password'] = 'Password must have minimum 8 caracters which have 1 upper case, 1 lower case, number and special caracter.';

    }

    if(empty($_POST['gender'])){

        $errors['gender'] = 'Gender is required.';

    }

    if($_POST['gender']!="female" && $_POST['gender']!="male"){

        $errors['gender'] = 'Gender is required f.';

    }

    if(empty($_POST['address']) || !preg_match($reAddress, $_POST['address'])){

        $errors['address'] = 'Address is required.';

    }

    if(!empty($errors)){

        $error = "Failed registration";

        $_SESSION["message"]=["message"=>$error,"success"=>false,"errors"=>$errors];

        header("Location:".URL."/register.php?id=7");

        exit;

    }

    $key = uniqid();

    $statement=$connection->prepare('INSERT INTO users(firstName,lastName,password,email,gender,address,secretKey) 

                                    VALUES (:firstName,:lastName,:password,:email,:gender,:address,:key)');

    $statement->bindParam('firstName', $_POST['fName']);

    $statement->bindParam('lastName', $_POST['lName']);

    $hashedPassword = md5($_POST['password']);

    $statement->bindParam('password', $hashedPassword);

    $statement->bindParam('email', $_POST['email']);

    $statement->bindParam('gender', $_POST['gender']);

    $statement->bindParam('address', $_POST['address']);

    $statement->bindParam('key', $key);

    if(!$statement->execute()){

        $error="Failed insert into database. ";

        $_SESSION["message"]=["message"=>$error,"success"=>false];

        header("Location:".URL."/register.php?id=7");

        exit;

    }

        $idUser = $connection->lastInsertId();

        $result="Successfull registration. Check email for activation.";

        $_SESSION["message"]=["message"=>$result,"success"=>true];

        $to      =  $_POST['email'];

        $subject =  'Activation Link';

        $message =  '<html> 

                        <head>

                        </head>

                        <body>

                            <span>

                                Successfull registration. To activate your account press on 

                            </span>

                            <span>

                                <a href="https://pizzadelicousphp.000webhostapp.com/activation.php?key='.$key.'&id='.$idUser.'">

                                    Click Here!

                                </a>

                            </span>

                        </body> 

                    </html>';

    require $_SERVER['DOCUMENT_ROOT'] . '/mail/Exception.php';

    require $_SERVER['DOCUMENT_ROOT'] . '/mail/PHPMailer.php';

    require $_SERVER['DOCUMENT_ROOT'] . '/mail/SMTP.php';

    $mail = new PHPMailer;

    $mail->IsSMTP(); 

    $mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages

    $mail->Host = gethostbyname('smtp.gmail.com'); // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6

    $mail->Port = 587; // TLS only

    $mail->SMTPSecure = 'tls'; // ssl is deprecated

    $mail->SMTPAuth = true;

    $mail->Username = 'pizza.delicous.office@gmail.com'; // email

    $mail->Password = 'Admin12345.'; // password

    $mail->setFrom('office@pizza.com', 'Pizza Delicious Office'); // From email and name

    $mail->addAddress($to); // to email and name

    $mail->Subject = $subject;

    $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,

    $mail->AltBody = 'https://pizzadelicousphp.000webhostapp.com/activation.php?key='.$key.'&id='.$idUser.' Click Here!'; // If html emails is not supported by the receiver, show this body

    // $mail->addAttachment('images/phpmailer_mini.png'); //Attach an image file

    $mail->SMTPOptions = array(

                        'ssl' => array(

                            'verify_peer' => false,

                            'verify_peer_name' => false,

                            'allow_self_signed' => true

                        )

                    );

    if(!$mail->Send()){

        $connection->rollBack();

        $error="Failed to send mail please contact administrator. ";

        $_SESSION["message"]=["message"=>$error,"success"=>false];

        header("Location:".URL."/register.php?id=7");

        exit;

    }

    $connection->commit();

    header("Location:".URL."/login.php?id=6");

?>