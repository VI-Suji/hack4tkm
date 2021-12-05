<?php
session_start();
include('includes/config.php');
if(isset($_POST['login']))
{
$cons=$_POST['cons'];
$sql ="SELECT name,cons FROM `user` WHERE cons=:cons";
$query= $dbh -> prepare($sql);
$query-> bindParam(':cons', $cons, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
$_SESSION['alogin']=$results[0]->name;
$_SESSION['cons']=$results[0]->cons;
echo "<script type='text/javascript'> alert('OTP sent succesfully') </script>";
echo "<script type='text/javascript'> document.location = 'otp.php'; </script>";
} else{
  
  echo "<script>alert('Invalid Details');</script>";

}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome</title>
  <link rel = "icon" type = "image/png" href = "dist/img/user2-160x160.jpg"> 

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    ZING Welcomes You
    <img width="250px" src="dist/img/user2-160x160.png">
  </div>

  <!-- User name -->
  <div class="lockscreen-name">Enter the Consumer ID</div><br>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="dist/img/admin.jpg" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" method="POST">
      <div class="input-group">
        <input type="text" name="cons" class="form-control" placeholder="Consumer Number">

        <div class="input-group-append">
          <button name="login" type="submit" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
      
    </form>
    
    <!-- /.lockscreen credentials -->

  </div>
  
</div>
<!-- /.center -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
