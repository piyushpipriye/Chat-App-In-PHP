<?php require_once("include/session.php"); ?>
<!DOCTYPE html> 
<?php
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
<body>
	<div class="row">
		<div class="col-sm-2">
		</div>
		<?php 
			$user = $_SESSION['user_email'];
			$get_user = "select * from users where user_email='$user'";
			$run_user = mysqli_query($con,$get_user);
			$row_user = mysqli_fetch_array($run_user);

			$user_id = $row_user['user_id'];
			$user_name = $row_user['user_name'];
			$user_pass = $row_user['user_pass'];
			$user_email = $row_user['user_email'];
			$user_country = $row_user['user_country'];
			$user_gender = $row_user['user_gender'];
			$user_profile = $row_user['user_profile'];
		?>
		<div class="col-sm-8">
			<form action="" method="post" enctype="multipart/form-data">
				<table class="table table-bordered table-hover">
					<tr align="center">
						<td colspan="6" class="active"><h2>Change Account Settings</h2></td>
						<?php echo Message(); 
     						echo SuccessMessage();?>
					</tr>
					<tr>
						<td style="font-weight: bold;">Change Your Username</td>
						<td>
							<input value="<?php echo$user_name; ?>" type="text" name="username" class="form-control" required>
						</td> 
					</tr>
					<tr><td></td><td><a class="btn btn-default" style="text-decoration: none; font-size:
						15px;" href="upload.php"><i class="fa fa-user" aria-hidden="true"></i>Change Profile</a></td>
					</tr>
					<tr>
						<td style="font-weight: bold;">Change Your Email</td>
						<td>
							<input type="email" name="email" class="form-control" value="
							<?php echo$user_email; ?>" required>
						</td> 
					</tr>
					<tr>
						<td style="font-weight: bold">Country</td>
						<td>
							<select class="form-control" name="country">
								<option><?php echo $user_country; ?></option>
								<option>U.S.A.</option>
								<option>U.K</option>
								<option>Japan</option>
								<option>France</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold">Gender</td>
						<td>
							<select class="form-control" name="gender">
								<option><?php echo $user_gender; ?></option>
								<option>Male</option>
								<option>Female</option>
								<option>Others</option>
							</select>
						</td>
					</tr>
					<tr>
						<td style="font-weight: bold">Forgotten Password</td>
						<td>
							<button type="button" class="btn btn-default" data-toggle="modal"
							data-target="#myModal">Forgotten Password</button>
							<div id="myModal" class="modal fade" role="dialog">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">
												&times;</button>
										</div> 
										<div clas="modal-body">
											<form action="recovery.php?id=<?php echo $user_id; ?>" method="post" id="f">
 												<strong>What is your school best friend Name?</strong>
 												<textarea class="form-control" cols="83" rows="4" name="content"
 												placeholder="Someone"></textarea>
 												<input class="btn btn-default" name="sub" type="submit" style="width: 100px;"><br><br>
 												<pre>Answer the above question we will ask you this question if you forgot ypur <br>Password.</pre><br><br>
											</form>
											<?php
												if (isset($_POST['sub'])) {
												 	$bfn = htmlentities($_POST['content']);
												 	if($bfn == ''){
												 		$_SESSION["ErrorMessage"] = "Please Enter Something...";
														echo "<script>window.open('account_setting.php','_self')</script>";
														exit();
												 	}
												 	else{
												 		$update = "update users set forgotten_answer='$bfn' where user_email='$user'";
												 		$run = mysqli_query($con,$update);
												 		if($run){
												 			$_SESSION["SuccessMessage"] = "Updated Successfully...";
															echo "<script>window.open('account_setting.php','_self')</script>";
												 		}
												 		else{
												 			$_SESSION["ErrorMessage"] = "Error while updating...";
															echo "<script>window.open('account_setting.php','_self')</script>";
												 		}
												 	}
												 } 
											?>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										</div>
									</div>
								</div>
							</div>
						</td>	
					</tr>
					<tr>
						<td></td><td><a class="btn btn-default" href="change_pass.php" style="text-decoration: none; font-size: 15px;"><i class="fa fa-key fa-fw" aria-hidden="true"></i>Change Password</a></td>
					</tr>	
					<tr align="center">
						<td colspan="6">
							<input type="submit" value="Update" name="update" class="btn btn-info">
						</td>
					</tr>	
				</table>
			</form>
			<?php
				if (isset($_POST['update'])) {
				 	$name = htmlentities($_POST['username']);
				 	$email = htmlentities($_POST['email']);
				 	$country = htmlentities($_POST['country']);
				 	$gender = htmlentities($_POST['gender']);
				 	$update = "update users set user_name='$name', user_email='$email',
				 	user_country='$country', user_gender='$gender' where user_email='$user'";
					$run = mysqli_query($con,$update);
					if ($run) {
						$_SESSION["SuccessMessage"] = "Setting Updated";
						echo "<script>window.open('account_setting.php','_self')</script>";
					}
					else{
						$_SESSION["ErrorMessage"] = "Something Went Wrong...";
						echo "<script>window.open('account_setting.php','_self')</script>";
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