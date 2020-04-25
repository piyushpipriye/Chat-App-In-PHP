<!DOCTYPE html> 
<?php
session_start();
include("include/connection.php");
if (!isset($_SESSION['user_email'])) {
	header("location: index.php");
}
else{
?>
<html>
<head>
   <title>Chat App</title>
   <!--- Libraryies -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link href="css/home.css" rel="stylesheet">
</head>
<body>
	<div class="container main-section">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12 left-sidebar">
				<div class="input-group searchbox">
					<div class="input-group-btn">
						<center><a href="include/find_friends.php"><button class="btn btn-default 
							search-icon" name="search_user"	type="submit">Add New User</button></a></center>
					</div>
				</div>
				<div class="left-chat">
					<ul>
						<?php include("include/get_users_data.php"); ?>
					</ul>
				</div>
			</div>
			<div class="col-md-9 col-sm-9 col-xs-12 right-sidebar">
				<div class="row">
				<?php 
					$user = $_SESSION['user_email'];
					$get_user = "select * from users where user_email='$user'";
					$run_user = mysqli_query($con,$get_user);
					$row=mysqli_fetch_array($run_user);

					$user_id = $row['user_id'];
					$user_name = $row['user_name'];
					$mail = $row['user_email'];
				?>
				<!-- getting user data -->
				<?php
					if(isset($_GET['user_name'])){
						global $con;
						$get_username = $_GET['user_name'];
						$get_user = "select * from users where user_name='$get_username'";
						$run_user = mysqli_query($con,$get_user);
						$row_user=mysqli_fetch_array($run_user);
						$username = $row_user['user_name'];
						$userprofile = $row_user['user_profile'];
					}
					$total_msg = "select * from userchat where (sender_name='$user_name' AND receiver_name='$username')
					OR (receiver_name='$user_name' AND sender_name='$username')";
					$run_msg = mysqli_query($con,$total_msg);
					$total = mysqli_num_rows($run_msg);
				?>
				<div class="col-md-12 right-header">
					<div class="right-header-img">
						<?php echo "<img src='images/$userprofile'>"; ?> 
					</div>
					<div class="right-header-detail">
						<form method="post">
							<p><?php echo $username; ?></p>
							<span><?php echo $total; ?> messages</span>&nbsp &nbsp
								<button name='logout' class='btn btn-danger'>Logout</button>
						</form>
						<?php
							if(isset($_POST['logout'])){
								$update = mysqli_query($con, "UPDATE users SET log_in='Offline' WHERE user_name='$username'");
								header("Location:logout.php");
								exit();
							} 
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div id="scrolling_to_bottom" class="col-md-12 right-header-contentChat">
					<?php
						$update_msg = mysqli_query($con, "UPDATE userchat SET msg_status='read'
						 WHERE sender_name='$username' AND receiver_name='$user_name'");
						$sel_msg = "select * from userchat where (sender_name='$user_name'
							AND receiver_name='$username') OR (receiver_name='$user_name'
							AND sender_name='$username') ORDER by 1 ASC";
						$run_msg = mysqli_query($con,$sel_msg);
						while ($row = mysqli_fetch_array($run_msg)) {
							$sender_username = $row['sender_name'];
							$receiver_username = $row['receiver_name'];
							$msg_content = $row['msg_content'];
							$msg_date = $row['msg_date'];
					?>
					<ul>
						<?php
							if($user_name==$sender_username AND $username==$receiver_username){
								echo "
									<li>
										<div class='rightside-right-chat'>
											<span>$user_name <small>$msg_date</small></span><br><br>
											<p>$msg_content</p>
										</div>
									</li>
								";
							}

							else if($user_name==$receiver_username AND $username==$sender_username){
								echo "
									<li>
										<div class='rightside-left-chat'>
											<span>$username <small>$msg_date</small></span><br><br>
											<p>$msg_content</p>
										</div>
									</li>
								";
							}
						?>
					</ul>
					<?php } ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 right-chat-textbox">
					<form method="post">
						<input autocomplete="off" type="text" name="msg_content" placeholder="Write your message..." >
						<button class="btn" name="submit"><i class="fa fa-telegram" aria-hidden="true"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	<?php 
		if (isset($_POST['submit'])) {
			$msg = htmlentities($_POST['msg_content']);

			if($msg==''){
				echo "<div class='alert alert-danger'>
						<strong><center>Message was unable to send</center></strong>
					</div>";
			}
			else if (strlen($msg)>100) {
				echo "
					<div class='alert alert-danger'>
						<strong><center>Message is too long. Use only 100 characters</center></strong>
					</div>
				";
			}
			else{
				$insert = "insert into userchat (sender_name,receiver_name,msg_content,msg_status,msg_date)
				values('$user_name','$username','$msg','unread',NOW())";
				$run_insert = mysqli_query($con,$insert);
			}
		}
	?>
	<script type="text/javascript">
		$('#scrolling_to_bottom').animate({
			scrollTop: $('#scrolling_to_bottom').get(0)scrollHeight}, 1000;
		})
	</script>
	<script>
		$(document).ready(function()){
			var height = $(window).height();
			$('.left-chat').css('height', (height - 92) + 'px');
			$('.right-header-contentChat').css('height', (height - 163) + 'px');
		});
	</script>

</body>
</html>
<?php } ?> 