<?php
    require_once "config/connection.php";
    $connection = getConnection();
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM slider;");
    $statement->execute();
    $fetch = $statement->fetchAll();
?>
<?php if(!empty($fetch)):?>
    <section class="home-slider owl-carousel img backGround">
        <?php foreach($fetch as $el):?>       
            <div class="slider-item">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row slider-text" data-scrollax-parent="true">
                        <div class="col-md-6 col-sm-12 ftco-animate">
                            <span class="subheading"><?php echo $el->subHeading ?></span>
                            <h1 class="mb-4"><?php echo $el->mainHeading ?></h1>
                            <p class="mb-4 mb-md-5"><?php echo $el->postHeading ?></p>
                            <p>
                                <a href="book.php?id=4" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">Book Now</a>
                            </p>
                        </div>
                        <?php if($el->subHeading != "Welcome"): ?>
                            <div class="col-md-6 ftco-animate">
                                <img src="images/<?php echo $el->srcImgSlider.'.'.$el->extImgSlider ?>" class="img-fluid " alt="<?php echo $el->altImgSlider ?>">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php endif; ?>