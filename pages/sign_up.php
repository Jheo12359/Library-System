<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<?php 
		include '../elements/meta.php';
		include '../actions/dbconn.php';
		include '../actions/process.php';
	?>
	<script type="text/javascript">
	    setTimeout(function () {
                $('.alert').hide('fade');
            }, 3000);
	</script>
</head>
<body>
	<div class="wrapper">
		<div class="container-fluid">
			<h1 class="sign-up-header">Sign Up</h1>
			<form action="../actions/process.php" method="post">
			  <div class="form-group">
			  	<input type="hidden" name="user_type" value="lessee">
			    <label>First name</label>
			    <input type="text" class="form-control" name="fname" placeholder="Your first name">
			  </div>
			  <div class="form-group">
			    <label>Last name</label>
			    <input type="text" class="form-control" name="lname" placeholder="Your last name">
			  </div>
			  <div class="form-group">
			    <label>Username</label>
			    <input type="text" class="form-control" name="username" placeholder="Username">
			  </div>
			  <div class="form-group">
			    <label>Password</label>
			    <input type="password" class="form-control" name="password" placeholder="Password">
			  </div>
			  <div class="form-group">
			    <label>Confirm password</label>
			    <input type="password" class="form-control" name="confirm_pass" placeholder="Confirm Password">
			  </div>
			  <button id="sign_up_button" type="submit" class="btn btn-primary" name="add_user">Submit</button>
			  <a href="login.php" class="sign_up_login_button">Login</a>
			  <?php 

				if(isset($_SESSION['message'])): ?>

				<div class="alert alert-<?=$_SESSION['msg_type']?>">
					<?php
						echo $_SESSION['message'];
						unset($_SESSION['message']);
					?>
				</div>
				<?php endif; ?>

			</form>
		</div>
	</div>
</body>
</html>