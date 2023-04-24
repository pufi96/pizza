<?php
require_once "../config/connection.php";
$connection = getConnection();
//preparestatement
$statement = $connection->prepare("SELECT * FROM social;");
$statement->execute();
$fetch = $statement->fetchAll();
?>
<?php if (!empty($fetch)) : ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a class="py-2 px-2 btn btn-primary" href="socialCreate.php">Create new</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Icon</th>
                            <th>Visible</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Link</th>
                            <th>Icon</th>
                            <th>Visible</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fetch as $el): ?>
                            <tr>
                                <td><?php echo $el->idSocial ?></td>
                                <td><?php echo $el->nameSocial ?></td>
                                <td><?php echo $el->hrefSocial ?></td>
                                <td><?php echo $el->iconSocial ?></td>
                                <td><?php echo $el->visibleSocial ? "Yes": "No" ?></td>
                                <td>
                                    <a href="socialEdit.php?id=<?php echo $el->idSocial ?>" class="btn btn-primary my-2">Edit</a>
                                    <a href="socialDelete.php?id=<?php echo $el->idSocial ?>" class="btn btn-danger my-2">Delete</a>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>