<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

include_once "assets/fixed/header.php";
include_once "assets/fixed/defines.php";

if(empty($_GET['id'])){
    header("Location:".URL."/users.php");
    exit;
}
$id = $_GET['id'];
require_once "../config/connection.php";
$connection = getConnection();
//preparestatement
$statement = $connection->prepare(" SELECT * 
                                    FROM users AS u
                                    WHERE u.idUser = $id");
$statement->execute();
$fetch = $statement->fetch();
?>
<?php if (!empty($fetch)): ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include_once "dbNav.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

            <?php include_once "mainNav.php" ?>
                <!-- Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 my-5 text-gray-800 text-center my-color">Edit user</h1>
                    <!-- DataTales Example -->
                    <div class="container my-4">
                        <?php require_once "assets/fixed/messages.php" ?>
                        <form action="<?php echo ACTIONDB ?>userEditAction.php" method="POST">
                            <div class="form-group">
                                <label class="my-color" for="fName">First name</label>
                                <input name="fName" type="text" class="form-control " id="fName" value="<?php echo $fetch->firstName?>" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="lName">Last name</label>
                                <input name="lName" type="text" class="form-control" id="lName" value="<?php echo $fetch->lastName ?>" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email" value="<?php echo $fetch->email ?>" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Enter new password"/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="passwordConfirm">Password</label>
                                <input name="passwordConfirm" type="password" class="form-control" id="passwordConfirm" placeholder="Confirm new password"/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="address">Address</label>
                                <input name="address" type="text" class="form-control" id="address" value="<?php echo $fetch->address ?>" required/>
                                <p></p>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="my-color">Check gender</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php echo $fetch->gender=="male" ? "checked" : "" ?> required/>
                                        <label name="male" class="form-check-label" for="male">Male</label>
                                        <p></p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php echo $fetch->gender=="female" ? "checked" : "" ?> required/>
                                        <label name="female" class="form-check-label" for="female">Female</label>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="my-color">Choose role</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="0" value="0" <?php echo $fetch->idRole=="0" ? "checked" : "" ?> required/>
                                        <label name="0" class="form-check-label" for="1">Unauthorised</label>
                                        <p></p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="1" value="1" <?php echo $fetch->idRole=="1" ? "checked" : "" ?> required/>
                                        <label name="1" class="form-check-label" for="1">Authorised</label>
                                        <p></p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="2" value="2" <?php echo $fetch->idRole=="2" ? "checked" : "" ?> required/>
                                        <label name="3" class="form-check-label" for="2">Admin</label>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="my-color">Choose status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="verified" value="1" <?php echo $fetch->status=="1" ? "checked" : "" ?> required/>
                                        <label name="verified" class="form-check-label" for="verified">Verified</label>
                                        <p></p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="unverified" value="0" <?php echo $fetch->status=="0" ? "checked" : "" ?> required/>
                                        <label name="unverified" class="form-check-label" for="unverified">Unverified</label>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input name="id" type="hidden" class="form-control" id="id" value="<?php echo $id ?>" required/>
                                <p></p>
                            </div>
                            <div class="form-group col-12 text-center my-4">
                                <button type="submit" class="btn btn-primary mb-5 py-3 px-5">Edit</button>
                            </div>
                        </form>
                    </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
<?php endif; ?>
<?php include_once "assets/fixed/footer.php" ?>