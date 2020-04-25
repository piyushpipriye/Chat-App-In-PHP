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
   <title>Change Profile Picture</title>
   <!--- Libraryies -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
.card{
	box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	max-width: 400px;
	margin: auto;
	text-align: center;
	font-family: arial;
}
.card img{
	height: 200px;
}
.title{
	color: grey;
	font-size: 18px;
}
button{
	border: none;
	outline: 0;
	display: inline-block;
	padding: 8px;
	color: white;
	background-color: #000;
	text-align: center;
	cursor: pointer;
	width: 100%;
	font-size: 18px;
}
#update_profile{
	position: absolute;
	cursor: pointer;
	padding: 10px;
	border-radius: 4px;
	color: white;
	background-color: #000;
}
label{
	padding: 7px;
	display: table;
	color: #fff;
}
input[type=file]{
	display: none;
}
</style>
<body>
	<?php
		$user = $_SESSION['user_email'];
		$get_user = "select * from users where user_email='$user'";
		$run_user = mysqli_query($con,$get_user);
		$row_user = mysqli_fetch_array($run_user);

		$user_name = $row_user['user_name'];
		$user_profile = $row_user['user_profile'];

		echo "
		<div class='card'>
			<img src='images/$user_profile'>
			<h1>$user_name</h1>
			<form method='post' enctype='multipart/form-data'>
				<label id='update_profile'><i class='fa fa-circle-o' aria-hidden='true'</i>
				Select Profile
				<input type='file' name='image' size='60'>
				</label>
				<button id='button_profile' name='update'>&nbsp&nbsp&nbsp<i class='fa fa-heart'
				aria-hidden='true'></i>Update Profile</button>
			</form>
		</div><br><br>";
		if (isset($_POST['update'])) {
			$image  = $_FILES['image']['name'];
			$profile =  "images/".basename($_FILES['image']['name']);
			move_uploaded_file($_FILES["image"]["tmp_name"],$profile);
			$update = "update users set user_profile='$image' where user_email='$user'";
			$run = mysqli_query($con,$update);
			if($run){
				echo"
					<div class='card alert alert-success'>
						<strong>Your Profile is Updated</strong>
					</div>
				";
			}
		}
	?>
</body>
</html>
<?php } ?>