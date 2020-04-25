<!DOCTYPE html>
<?php
include("include/connection.php");
?>
<html>
<head>
   <title>Forgot Password</title>
   <link href="css/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

.input-container {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}

.icon {
  padding: 10px;
  background: red   ;
  color: white;
  min-width: 50px;
  text-align: center;
}

.input-field {
  width: 100%;
  padding: 10px;
  outline: none;
}

.input-field:focus {
  border: 2px solid red   ;
}

/* Set a style for the submit button */
.btn {
  background-color: red;
  color: white;
  padding: 15px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>
</head>
<body>

<form action="" style="max-width:500px;margin:auto;margin-top:100px" method="post"> 
  <h2 align="center">Recover your Password</h2>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="email" placeholder="Enter your email" name="usrnm" required>
  </div>
  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="text" placeholder="Enter your best friend name" name="frnd" required>
  </div>

  <button type="submit" class="btn" name="submit">Submit</button>

  <div class="input-container">
  <br>  Back to login <a href="index.php" style="padding-left:35px"><br>Click here</a>
  </div>
  <?php 

if (isset($_POST['submit'])) {
  global $con;
  $name = htmlentities(mysqli_real_escape_string($con,$_POST['usrnm']));
  $frnd = htmlentities(mysqli_real_escape_string($con,$_POST['frnd']));

  $select = "select * from users where user_email='$name' AND forgotten_answer='$frnd'";
  $exec = mysqli_query($con,$select);
  $cnt = mysqli_num_rows($exec);
  $row=mysqli_fetch_array($exec);
  $pass = $row['user_pass'];

  if ($cnt==1) {
    echo"
              <div class='alert alert-success'>
                <strong>Your Password is $pass</strong>
              </div>
            ";
  }
  else{
    echo"
              <div class='alert alert-danger'>
                <strong>Something Went Wrong</strong>
              </div>
            ";
  }
}
?>
</form>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
</html>