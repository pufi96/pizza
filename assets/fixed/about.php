<?php
    require_once "config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM about LIMIT 1;");
    $statement->execute();
    $fetch = $statement->fetch();
?>

<?php if(!empty($fetch)):?>
    <section class="ftco-about d-md-flex" id="about">
    	<div class="one-half img" style="background-image: url(images/<?php echo $fetch->srcImgAbout.'.'.$fetch->extImgAbout ?>);"></div>
    	<div class="one-half ftco-animate">
			<div class="heading-section ftco-animate ">
				<h2 class="mb-4"><?php echo $fetch->nameAbout ?></h2>
			</div>
			<div>
  				<p><?php echo $fetch->descAbout ?></p>
  			</div>
    	</div>
	</section>
<?php endif; ?>