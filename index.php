<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
require_once "assets/fixed/header.php";
require_once "assets/fixed/nav.php";
require_once "assets/fixed/messages.php";
require_once "assets/fixed/slider.php";
$servicesIcon = [
  ["icon" => "flaticon-diet", "name" => "Healthy Foods", "desc" => "Discover our collection of healthy pizza recipes ."],
  ["icon" => "flaticon-bicycle", "name" => "Fresh Ingredients", "desc" => "We use only fresh ingredients."],
  ["icon" => "flaticon-pizza-1", "name" => "Original Recipes", "desc" => "We offer only homemade traditional pizza's."]
];
?>
<section class="ftco-intro">
  <div class="container-wrap">
    <div class="wrap d-md-flex">
      <div class="info">
        <div class="row no-gutters">
          <?php require_once "assets/fixed/homeInfo.php" ?>
        </div>
      </div>
      <div class="social d-md-flex pl-md-5 p-4 align-items-center">
        <ul class="social-icon">
          <?php require_once "assets/fixed/socialInfo.php" ?>
        </ul>
      </div>
    </div>
  </div>
</section>
<?php require_once "assets/fixed/about.php" ?>
<!-- ikonice-->
<section class="ftco-section ftco-services">
  <div class="overlay"></div>
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section ftco-animate text-center">
        <h2 class="mb-4">Our Services</h2>
        <p></p>
      </div>
    </div>
    <div class="row">
      <?php foreach ($servicesIcon as $el) : ?>
        <div class="col-md-4 ftco-animate">
          <div class="media d-block text-center block-6 services">
            <div class="icon d-flex justify-content-center align-items-center mb-5">
              <span class="<?php echo $el["icon"] ?>"></span>
            </div>
            <div class="media-body">
              <h3 class="heading"><?php echo $el["name"] ?></h3>
              <p><?php echo $el["desc"] ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php require_once "assets/fixed/counter.php" ?>
<section class="ftco-section" id="menuHeader">
  <div class="container">
    <div class="row justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section ftco-animate text-center">
        <h2 class="mb-4">Hot Pizza Meals</h2>
      </div>
    </div>
  </div>
  <div class="container-wrap">
    <div class="mx-auto md-form form-group ml-2 w-75">
      <input type="text" class="form-control" name="searchMenu" id="searchMenu" data-user="<?php echo !empty($_SESSION["user"]) ? true : false ?>" placeholder="Search here"/>
      <p id="responseText"></p>
      <div class="d-flex justify-content-center">
        <button id="bthSearchMenu" class="btn btn-primary my-3 p-2 rounded" data-user="<?php echo !empty($_SESSION["user"]) ? true : false ?>">search</button>
      </div>
    </div>
    <div class="row no-gutters d-flex" id="menu">
      <?php require_once "assets/fixed/menu.php" ?>
    </div>
    <div id="paginationMenu">
      <?php require_once "assets/fixed/pagination.php" ?>
    </div>
  </div>
</section>
<?php
require_once "assets/fixed/footer.php";
?>