<?php
require_once "../config/connection.php";
$connection = getConnection();
//preparestatement
$statement = $connection->prepare("SELECT * FROM slider;");
$statement->execute();
$fetch = $statement->fetchAll();
?>
<?php if (!empty($fetch)) : ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a class="py-2 px-2 btn btn-primary" href="sliderCreate.php">Create new</a></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sub heading</th>
                            <th>Main heading</th>
                            <th>Post heading</th>
                            <th>Image source</th>
                            <th>Image description</th>
                            <th>Image preview</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Sub heading</th>
                            <th>Main heading</th>
                            <th>Post heading</th>
                            <th>Image source</th>
                            <th>Image description</th>
                            <th>Image preview</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($fetch as $el): ?>
                            <tr>
                                <td><?php echo $el->idSlider ?></td>
                                <td><?php echo $el->subHeading ?></td>
                                <td><?php echo $el->mainHeading ?></td>
                                <td><?php echo $el->postHeading ?></td>
                                <td><?php echo $el->srcImgSlider ?></td>
                                <td><?php echo $el->altImgSlider ?></td>
                                <td> 
                                    <?php if(!empty($el->srcImgSlider) && !empty($el->extImgSlider)): ?>
                                        <img src="../images/<?php echo $el->srcImgSlider.".".$el->extImgSlider ?>" alt="" border="3" height="100" width="100" />
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="sliderEdit.php?id=<?php echo $el->idSlider ?>" class="btn btn-primary my-2">Edit</a>
                                    <!-- empty($_GET['id']) -->
                                    <a href="sliderDelete.php?id=<?php echo $el->idSlider ?>" class="btn btn-danger my-2">Delete</a>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>