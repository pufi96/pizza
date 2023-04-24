<?php
    require_once "../config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM info;");
    $statement->execute();
    $fetch = $statement->fetchAll();
?>
<?php if(!empty($fetch)): ?>
    <div class="col-lg-5 col-md-6 mb-5 mb-md-5">
        <div class="ftco-footer-widget mb-4">
            <h2 class="ftco-heading-2">Have a Questions?</h2>
            <div class="block-23 mb-3">
	            <ul>
                    <?php foreach($fetch as $el):?>
                        <li>
                            <span class="icon-<?php echo $el->iconInfo ?>">     </span>
                            <span><?php echo $el->textInfo ?></span>
                            <?php if($el->descInfo == "8:00am - 9:00pm"): ?>
                                <p"><?php echo $el->descInfo ?></p>
                            <?php endif;?>
                        </li>
                    <?php endforeach; ?>
                    <li> 
                        <span class="icon-envelope"> </span>
                        <span>office@pizza.com</span>
                    </li>
                </ul>
	        </div>
        </div>
    </div>
<?php endif; ?>