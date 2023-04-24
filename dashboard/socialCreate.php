<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once "assets/fixed/header.php";
    include_once "assets/fixed/defines.php"; 
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
        <h1 class="h3 my-5 my-color text-center">Create navigation</h1>
        <!-- DataTales Example -->
        <div class="container my-4">
            <?php require_once "assets/fixed/messages.php" ?>
            <form action="<?php echo ACTIONDB ?>socialCreateAction.php" method="POST">
                <div class="form-group">
                    <label class="my-color" for="nameSocial">Social name</label>
                    <input name="nameSocial" type="text" class="form-control" id="nameSocial" placeholder="Facebook" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="linkSocial">Social link</label>
                    <input name="linkSocial" type="text" class="form-control" id="linkSocial" placeholder="facebook.com" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="iconSocial">Social icon</label>
                    <input name="iconSocial" type="text" class="form-control" id="iconSocial" placeholder="facebook" required/>
                    <p></p>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="my-color" >Social visible</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isVisible" id="visible" value="1" required/>
                            <label name="visible" class="form-check-label my-color" for="visible">Visible</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isVisible" id="notVisible" value="0" required/>
                            <label name="notVisible" class="form-check-label my-color" for="notVisible">Not visible</label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-12 text-center my-4">
                    <button type="submit" class="btn btn-primary mb-5 py-3 px-5">Create</button>
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