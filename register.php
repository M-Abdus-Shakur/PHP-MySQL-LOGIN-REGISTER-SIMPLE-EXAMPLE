<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  session_start();
  require('_helper/_connection.php');

  $useremail = $_POST['useremail'];
  $password = $_POST['password'];
  $username = $_POST['username'];
  $hash = password_hash($password, PASSWORD_DEFAULT);
  if(!empty($useremail && $password)){
      $sql_useremail = "SELECT * FROM user WHERE useremail='$useremail'";
      $result_useremail = mysqli_query($con,$sql_useremail);
      if(mysqli_num_rows($result_useremail) > 0){
        echo 'Email Already Exist';
      }
      else{
        $sql = "INSERT INTO `user` (`useremail`, `username`, `password`, `dt`) VALUES ('$useremail', '$username', '$hash', current_timestamp())";
        $result = mysqli_query($con,$sql);
        $_SESSION['useremail'] = $useremail;
        $_SESSION['username'] = $username;
        $con->close();
        header("Location: welcome.php");
      }
  }
  else{
    echo 'Error On Registration';
  }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Registration Form</title>

  </head>
  <body>
      <?php require('_helper/_header.php'); ?>
        

      <div class="container">
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="username" maxlength="20" name="username" class="form-control" id="username" required>
            </div>
            <div class="mb-3">
                <label for="useremail" class="form-label">Email address</label>
                <input type="useremail" maxlength="50" name="useremail" class="form-control" id="useremail" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="50" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
      </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>