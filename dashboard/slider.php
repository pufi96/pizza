<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once "assets/fixed/header.php"
?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once "dbNav.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

    
    <?php include_once "mainNav.php" ?>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <?php require_once "../assets/fixed/messages.php" ?>
        <!-- Page Heading -->
        <h1 class="h3 my-5 text-center my-color">Slider at home page</h1>
        

        <!-- DataTales Example -->
        <?php include_once "sliderShow.php" ?>
        

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php include_once "assets/fixed/footer.php" ?>