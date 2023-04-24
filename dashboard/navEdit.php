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
    $statement = $connection->prepare("SELECT * FROM nav WHERE nav.idNav=$id LIMIT 1;");
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
        <h1 class="h3 my-5 my-color text-center">Edit navigation</h1>
        <!-- DataTales Example -->
        <div class="container my-4">
            <?php require_once "assets/fixed/messages.php" ?>
            <form action="<?php echo ACTIONDB ?>navEditAction.php?id=<?php echo $id ?>" method="POST">
                <div class="form-group">
                    <label class="my-color" for="nameNav">Navigation name</label>
                    <input name="nameNav" type="text" class="form-control" id="nameNav" value="<?php echo $fetch->nameNav ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="linkNav">Navigation link</label>
                    <input name="linkNav" type="text" class="form-control" id="linkNav" value="<?php echo $fetch->hrefNav ?>" required/>
                    <p></p>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="my-color" >Navigation visible</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isVisible" id="visible" value="1" <?php echo $fetch->visibleNav == 1 ? "checked" : "" ?> required/>
                            <label name="visible" class="form-check-label my-color" for="visible">Visible</label> 
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isVisible" id="notVisible" value="2" <?php echo $fetch->visibleNav == 0 ? "checked" : "" ?> required/>
                            <label name="notVisible" class="form-check-label my-color" for="notVisible" >Not visible</label>
                        </div>
                    </div>
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

    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
<?php include_once "assets/fixed/footer.php" ?>