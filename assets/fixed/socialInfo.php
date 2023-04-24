<?php
    require_once "config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM social;");
    $statement->execute();
    $fetch = $statement->fetchAll();
?>
<?php if(!empty($fetch)):?>
    <?php foreach($fetch as $el):?>
        <?php if($el->visibleSocial): ?>
            <li class="ftco-animate"><a href="<?php echo $el->hrefSocial ?>"><span class="icon-<?php echo $el->iconSocial ?>"></span></a></li>
        <?php endif ?>
    <?php endforeach; ?>
<?php endif; ?>