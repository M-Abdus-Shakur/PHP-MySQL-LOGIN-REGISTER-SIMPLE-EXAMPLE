<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  session_start();
  require('_helper/_connection.php');


  $useremail = $_POST['useremail'];
  $password = $_POST['password'];
  if(!empty($useremail && $password)){
    $sql = "Select * from user where useremail='$useremail'";
    $result = mysqli_query($con,$sql);
    $rescount = mysqli_num_rows($result);
    if($rescount == 1)
    {   
      $checkpass = mysqli_fetch_assoc($result);
        if(password_verify($password,$checkpass['password'])){
          $_SESSION['useremail'] = $useremail;
          $_SESSION['username'] = $username;
          header("Location: welcome.php");
        }
        else{
          echo "Password Not Matching";
        }
    }
    else{
        echo "Email Not Found";
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
    <title>Login Form</title>

  </head>
  <body>
      <?php require('_helper/_header.php'); ?>

      <div class="container">
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="useremail" class="form-label">Email address</label>
                <input type="useremail" maxlength="50" name="useremail" class="form-control" id="useremail" required> 
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" maxlength="50" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>