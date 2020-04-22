<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
	<div class="login-container">
		<div class="wrapper">
			<?php 

			if(isset($_SESSION['message'])): ?>

			<div class="alert alert-<?=$_SESSION['msg_type']?>">
				<?php
					echo $_SESSION['message'];
					unset($_SESSION['message']);
				?>
			</div>
			<?php endif; ?>
			<div class="container-fluid">
				<h1>Library System</h1>
				<form action="../actions/process.php" method="post">
					<h1>Login</h1>
					<div class="form-group col">
						<input type="text" class="form-control" id="logininput" name="username" placeholder="Username">
					</div>
					<div class="form-group col">
						<input type="password" class="form-control" id="logininput" name="password" placeholder="Password">
					</div>
					<button id="login_submitbtn" type="submit" class="btn btn-primary" name="loginbtn">Submit</button>
					<a href="sign_up.php" class="sign_up_login_button" style="float: right;">Sign Up</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>