
<?php if(!empty($_SESSION["message"])): ?>
    <?php if($_SESSION["message"]["success"]): ?>
        <div class="alert alert-success" role="alert">
            <p>
                <?php echo $_SESSION["message"]["message"] ?>
            </p>
        </div>
    <?php else: ?>
        <div class="alert alert-danger" role="alert">
            <p>
                <?php echo $_SESSION["message"]["message"]; ?>
                <?php if(!empty($_SESSION["message"]["errors"])): ?>
                    <?php foreach($_SESSION["message"]["errors"] as $error): ?>
                        <p>
                            <?php echo $error; ?>
                        </p>
                    <?php endforeach; ?>
                <?php endif; ?>
            </p>
        </div>
    <?php endif ?>
<?php endif ?>
<?php unset($_SESSION["message"]); ?>