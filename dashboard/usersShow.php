<?php
require_once "../config/connection.php";
$connection = getConnection();
//preparestatement
$statement = $connection->prepare(" SELECT * 
                                    FROM users AS u
                                    LEFT JOIN roles as r ON u.idRole=r.idRole
                                    ORDER BY u.idRole DESC;");
$statement->execute();
$fetch = $statement->fetchAll();
?>
<?php if (!empty($fetch)): ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a class="py-2 px-2 btn btn-primary" href="usersCreate.php">Create new</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fetch as $el): ?>
                            <tr>
                                <td><?php echo $el->idUser ?></td>
                                <td><?php echo $el->firstName ?></td>
                                <td><?php echo $el->lastName ?></td>
                                <td><?php echo $el->email  ?></td>
                                <td><?php echo $el->gender ?></td>
                                <td><?php echo $el->address ?></td>
                                <td><?php echo $el->nameRole ?></td>
                                <td><?php echo $el->status ? "Verified" : "Unverified " ?></td>
                                <td>
                                    <a href="usersEdit.php?id=<?php echo $el->idUser ?>" class="btn btn-primary my-2">Edit</a>
                                    <!-- empty($_GET['id']) -->
                                    <a href="usersDelete.php?id=<?php echo $el->idUser ?>" class="btn btn-danger my-2">Delete</a>
                                </td>
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
                        There is no users.
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>