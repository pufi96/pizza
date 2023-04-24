<?php 
    require_once "config/connection.php";
    $connection = getConnection();
    $user = $_SESSION["user"];
    //preparestatement
    $statement = $connection->prepare("SELECT * FROM users u WHERE u.idUser = $user->idUser LIMIT 1;");
    $statement->execute();
    $fetch = $statement->fetch();
?>
<form action="/pizza-gh/assets/fixed/userEditAction.php" method="POST">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="fName">First Name</label>
        <input name="fName" type="text" class="form-control" id="fName" value="<?php echo $fetch->firstName ?>" required/>
        <p></p>
      </div>
      <div class="form-group col-md-6">
        <label for="lName">Last Name</label>
        <input name="lName" type="text" class="form-control" id="lName" value="<?php echo $fetch->lastName ?>" required/>
        <p></p>
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="email">Email</label>
        <input name="email" type="email" class="form-control" id="email" value="<?php echo $fetch->email ?>" required/>
        <p></p>
      </div>
      <div class="form-group col-md-6">
        <label for="password">Change password</label>
        <input name="password" type="password" class="form-control" id="password" placeholder="ex. Pera123!" required/>
        <p></p>
      </div>
      <div class="form-group col-md-6">
        <label for="passwordConfirm">Confirm password</label>
        <input name="passwordConfirm" type="passwordConfirm" class="form-control" id="passwordConfirm" placeholder="ex. Pera123!" required/>
        <p></p>
      </div>
      <div class="form-group col-md-6">
        <label for="address">Address</label>
        <input name="address" type="text" class="form-control" id="address" value="<?php echo $fetch->address ?>" required/>
        <p></p>
      </div>
    </div>
    <div class="form-group col-12 text-center my-4">
      <button id="btnProfile" type="submit" class="btn btn-primary py-3 px-5">Change</button>
    </div>
  </form>