<!DOCTYPE html> 
<?php
session_start();
include("include/connection.php");
include("include/header.php");
if (!isset($_SESSION['user_email'])) {
	header("location: index.php");
}
else{
?>
<html>
<head>
   <title>Account Setting</title>
   <!--- Libraryies -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
body{
	overflow-x: hidden;
}
</style>
<body>
	<div class="row">
		<div class="col-sm-2">
		</div>
		<div class="col-sm-8">
			<form action="" method="post">
				<table class="table table-bordered table-hover">
					<tr align="center">
						<td colspan="6" class="active"><h2>Change Password</h2></td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Current Password</td>
						<td>
							<input type="password" name="oldpsw" class="form-control" placeholder="Current Password" required>
						</td> 
					</tr>
					<tr>
						<td style="font-weight: bold;">New Password</td>
						<td>
							<input type="password" name="new" class="form-control" placeholder="New Password" required>
						</td> 
					</tr>
					<tr>
						<td style="font-weight: bold;">Confirm Password</td>
						<td>
							<input type="password" name="con" class="form-control" placeholder="Confirm Password" required>
						</td> 
					</tr>	
					<tr align="center">
						<td colspan="6">
							<input type="submit" value="Change" name="change" class="btn btn-info">
						</td>
					</tr>	
				</table>
			</form>
			<?php
				if (isset($_POST['change'])) {
					global $con;
				 	$old = htmlentities($_POST['oldpsw']);
				 	$new = htmlentities($_POST['new']);
				 	$conf = htmlentities($_POST['con']);

				 	$user = $_SESSION['user_email'];
					$get_user = "select * from users where user_email='$user'";
					$run_user = $con->query($get_user);
					$row_user = mysqli_fetch_array($run_user);
					$user_pass = $row_user['user_pass'];

					if($old !== $user_pass){
						echo"
							<div class='alert alert-danger'>
								<strong>Your Old password didn't match</strong>
							</div>
						";
					}
					if(strlen($new) < 8 AND strlen($conf) < 8){
						echo"
							<div class='alert alert-danger'>
								<strong>Use 8 or more than 8 characters </strong>
							</div>
						";
					}
					if($new !== $conf){
						echo"
							<div class='alert alert-danger'>
								<strong>Your New password didn't match with confirm password</strong>
							</div>
						";
					}
					else{
						$update = "update users set user_pass='$new' where user_email='$user'";
						$run = mysqli_query($con,$update);
						echo"
							<div class='alert alert-success'>
								<strong>Your Password is changed</strong>
							</div>
						";
					}
				}
			?>
		</div>
		<div class="col-sm-2">

		</div>
	</div>
</body>
</html>
<?php } ?> 