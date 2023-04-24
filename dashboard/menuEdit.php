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
    $statement = $connection->prepare("SELECT * FROM menu WHERE menu.idMenu=$id LIMIT 1;");
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
        <h1 class="h3 my-5 my-color text-center">Edit menu</h1>
        <!-- DataTales Example -->
        <div class="container my-4">
            <?php require_once "assets/fixed/messages.php" ?>
            <form action="<?php echo ACTIONDB ?>menuEditAction.php?id=<?php echo $id ?>" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="my-color" for="nameMenu">Name</label>
                    <input name="nameMenu" type="text" class="form-control" id="nameMenu" value="<?php echo $fetch->nameMenu ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="descMenu">Description</label>
                    <input name="descMenu" type="text" class="form-control" id="descMenu" value="<?php echo $fetch->descMenu ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="srcImgMenu">Image source</label>
                    <input name="srcImgMenu" type="text" class="form-control" id="srcImgMenu" value="<?php echo $fetch->srcImgMenu ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="altImgMenu">Image description</label>
                    <input name="altImgMenu" type="text" class="form-control" id="altImgMenu" value="<?php echo $fetch->altImgMenu ?>" required/>
                    <p></p>
                </div>
                <div class="form-group">
                    <label class="my-color" for="priceMenu">Price</label>
                    <input name="priceMenu" type="text" class="form-control" id="priceMenu" value="<?php echo $fetch->priceMenu ?>" required/>
                    <p></p>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="my-color" >Menu visible</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isVisible" id="visible" value="1" <?php echo $fetch->visibleMenu == 1 ? "checked" : "" ?> required/>
                            <label name="visible" class="form-check-label my-color" for="visible">Visible</label> 
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isVisible" id="notVisible" value="0" <?php echo $fetch->visibleMenu == 0 ? "checked" : "" ?> required/>
                            <label name="notVisible" class="form-check-label my-color" for="notVisible" >Not visible</label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <input name="uploadImgmenu" type="file" id="uploadImgmenu" placeholder=""/>
                    <label class="my-color" for="uploadImgmenu"></label>
                    <p></p>
                </div>
                <input type="hidden" name="currentSrcImgMenu" id="currentSrcImgMenu" value="<?php echo $fetch->srcImgMenu ?>" />
                <input type="hidden" name="currentExtImgMenu" id="currentExtImgMenu" value="<?php echo $fetch->extImgMenu ?>" />
                <input type="hidden" name="idMenu" id="idMenu" value="<?php echo $fetch->idMenu ?>"/>
                <div class="round">
                    <img  class="img-fluid imgEdit" src="../images/<?php echo $fetch->srcImgMenu ?>.<?php echo $fetch->extImgMenu ?>" alt="<?php echo $fetch->altImgMenu ?>" />
                </div>
                <div class="form-group col-12 text-center my-5">                                 <button type="submit" class="btn btn-primary mb-4  py-3 px-5">Edit</button>
                </div>
            </form>
        </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

    <!-- Logout Modal-->
<?php include_once "assets/fixed/footer.php" ?>