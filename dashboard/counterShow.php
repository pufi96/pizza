<?php
require_once "../config/connection.php";
$connection = getConnection();
//preparestatement
$statement = $connection->prepare("SELECT * FROM counter;");
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
                            <th>Number</th>
                            <th>Icon </th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Number</th>
                            <th>Icon </th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fetch as $el): ?>
                            <tr>
                                <td><?php echo $el->idCounter ?></td>
                                <td><?php echo $el->nameCounter  ?></td>
                                <td><?php echo $el->numberCounter ?></td>
                                <td><?php echo $el->iconCounter ?></td>
                                <td>
                                    <a href="counterEdit.php?id=<?php echo $el->idCounter ?>" class="btn btn-primary my-2">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>