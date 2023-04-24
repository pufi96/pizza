<?php
    require_once "config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM info;");
    $statement->execute();
    $fetch = $statement->fetchAll();
?>
<div class="col-md-4 contact-info mt-5">
	<div class="row">
		<div class="col-md-12 mb-4">
	      <h2 class="h4">Contact Information</h2>
	    </div>
        <?php foreach($fetch as $el): ?>
            <div class="col-md-12 mb-3">
                <p>
                    <span><?php echo $el->nameInfo ?>:</span> 
                    <span class="my-color"><?php echo $el->textInfo ?></span>
                </p>
            </div>
        <?php endforeach ?>
	</div>
</div>