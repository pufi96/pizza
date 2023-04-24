<?php
    require_once "config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT `id_rating`, `idMenu`, `id_user`, (SUM(`ratingValue`))/(COUNT(`id_user`)) AS `avg` 
                                    FROM `rating`
                                    GROUP BY `id_rating`,`id_user`, `ratingValue`;");
    $statement->execute();
    $fetch = $statement->fetchAll();
?>
<?php foreach($fetch as $rating): ?>
    <?php if(true): ?>
        <form action="/pizza-gh/assets/fixed/loginAction.php" method="post">                                
            <p>
                <input type="range" min="0" max="5" value="5" id="range"/>
            </p>
            <?php  if($_SESSION["user"]) ?>
            
            <button type="submit" class="btn btn-primary">Rate</button>
        </form>
    <?php endif; ?>
<?php endforeach; ?>