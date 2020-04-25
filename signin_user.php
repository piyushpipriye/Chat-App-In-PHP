<?php require_once("include/session.php"); ?>
<?php
include("include/connection.php");
if(isset($_POST['login'])){
	global $con;
	$email = htmlentities(mysqli_real_escape_string($con,$_POST['usrnm']));
	$pass = htmlentities(mysqli_real_escape_string($con,$_POST['psw']));

	$select = "select * from users where user_email='$email' AND user_pass='$pass'";
	$exec = mysqli_query($con,$select);
	$cnt = mysqli_num_rows($exec);

	if ($cnt==1) {
		$_SESSION['user_email'] = $email;
		$update = mysqli_query($con, "UPDATE users SET log_in='Online' WHERE user_email='$email'");
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row=mysqli_fetch_array($run_user);
		$user_name = $row['user_name'];
		echo "<script>window.open('home.php?user_name=$user_name','_self')</script>";
	}
	else{
		$_SESSION["ErrorMessage"] = "Check your email and password..";
		echo "<script>window.open('index.php','_self')</script>";
	}
}
?>