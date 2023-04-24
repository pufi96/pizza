<?php
    require_once "../config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT *  FROM nav;");
    $statement->execute();
    $menu = $statement->fetchAll();
?>
<?php if(!empty($menu)): ?>
	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar my-bg ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<a class="navbar-brand" href="../<?php echo $menu[0]->hrefNav ?>?id=<?php echo $menu[0]->idNav ?>">
				<span class="flaticon-pizza-1 mr-1 my-color"></span>
				Pizza<br>
				<small class="my-color">Delicous</small>
			</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="oi oi-menu"></span> Menu
				</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<?php foreach($menu as $el):?>
						<?php if($el->visibleNav == "1"): ?>
							<?php if($el->nameNav=="Register" && !empty($_SESSION["user"])):?>
								<?php continue; ?>
							<?php elseif($el->nameNav=="Profile" && empty($_SESSION["user"])):?>
								<?php continue; ?>
							<?php elseif($el->nameNav=="Logout" && empty($_SESSION["user"])):?>
								<?php continue; ?>
							<?php elseif($el->nameNav=="DB" && empty($_SESSION["user"])):?>
								<?php continue; ?>
								<?php if($_SESSION["user"]->nameRole!="Admin") continue; ?>
							<?php else: ?>
								<li class="nav-item">
									<a href="../<?php echo $el->hrefNav.'?id='.$el->idNav ?>" class="nav-link <?php echo $el->nameNav=="DB" ? "active" : ""; ?>"><?php echo $el->nameNav ?></a>
								</li>
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; ?>						
				</ul>
			</div>
		</div>
	</nav>    
<?php endif; ?>