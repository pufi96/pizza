<?php
    require_once "config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM nav;");
    $statement->execute();
    $fetch = $statement->fetchAll();
?>
<?php if(!empty($fetch)): ?>
    <div class="col-lg-4 col-md-6 mb-5 mb-md-5">
        <div class="ftco-footer-widget mb-4 ml-md-4">
            <h2 class="ftco-heading-2">Navigation</h2>
            <ul class="list-unstyled">
				<?php foreach($fetch as $el):?>
					<?php if($el->visibleNav == true): ?>
						<?php if($el->nameNav=="Login" && !empty($_SESSION["user"])): ?>
								<?php continue; ?>
							<?php elseif($el->nameNav=="Register" && !empty($_SESSION["user"])):?>
								<?php continue; ?>
							<?php elseif($el->nameNav=="Profile" && empty($_SESSION["user"])):?>
								<?php continue; ?>
							<?php elseif($el->nameNav=="Logout" && empty($_SESSION["user"])):?>
								<?php continue; ?>
							<?php else: ?>
								<li class="nav-item <?php echo $_GET["id"] ==$el->idNav ? "active" : ""; ?>">
									<a href="<?php echo $el->hrefNav.'?id='.$el->idNav ?>" class="nav-link"><?php echo $el->nameNav ?></a>
								</li>
							<?php endif; ?>
					<?php endif; ?>
				<?php endforeach; ?>						
            </ul>
        </div>
    </div>   
<?php endif; ?>
