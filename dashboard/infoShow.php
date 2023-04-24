<?php
require_once "../config/connection.php";
$connection = getConnection();
//preparestatement
$statement = $connection->prepare("SELECT * FROM info;");
$statement->execute();
$fetch = $statement->fetchAll();
?>
<?php if (!empty($fetch)) : ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Info</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Info</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fetch as $el): ?>
                            <tr>
                                <td><?php echo $el->idInfo ?></td>
                                <td><?php echo $el->nameInfo ?></td>
                                <td><?php echo $el->textInfo ?></td>
                                <td><?php echo $el->descInfo ?></td>
                                <td><?php echo $el->iconInfo ?></td>
                                <td>
                                    <a href="infoEdit.php?id=<?php echo $el->idInfo ?>" class="btn btn-primary my-2">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>