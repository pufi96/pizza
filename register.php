<?php
if (!defined("URL")) {
  include_once "assets/fixed/defines.php";
}
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!empty($_SESSION["user"])) {
  header("Location:" . URL . "profile.php?id=10");
  exit;
}
require_once "assets/fixed/header.php";
require_once "assets/fixed/nav.php";
require_once "assets/fixed/homeSlider.php";
?>
<div class="container my-4">
  <?php require_once "assets/fixed/messages.php" ?>
  <div id="registerConfirm"></div>
  <form action="<?php echo URL ?>registerAction.php" method="POST">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label class="my-color" for="fName">First Name</label>
        <input name="fName" type="text" class="form-control" id="fName" placeholder="First Name" required/>
        <p></p>
      </div>
      <div class="form-group col-md-6">
        <label class="my-color" for="lName">Last Name</label>
        <input name="lName" type="text" class="form-control" id="lName" placeholder="Last Name" required/>
        <p></p>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label class="my-color" for="email">Email</label>
        <input name="email" type="email" class="form-control" id="email" placeholder="Email" required/>
        <p></p>
      </div>
      <div class="form-group col-md-6">
        <label class="my-color" for="password">Password</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="Password" required/>
        <p></p>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
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
      <div class="form-group col-md-6">
        <label class="my-color" for="address">Address</label>
        <input name="address" type="text" class="form-control" id="address" placeholder="Address" required/>
        <p></p>
      </div>
    </div>
    <div class="form-group col-12 text-center my-4">
      <button id="btnRegister" type="submit" class="btn btn-primary py-3 px-5">Register</button>
    </div>
  </form>
</div>
<?php
require_once "assets/fixed/footer.php";
?>