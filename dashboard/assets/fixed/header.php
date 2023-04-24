<?php
if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!defined("URL")) {
    require_once "../assets/fixed/defines.php";
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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin 2 - Dashboard</title>

        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.css" rel="stylesheet" type="text/css">

        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">

    </head>
    <body id="page-top">