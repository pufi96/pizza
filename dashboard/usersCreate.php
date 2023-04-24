<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once "assets/fixed/header.php";
include_once "assets/fixed/defines.php"; ?>
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
                    <h1 class="h3 my-5 text-gray-800 text-center my-color">Create user</h1>
                    <!-- DataTales Example -->
                    <div class="container my-4">
                        <?php require_once "assets/fixed/messages.php" ?>
                        <form action="<?php echo ACTIONDB ?>userCreateAction.php" method="POST">
                            <div class="form-group">
                                <label class="my-color" for="fName">First name</label>
                                <input name="fName" type="text" class="form-control " id="fName" placeholder="Pera" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="lName">Last name</label>
                                <input name="lName" type="text" class="form-control" id="lName" placeholder="Peric" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="email">Email</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="pera@gmail.com" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="password">Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Password" required/>
                                <p></p>
                            </div>
                            <div class="form-group">
                                <label class="my-color" for="address">Address</label>
                                <input name="address" type="text" class="form-control" id="address" placeholder="Požeška bb" required/>
                                <p></p>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="my-color">Check gender</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" required/>
                                        <label name="male" class="form-check-label" for="male">Male</label>
                                        <p></p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" required/>
                                        <label name="female" class="form-check-label" for="female">Female</label>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="my-color">Choose role</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="1" value="1" required/>
                                        <label name="1" class="form-check-label" for="1">Unauthorised</label>
                                        <p></p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="2" value="2" required/>
                                        <label name="2" class="form-check-label" for="2">Authorised</label>
                                        <p></p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="role" id="female" value="female" required/>
                                        <label name="female" class="form-check-label" for="female">Admin</label>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="my-color">Choose status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="male" value="male" required/>
                                        <label name="male" class="form-check-label" for="male">Verified</label>
                                        <p></p>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="female" value="female" required/>
                                        <label name="female" class="form-check-label" for="female">Unverified</label>
                                        <p></p>
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


<?php include_once "assets/fixed/footer.php" ?>