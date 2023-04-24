<?php
require_once "config/connection.php";
$connection = getConnection();
//preparestatement
$getLimit = 6;
$statementCount = $connection->query(" SELECT COUNT(*)
                                    FROM menu");
$statementCount->execute();
$fetchCount = $statementCount->fetchColumn();
$numberOfPages = (int) ceil($fetchCount/6);
$statement = $connection->query(" SELECT *, m.idMenu as idMenu, AVG(r.ratingValue) as average
                                FROM menu AS m
                                LEFT JOIN rating AS r ON m.idMenu=r.idMenu
                                GROUP BY m.idMenu LIMIT $getLimit");
$statement->execute();
$fetch = $statement->fetchAll();
?>
<?php if (!empty($fetch)) : ?>
    <?php foreach ($fetch as $el) : ?>
        <?php if ($el->visibleMenu == true) : ?>
            <div class="col-lg-4 d-flex ftco-animate">
                <div class="services-wrap d-flex menuWrap">
                    <img class="img imgSrc" src="images/<?php echo $el->srcImgMenu.'.'.$el->extImgMenu ?>" alt="<?php echo $el->altImgMenu ?>" />
                    <div class="text p-4">
                        <h3><?php echo $el->nameMenu ?></h3>
                        <p><?php echo $el->descMenu ?></p>
                        <p class="price">
                        <p>Price: $<?php echo $el->priceMenu ?></p>
                        </p>
                        <p>
                            <span>Rating: </span>
                            <span class="rating"><?php echo number_format($el->average, 1); ?></span>
                        </p>
                        <?php if (!empty($_SESSION["user"])) : ?>
                            <p>
                                <span>Rate: </span>
                                <span class="rangeV">5</span>
                                <input type="hidden" class="idMenu" name="idMenu" value="<?php echo $el->idMenu ?>" />
                                <input type="range" min="0" max="5" value="5" class="range" />
                            </p>
                            <button class="rate btn btn-primary">Rate</button>
                            <p class="rateMessage"></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>