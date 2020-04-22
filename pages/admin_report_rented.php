<!DOCTYPE html>
<html>
<head>
	<title>Rented Books</title>
	<?php 

		include '../elements/meta.php';
		include '../actions/dbconn.php';
		include '../actions/process.php';

		$sql = "SELECT b.book_id, b.ISBN, b.title, r.rent_year,  r.rent_month,  r.rent_day, u.user_id, u.username, b.genre FROM rent as r INNER JOIN users as u ON r.user_id = u.user_id INNER JOIN books as b ON b.book_id = r.book_id WHERE r.rent_year != 0000";
		if(isset($_SESSION['filter_query'])){
			$result = $conn->query($_SESSION['filter_query']);
			unset($_SESSION['filter_query']);
		} else{
			$result = $conn->query($sql);
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
			<form class="form-inline" action="../actions/process.php" method="post">
			  <div class="form-group mx-sm-3 mb-2">
			    <select class="form-control" name="rent_filter">
			    	<option>Day</option>
			        <option>Week</option>
			        <option>Month</option>
			        <option>Year</option>
			    </select>
			  </div>
			  <button type="submit" class="btn btn-primary mb-2">Submit</button>
			</form>
			<?php 
			if(isset($_SESSION['message'])): ?>

			<div class="alert alert-<?=$_SESSION['msg_type']?>">
				<?php
					echo $_SESSION['message'];
					unset($_SESSION['message']);
				?>
			</div>
			<?php endif; ?>
			<div class="container">
				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th scope="col">ISBN</th>
				      <th scope="col">Title</th>
				      <th scope="col">Genre</th>
				      <th scope="col">Username</th>
				      <th scope="col">Date Returned</th>
				    </tr>
				  </thead>
				  <?php  
				  	 while($row = $result->fetch_assoc()): ?>
				  	 	<tr>
				  	 		<td><?php echo $row['ISBN']; ?></td>
				  	 		<td><?php echo $row['title']; ?></td>
				  	 		<td><?php echo $row['genre']; ?></td>
				  	 		<td><?php echo $row['username']; ?></td>
				  	 		<td><?php echo $row['rent_year'].'-'.$row['rent_month'].'-'.$row['rent_day']; ?></td>
				  	 	</tr>
				  <?php endwhile; ?>
				</table>
			</div>
		</div>
</body>
</html>