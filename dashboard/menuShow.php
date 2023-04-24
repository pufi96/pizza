<?php
require_once "../config/connection.php";
$connection = getConnection();
//preparestatement
$statement = $connection->prepare("SELECT * FROM menu;");
$statement->execute();
$fetch = $statement->fetchAll();
?>
<?php if (!empty($fetch)) : ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a class="btn btn-primary" href="menuCreate.php">Create new</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image source</th>
                            <th>Image description</th>
                            <th>Price</th>
                            <th>Visible</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Image source</th>
                            <th>Image description</th>
                            <th>Price</th>
                            <th>Visible</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fetch as $el): ?>
                            <tr>
                                <td><?php echo $el->idMenu ?></td>
                                <td><?php echo $el->nameMenu ?></td>
                                <td><?php echo $el->descMenu ?></td>
                                <td><?php echo $el->srcImgMenu ?></td>
                                <td><?php echo $el->altImgMenu ?></td>
                                <td><?php echo $el->priceMenu ?></td>
                                <td><?php echo $el->visibleMenu ? "Yes": "No" ?></td>
                                <td>
                                    <a href="menuEdit.php?id=<?php echo $el->idMenu ?>" class="btn btn-primary my-2">Edit</a>
                                    <a href="menuDelete.php?id=<?php echo $el->idMenu ?>" class="btn btn-danger my-2">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>