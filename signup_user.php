<?php require_once("include/session.php"); ?>
<?php
include("include/connection.php");
if(isset($_POST['register'])){
	global $con;
	$name = htmlentities(mysqli_real_escape_string($con,$_POST['usrnm']));
	$email = htmlentities(mysqli_real_escape_string($con,$_POST['email']));
	$pass = htmlentities(mysqli_real_escape_string($con,$_POST['psw']));
	$country = htmlentities(mysqli_real_escape_string($con,$_POST['country']));
	$gender = htmlentities(mysqli_real_escape_string($con,$_POST['gender']));
	$image  = $_FILES['pic']['name'];
	$profile =  "images/".basename($_FILES['pic']['name']);
	if (strlen($pass)<8) {
		$_SESSION["ErrorMessage"] = "Password should contain minimum 8 characters";
		echo "<script>window.open('signup.php','_self')</script>";
		exit();
	}
	$chk_email = "select * from users where user_email='$email'";
	$run = mysqli_query($con,$chk_email);
	$chk = mysqli_num_rows($run);
	if($chk==1){
		$_SESSION["ErrorMessage"] = "Email already exist, please try again'";
		echo "<script>window.open('signup.php','_self')</script>";
		exit();
	}
	else{
		$insert = "insert into users (user_name,user_pass,user_email,user_profile,user_country,user_gender)
		values('$name','$pass','$email','$image','$country','$gender')";
		$query = mysqli_query($con,$insert);
		move_uploaded_file($_FILES["pic"]["tmp_name"],$profile);
		if($query){
			echo "<script>window.open('index.php','_self')</script>";
			$_SESSION["SuccessMessage"] = "Congratulations $name, your account has been created successfully";
		}
		else{
			$_SESSION["ErrorMessage"] = "Registration failed";
			echo "<script>window.open('signup.php','_self')</script>";
		}
	}
}
?>