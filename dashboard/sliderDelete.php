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
                <nav class="navbar navbar-expand navbar-light my-bg topbar mb-4 static-top shadow">    

                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-center my-color">Delete slider</h1>
                    <!-- DataTales Example -->
                    <div class="container my-4">
                        <?php require_once "assets/fixed/messages.php" ?>
                        <form action="<?php echo ACTIONDB ?>sliderDeleteAction.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="my-color" for="subHeading">Sub heading</label>
                                <input name="subHeading" type="text" class="form-control " id="subHeading" value="<?php echo $fetch->subHeading ?>" readonly/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="mainHeading">Main heading</label>
                                <input name="mainHeading" type="text" class="form-control" id="mainHeading" value="<?php echo $fetch->mainHeading ?>" readonly/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="postHeading">Post heading</label>
                                <input name="postHeading" type="text" class="form-control" id="postHeading" value="<?php echo $fetch->postHeading ?>" readonly/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="srcImgSlider">Image source</label>
                                <input name="srcImgSlider" type="text" class="form-control" id="srcImgSlider" value="<?php echo $fetch->srcImgSlider ?>" readonly/>
                                <p></p>
                            </div>
                            <input type="hidden" name="extImgSlider" id="extImgSlider" value="extImgSlider" />
                            <div class="form-group">
                                <label class="my-color" for="altImgSlider">Image description</label>
                                <input name="altImgSlider" type="text" class="form-control" id="altImgSlider" value="<?php echo $fetch->altImgSlider ?>" readonly/>
                                <p></p>
                            </div>
                            <div class="form-group col-12 text-center my-4">
                                <button type="submit" class="btn btn-danger py-3 px-5">Delete</button>
                            </div>
                        </form>
                    </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


<?php include_once "assets/fixed/footer.php" ?>