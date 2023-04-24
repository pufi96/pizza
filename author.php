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

<?php
require_once "assets/fixed/footer.php";
?>