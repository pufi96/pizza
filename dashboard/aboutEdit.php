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
    $statement = $connection->prepare("SELECT * FROM about WHERE about.idAbout=$id LIMIT 1;");
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
        <h1 class="h3 my-5 my-color text-center">Edit about</h1>
        <!-- DataTales Example -->
        <div class="container my-4">
            <?php require_once "assets/fixed/messages.php" ?>
            <form action="<?php echo ACTIONDB ?>aboutEditAction.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="my-color" for="nameAbout">Name</label>
                    <input name="nameAbout" type="text" class="form-control" id="nameAbout" value="<?php echo "Name" ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="descAbout">Description</label>
                    <input name="descAbout" type="text" class="form-control" id="descAbout" value="<?php echo $fetch->descAbout ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="srcImgAbout">Image source</label>
                    <input name="srcImgAbout" type="text" class="form-control" id="srcImgAbout" value="<?php echo $fetch->srcImgAbout ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="altImgAbout">Image description</label>
                    <input name="altImgAbout" type="text" class="form-control" id="altImgAbout" value="<?php echo $fetch->altImgAbout ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <input name="uploadImgAbout" type="file" id="uploadImgAbout" placeholder=""/>
                    <label class="my-color" for="uploadImgAbout"></label>
                    <p></p>
                </div>
                <input type="hidden" name="currentSrcImgAbout" id="currentSrcImgAbout" value="<?php echo $fetch->srcImgAbout ?>" />
                <input type="hidden" name="currentExtImgAbout" id="currentExtImgAbout" value="<?php echo $fetch->extImgAbout ?>" />
                <input type="hidden" name="idSlider" id="idSlider" value="<?php echo $fetch->idAbout ?>"/>
                <div class="round">
                    <img  class="img-fluid imgEdit" src="../images/<?php echo $fetch->srcImgAbout ?>.<?php echo $fetch->extImgAbout ?>" alt="<?php echo $fetch->altImgAbout ?>" />
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