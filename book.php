<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
if (!defined("URL")) {
  include_once "assets/fixed/defines.php";
}
require_once "assets/fixed/header.php";
require_once "assets/fixed/nav.php";
require_once "assets/fixed/homeSlider.php";
?>
<section class="ftco-section contact-section">
  <div class="container mt-5">

    <div id="bookConfirm"></div>
    <?php require_once "assets/fixed/messages.php" ?>
    <div class="row block-9">
      <?php require_once "assets/fixed/contactInfo.php" ?>
      <div class="col-md-1"></div>
      <div class="col-md-6 ftco-animate">
        <form action="<?php echo URL ?>/assets/fixed/bookAction.php" method="POST" id="bookForm">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="my-color" for="fName">First name</label>
                <input name="fName" id="fName" type="text" class="form-control" placeholder="First Name" required />
                <p></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="my-color" for="lName">Last name</label>
                <input name="lName" id="lName" type="text" class="form-control" placeholder="Last Name" required />
                <p></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="my-color" for="number">Number</label>
                <input name="number" id="number" type="text" class="form-control" placeholder="Contact number" required />
                <p></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="my-color" for="email">Email</label>
                <input name="email" type="email" class="form-control" placeholder="Email" required />
                <p></p>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="my-color" for="date">Date</label>
                <input name="date" id="date" type="date" class="form-control" required />
                <p></p>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="my-color" for="time">Time</label>
                <input name="time" type="time" id="time" class="form-control" min="08:00" max="21:00" required />
                <p></p>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="my-color" for="message">Message</label>
            <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
            <p></p>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary py-3 px-5">Book now</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php
require_once "assets/fixed/footer.php";
?>