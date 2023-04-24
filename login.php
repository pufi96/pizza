<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!defined("URL")) {
  include_once "assets/fixed/defines.php";
}
if (!empty($_SESSION["user"])) {
  header("Location:" . URL . "profile.php?id=10");
  exit;
}
require_once "assets/fixed/header.php";
require_once "assets/fixed/nav.php";
require_once "assets/fixed/homeSlider.php";
?>
<div class="container my-5">
  <?php require_once "assets/fixed/messages.php" ?>
  <form action="<?php echo URL ?>assets/fixed/loginAction.php" method="POST">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label class="my-color" for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Email"/>
        <p></p>
      </div>
      <div class="form-group col-md-6">
        <label class="my-color" for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
        <p></p>
      </div>
      <div class="form-group col-12 text-center my-4">
        <button type="submit" class="btn btn-primary py-3 px-5">Login</button>
      </div>
    </div>
  </form>
</div>
<?php
require_once "assets/fixed/footer.php";
?>