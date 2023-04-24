<?php
require_once "../config/connection.php";
$connection = getConnection();
//preparestatement
$statement = $connection->prepare("SELECT * FROM nav;");
$statement->execute();
$fetch = $statement->fetchAll();
?>
<?php if (!empty($fetch)) : ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a class="btn btn-primary" href="navCreate.php">Create new</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Visible</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Visible</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fetch as $el): ?>
                            <tr>
                                <td><?php echo $el->idNav ?></td>
                                <td><?php echo $el->nameNav ?></td>
                                <td><?php echo $el->hrefNav ?></td>
                                <td><?php echo $el->visibleNav == "1" ? "Yes": "No" ?></td>
                                <td>
                                    <a href="navEdit.php?id=<?php echo $el->idNav ?>" class="btn btn-primary my-2">Edit</a>
                                    <a href="navDelete.php?id=<?php echo $el->idNav ?>" class="btn btn-danger my-2">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>