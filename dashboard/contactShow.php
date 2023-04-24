<?php
require_once "../config/connection.php";
$connection = getConnection();
//preparestatement
$statement = $connection->prepare(" SELECT * 
                                    FROM contact
                                    ORDER BY currentDatetimeContact DESC;");
$statement->execute();
$fetch = $statement->fetchAll();
?>
<?php if (!empty($fetch)): ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Receive date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Receive date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fetch as $el): ?>
                            <tr>
                                <td><?php echo $el->idContact   ?></td>
                                <td><?php echo $el->firstNameContact ?></td>
                                <td><?php echo $el->lastNameContact ?></td>
                                <td><?php echo $el->emailContact ?></td>
                                <td><?php echo $el->messageContact ?></td>
                                <td><?php echo $el->currentDatetimeContact ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <div class="d-flex justify-content-center my-color">
                    <p>
                        There is no messages.
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>