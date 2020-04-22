<!DOCTYPE html>
<html>
<head>
	<title>Update Lessee</title>
	<?php 
		include '../elements/meta.php';
		include '../actions/dbconn.php';
		include '../actions/process.php';

		if(isset($_SESSION['user_id']) || isset($_SESSION['fname']) || isset($_SESSION['lname']) || isset($_SESSION['username'])) {
			$user_id = $_SESSION['user_id'];
			$fname = $_SESSION['fname'];
			$lname = $_SESSION['lname'];
			$username = $_SESSION['username'];
		}
	?>
	<script type="text/javascript">
	    setTimeout(function () {
                $('.alert').hide('fade');
            }, 3000);
	</script>
</head>
<body>
	<div class="container">
		<?php include '../elements/header.php'; ?>
		<div class="wrapper">
			<h1 class="sign-up-header">Update Lessee</h1>
			<form action="../actions/process.php" method="post">
				<?php 

				if(isset($_SESSION['message'])): ?>

					<div class="alert alert-<?=$_SESSION['msg_type']?>">
					<?php
					  echo $_SESSION['message'];
					  unset($_SESSION['message']);
					?>
					</div>
				<?php endif; ?>
			  <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			  <div class="form-group">
			  	<input type="hidden" name="user_type" value="lessee">
			    <label>First name</label>
			    <input type="text" class="form-control" name="fname" value="<?php echo $fname; ?>">
			  </div>
			  <div class="form-group">
			    <label>Last name</label>
			    <input type="text" class="form-control" name="lname" value="<?php echo $lname; ?>">
			  </div>
			  <div class="form-group">
			    <label>Username</label>
			    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
			  </div>
			  <div class="form-group">
			    <label>New Password</label>
			    <input type="password" class="form-control" name="new_password" placeholder="New Password">
			  </div>
			  <div class="form-group">
			    <label>Confirm password</label>
			    <input type="password" class="form-control" name="confirm_pass" placeholder="Confirm Password">
			  </div>
			  <button type="submit" class="btn btn-primary" name="update_user">Submit</button>
			  <?php 
		  			if ($status == 'inactive'):
		  		?>
		  			<button type="submit" class="btn btn-success" name="activate_user" style="float: right;" value="<?php echo $user_id; ?>">Activate</button>
		  		<?php else: ?>
		  			<button type="submit" class="btn btn-danger" name="deactivate_user" style="float: right;" value="<?php echo $user_id; ?>">Deactivate</button>
		  	  <?php endif; ?>

			</form>
		</div>
	</div>
</body>
</html>