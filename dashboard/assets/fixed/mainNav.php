<?php
	if(session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!defined("URL")){
        include_once "defines.php";
    }
    if (empty($_SESSION["user"])) {
        $_SESSION["message"] = ["message" => "Login to your account.", "success" => false];
        header("Location:" . URL . "login.php?id=6");
        exit;
    }
    if ($_SESSION["user"]->nameRole != "Admin") {
        $_SESSION["message"] = ["message" => "Your not authorised for this page.", "success" => false];
        header("Location:" . URL . "index.php?id=1");
        exit;
    }
    require_once "../config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM nav;");
    $statement->execute();
    $fetch = $statement->fetchAll();
?>
<?php if(!empty($fetch)): ?>
		<div class="container">
			<a class="navbar-brand" href="<?php echo $fetch[0]->hrefNav ?>"><span class="flaticon-pizza-1 mr-1"></span>Pizza<br><small>Delicous</small></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="oi oi-menu"></span> Menu
				</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
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
								<li class="nav-item active">
									<a href="../<?php echo $el->hrefNav.'?id='.$el->idNav ?>" class="nav-link"><?php echo $el->nameNav ?></a>
								</li>
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; ?>						
				</ul>
			</div>
		</div>
<?php endif; ?>