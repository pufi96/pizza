<?php
require_once "config/connection.php";
$connection = getConnection();
$statement = $connection->query(" SELECT COUNT(*)
                                    FROM menu");
$statement->execute();
$fetchCount = $statement->fetchColumn();
$numberOfPages = (int) ceil($fetchCount/6);
?>
<div class="m-2">
    <ul class="pagination">
        <?php for($i = 1; $i <= $numberOfPages; $i++): ?>
            <li class="paginate_button page-item active">
                <button aria-controls="dataTable" data-user="<?php echo !empty($_SESSION["user"]) ? true : false ?>" data-dt-idx="<?php echo $i ?>" tabindex="0" class="page-link my-color"><?php echo $i ?></button>
            </li>
        <?php endfor; ?>
    </ul>
</div>