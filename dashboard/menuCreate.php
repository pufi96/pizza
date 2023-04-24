<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    include_once "assets/fixed/header.php";
    include_once "assets/fixed/defines.php";
    require_once "../config/connection.php";
    $connection = getConnection();
    //preparestatement
    
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
        <h1 class="h3 my-5 my-color text-center">Create menu</h1>
        <!-- DataTales Example -->
        <div class="container my-4">
            <?php require_once "assets/fixed/messages.php" ?>
            <form action="<?php echo ACTIONDB ?>menuCreateAction.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="my-color" for="nameMenu">Name</label>
                    <input name="nameMenu" type="text" class="form-control" id="nameMenu" placeholder="Italian Pizza" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="descMenu">Description</label>
                    <input name="descMenu" type="text" class="form-control" id="descMenu" placeholder="Far far away, behind the word mountains, far from the countries Vokalia and Consonantia" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="srcImgMenu">Image source</label>
                    <input name="srcImgMenu" type="text" class="form-control" id="srcImgMenu" placeholder="pizza-1" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="altImgMenu">Image description</label>
                    <input name="altImgMenu" type="text" class="form-control" id="altImgMenu" placeholder="Italian Pizza" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="priceMenu">Price</label>
                    <input name="priceMenu" type="text" class="form-control" id="priceMenu" placeholder="5" required/>
                    <p></p>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="my-color" >Menu visible</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isVisible" id="visible" value="1"  required/>
                            <label name="visible" class="form-check-label my-color" for="visible">Visible</label> 
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isVisible" id="notVisible" value="0" required/>
                            <label name="notVisible" class="form-check-label my-color" for="notVisible" >Not visible</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input name="uploadImgMenu" type="file" id="uploadImgMenu" placeholder="" required/>
                    <label class="my-color" for="uploadImgMenu"></label>
                    <p></p>
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