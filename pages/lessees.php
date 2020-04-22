<!DOCTYPE html>
<html>
<head>
	<title>Lessees</title>
	<?php
		include '../elements/meta.php';
		include '../actions/dbconn.php';
		include '../actions/process.php';
		$sql = "SELECT * FROM users WHERE type ='lessee'";
		$result = $conn->query($sql);
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
		<?php 

		if(isset($_SESSION['message'])): ?>

		<div class="alert alert-<?=$_SESSION['msg_type']?>">
			<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>
		<?php endif; ?>
			<table class="table table-bordered" style="margin-top: 20px;">
			  <thead>
			    <tr>
			      <th scope="col">First Name</th>
			      <th scope="col">Last Name</th>
			      <th scope="col">Username</th>
			      <th scope="col">Status</th>
			      <th scope="col">Created</th>
			      <th></th>
			    </tr>
			  </thead>
			  <?php  
			  	 while($row = $result->fetch_assoc()): ?>
			  	 	<tr>
			  	 		<td><?php echo $row['fname']; ?></td>
			  	 		<td><?php echo $row['lname']; ?></td>
			  	 		<td><?php echo $row['username']; ?></td>
			  	 		<td><?php echo $row['status']?></td>
			  	 		<td><?php echo $row['created']?></td>
			  	 		<td>
			  	 			<a href="../pages/update_lessee.php?edit_user=<?php echo $row['user_id']; ?>"
			  	 				class="btn btn-info">Edit</a>
			  	 			<a href="../actions/process.php?delete_user=<?php echo $row['user_id']; ?>"
			  	 				class="btn btn-danger">Delete</a>
			  	 		</td>
			  	 	</tr>
			  <?php endwhile; ?>
			</table>
	</div>
</body>
</html>