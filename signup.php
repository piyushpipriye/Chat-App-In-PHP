<?php require_once("include/session.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Sign Up</title>
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
  background: dodgerblue;
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
  border: 2px solid dodgerblue;
}

/* Set a style for the submit button */
.btn {
  background-color: dodgerblue;
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
<form action="" style="max-width:500px;margin:auto;margin-top:100px;" method="post" enctype="multipart/form-data">
  <h2 align="center">Register Form</h2>
  <div> <?php echo Message(); 
      echo SuccessMessage();?> </div>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="text" placeholder="Username" name="usrnm" required>
  </div>

  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="psw" required>
  </div>
  
  <div class="input-container">
    <i class="fa fa-envelope icon"></i>
    <input class="input-field" type="text" placeholder="Email" name="email" required>
  </div>

 <div class="input-container">
   <i class="fa fa-image icon"></i>
    <input class="input-field" type="file" name="pic" required>
  </div>

  <div class="input-container">
    <i class="fa fa-list icon"></i>
    <select class="input-field" name="country">
      <option value="India">India</option>
      <option value="U.S.A.">U.S.A.</option>
      <option value="Japan">Japan</option>
    </select>
  </div>

   <div class="input-container">
    <i class="fa fa-chevron-down icon"></i>
    <select class="input-field"  name="gender">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
  </div>

  <button type="submit" class="btn" name="register">Register</button>

  <div class="input-container">
  <br>  Already an Account <a href="index.php" style="padding-left:35px"><br>SignIn</a>
  </div>
  <?php include("signup_user.php"); ?>
</form>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
</html>
