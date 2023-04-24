<?php
    require_once "config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM quickLinks;");
    $statement->execute();
    $fetch = $statement->fetchAll();
?>
<div class="col-lg-3 col-md-6 mb-5 mb-md-5">
    <div class="ftco-footer-widget mb-4">
        <h2 class="ftco-heading-2">Quick Links</h2>
        <?php foreach($fetch as $el): ?>
            <?php if($el->visibleLinks): ?>
                <div>
                    <a href="<?php echo $el->hrefLinks ?>"><?php echo $el->nameLinks ?></a>
                </div>                
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>