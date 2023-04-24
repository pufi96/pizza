<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once "assets/fixed/header.php";
require_once "assets/fixed/nav.php";
require_once "assets/fixed/homeSlider.php";
if (!defined("URL")) {
  include_once "assets/fixed/defines.php";
}
?>
<div class="container my-4">
  <?php require_once "assets/fixed/messages.php" ?>
  <div class="row">
    <?php require_once "assets/fixed/contactInfo.php" ?>
    <div class="col-md-6">
     <form action="<?php echo URL ?>/assets/fixed/contactAction.php" method="POST">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <label class="my-color" for="fName">First name</label>
              <input name="fName" id="fName" type="text" class="form-control" placeholder="First Name" required/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
            <label class="my-color" for="lName">Last name</label>
              <input name="lName" id="lName" type="text" class="form-control" placeholder="Last Name" required/>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="my-color" for="email">Email</label>
          <input name="email" type="email" class="form-control" placeholder="Email" required/>
        </div>
        <div class="form-group">
          <label class="my-color" for="message">Message</label>
          <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary py-3 px-5">Send Message</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
require_once "assets/fixed/footer.php";
?>