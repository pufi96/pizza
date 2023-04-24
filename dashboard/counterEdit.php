<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once "assets/fixed/header.php";
    include_once "assets/fixed/defines.php";
    require_once "../config/connection.php";
    $id = $_GET['id'];
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM counter WHERE counter.idCounter=$id LIMIT 1;");
    $statement->execute();
    $fetch = $statement->fetch();
    
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

    <!-- Topbar -->
    <?php include_once "mainNav.php" ?>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 my-5 my-color text-center">Edit counter</h1>
        <!-- DataTales Example -->
        <div class="container my-4">
            <?php require_once "assets/fixed/messages.php" ?>
            <form action="<?php echo ACTIONDB ?>counterEditAction.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="my-color" for="nameCounter">Name</label>
                    <input name="nameCounter" type="text" class="form-control" id="nameCounter" value="<?php echo $fetch->nameCounter ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="numberCounter">Number</label>
                    <input name="numberCounter" type="text" class="form-control" id="numberCounter" value="<?php echo $fetch->numberCounter ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="iconCounter">Icon</label>
                    <input name="iconCounter" type="text" class="form-control" id="iconCounter" value="<?php echo $fetch->iconCounter ?>" required/>
                    <p></p>
                </div>
                <div class="form-group col-12 text-center my-5">                                 <button type="submit" class="btn btn-primary mb-4  py-3 px-5">Edit</button>
                </div>
            </form>
        </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

</div>
        <!-- End of Content Wrapper -->
    <!-- Logout Modal-->
<?php include_once "assets/fixed/footer.php" ?>