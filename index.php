<?php require_once("include/session.php"); ?>
<!DOCTYPE html>
<html>
<head>
   <title>Login</title>
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
  background: #00bd00   ;
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
  border: 2px solid #00bd00   ;
}

/* Set a style for the submit button */
.btn {
  background-color: #00bd00;
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
  <h2 align="center">Login Form</h2>
   <div> <?php echo Message(); 
      echo SuccessMessage();?> </div>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
    <input class="input-field" type="email" placeholder="Email Address" name="usrnm" required>
  </div>
  
  <div class="input-container">
    <i class="fa fa-key icon"></i>
    <input class="input-field" type="password" placeholder="Password" name="psw" required>
  </div>

   <div class="input-container">
     Forgot Password ?  <a href="forgot.php" style="padding-left:35px"> Click Here</a>
  </div>

  <button type="submit" class="btn" name="login">Login</button>

  <div class="input-container">
  <br>  Create an Account? <a href="signup.php" style="padding-left:35px"><br>SignUp</a>
  </div>
  <?php include("signin_user.php"); ?>
</form>
</body>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.min.js"></script>
</html>
