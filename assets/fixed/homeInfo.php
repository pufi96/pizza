<?php
    require_once "config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM info;");
    $statement->execute();
    $fetch = $statement->fetchAll();
?>
<?php if(!empty($fetch)):?>
    <?php foreach($fetch as $el):?>
        <div class="col-md-4 my-1 d-flex ftco-animate">
			<div class="icon"><span class="icon-<?php echo $el->iconInfo ?>"></span></div>
			<div class="text">
				<h3><?php echo $el->textInfo ?></h3>
				<p><?php echo $el->descInfo ?></p>
			</div>
		</div>
    <?php endforeach; ?>
<?php endif; ?>