<?php 
    $homeSlider = [
        ["loc"=>"contact.php?id=5", "name"=>"Contact", "desc"=>"Contact Us"],
        ["loc"=>"book.php", "name"=>"Book", "desc"=>"Book your table now"], 
        ["loc"=>"login.php", "name"=>"Sign in", "desc"=>"Welcome back"],
        ["loc"=>"register.php", "name"=>"Sign up", "desc"=>"Become our member"],
        ["loc"=>"profile.php", "name"=>"Profile", "desc"=>"Profile page"],
        ["loc"=>"order.php", "name"=>"Order", "desc"=>"Order what you want to eat at home"]
      ];
    $url= $_SERVER['REQUEST_URI'];
    $urlFull = explode("/",$url);
    $location = end($urlFull);
?>
    <?php foreach($homeSlider as $el): ?>
        <?php if (strpos($location, $el["loc"]) !== false): ?>
            <section class="home-slider owl-carousel img backGround mb-5">  
                <div class="slider-item">
                    <div class="overlay"></div>
                    <div class="container">
                    <div class="row slider-text justify-content-center align-items-center">
                        <div class="col-md-7 col-sm-12 text-center ftco-animate">
                            <h1 class="mb-3 mt-5 bread"><?php echo $el["desc"] ?></h1>
                        <p class="breadcrumbs">
                            <span class="mr-2">
                            <a href="index.php?id=1">Home</a>
                            </span>
                            <span><?php echo $el["name"] ?></span>
                        </p>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endforeach; ?>