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
                <nav class="navbar navbar-expand navbar-light my-bg topbar mb-4 static-top shadow">    

                </nav>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-center my-color">Create slider</h1>
                    <!-- DataTales Example -->
                    <div class="container my-4">
                        <?php require_once "assets/fixed/messages.php" ?>
                        <form action="<?php echo ACTIONDB ?>sliderCreateAction.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="my-color" for="subHeading">Sub heading</label>
                                <input name="subHeading" type="text" class="form-control " id="subHeading" placeholder="Welcome" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="mainHeading">Main heading</label>
                                <input name="mainHeading" type="text" class="form-control" id="mainHeading" placeholder="We cooked your desired Pizza Recipe" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="postHeading">Post heading</label>
                                <input name="postHeading" type="text" class="form-control" id="postHeading" placeholder="A small river named Duden flows by their place and supplies it with the necessary regelialia." required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="srcImgSlider">Image source</label>
                                <input name="srcImgSlider" type="text" class="form-control" id="srcImgSlider" placeholder="italianPizza" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="altImgSlider">Image description</label>
                                <input name="altImgSlider" type="text" class="form-control" id="altImgSlider" placeholder="Italian Pizza" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <input name="uploadImgSlider" type="file" id="uploadImgSlider" placeholder="" required/>
                                <label class="my-color" for="uploadImgSlider"></label>
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


<?php include_once "assets/fixed/footer.php" ?>