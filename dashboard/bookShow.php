<?php
require_once "../config/connection.php";
$connection = getConnection();
//preparestatement
$statement = $connection->prepare(" SELECT * 
                                    FROM book
                                    ORDER BY currentDatetimeBook DESC;");
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
                            <th>Mobile number</th>
                            <th>Email</th>
                            <th>Booked for</th>
                            <th>Booked time</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Mobile number</th>
                            <th>Email</th>
                            <th>Booked for</th>
                            <th>Booked time</th>
                            <th>Message</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fetch as $el): ?>
                            <tr>
                                <td><?php echo $el->idBook  ?></td>
                                <td><?php echo $el->firstNameBook ?></td>
                                <td><?php echo $el->lastNameBook ?></td>
                                <td><?php echo $el->numberBook ?></td>
                                <td><?php echo $el->emailBook ?></td>
                                <td><?php echo $el->bookedDatetimeBook ?></td>
                                <td><?php echo $el->currentDatetimeBook ?></td>
                                <td><?php echo $el->messageBook ?></td>
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