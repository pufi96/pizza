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
    $statement = $connection->prepare("SELECT * FROM info WHERE info.idInfo=$id LIMIT 1;");
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
        <h1 class="h3 my-5 my-color text-center">Edit information</h1>
        <!-- DataTales Example -->
        <div class="container my-4">
            <?php require_once "assets/fixed/messages.php" ?>
            <form action="<?php echo ACTIONDB ?>infoEditAction.php?id=<?php echo $id ?>" method="POST">
                <div class="form-group">
                    <label class="my-color" for="nameInfo">Name</label>
                    <input name="nameInfo" type="text" class="form-control" id="nameInfo" value="<?php echo $fetch->nameInfo ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="textInfo">Info</label>
                    <input name="textInfo" type="text" class="form-control" id="textInfo" value="<?php echo $fetch->textInfo ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="descInfo">Description</label>
                    <input name="descInfo" type="text" class="form-control" id="descInfo" value="<?php echo $fetch->descInfo ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="iconInfo">Icon</label>
                    <input name="iconInfo" type="text" class="form-control" id="iconInfo" value="<?php echo $fetch->iconInfo ?>" required/>
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