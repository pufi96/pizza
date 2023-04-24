<?php
    require_once "config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM counter;");
    $statement->execute();
    $fetch = $statement->fetchAll();
?>
<section class="ftco-counter ftco-bg-dark img" id="section-counter" style="background-image: url(images/bg_2.jpg);" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-10">
					<div class="row">
                        <?php if(!empty($fetch)):?>
                            <?php foreach($fetch as $el):?>
                                <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
                                    <div class="block-18 text-center">
                                        <div class="text">
                                            <div class="icon"><span class="flaticon-<?php echo $el->iconCounter ?>"></span></div>
                                            <strong class="number" data-number="<?php echo $el->numberCounter ?>">0</strong>
                                            <span><?php echo $el->nameCounter ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>