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
    $statement = $connection->prepare("SELECT * FROM slider WHERE slider.idSlider=$id LIMIT 1;");
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
            <form action="<?php echo ACTIONDB ?>sliderEditAction.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="my-color" for="subHeading">Sub heading</label>
                    <input name="subHeading" type="text" class="form-control" id="subHeading" value="<?php echo $fetch->subHeading ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="mainHeading">Main heading</label>
                    <input name="mainHeading" type="text" class="form-control" id="mainHeading" value="<?php echo $fetch->mainHeading ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="postHeading">Post heading</label>
                    <input name="postHeading" type="text" class="form-control" id="postHeading" value="<?php echo $fetch->postHeading ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="srcImgSlider">Image source</label>
                    <input name="srcImgSlider" type="text" class="form-control" id="srcImgSlider" value="<?php echo $fetch->srcImgSlider ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="altImgSlider">Image description</label>
                    <input name="altImgSlider" type="text" class="form-control" id="altImgSlider" value="<?php echo $fetch->altImgSlider ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <input name="uploadImgSlider" type="file" id="uploadImgSlider" placeholder="" required/>
                    <label class="my-color" for="uploadImgSlider"></label>
                    <p></p>
                </div>
                <input type="hidden" name="currentSrcImgSlider" id="currentSrcImgSlider" value="<?php echo $fetch->srcImgSlider ?>" />
                <input type="hidden" name="currentExtImgSlider" id="currentExtImgSlider" value="<?php echo $fetch->extImgSlider ?>" />
                <input type="hidden" name="idSlider" id="idSlider" value="<?php echo $fetch->idSlider ?>"/>
                <div class="round">
                    <img  class="img-fluid imgEdit" src="../images/<?php echo $fetch->srcImgSlider ?>.<?php echo $fetch->extImgSlider ?>" alt="<?php echo $fetch->altImgSlider ?>" />
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