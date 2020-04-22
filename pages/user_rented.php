<!DOCTYPE html>
<html>
<head>
	<title>Rented Books</title>
	<?php 
		include '../elements/meta.php';
		include '../actions/dbconn.php';
		include '../actions/process.php';

		$user_id = $_SESSION['user_id'];

		$sql = "SELECT b.book_id, b.title, b.genre, r.user_id, r.book_id, r.status, r.rent_year, r.rent_month, r.rent_day, r.return_day FROM books AS b JOIN rent AS r ON b.book_id=r.book_id WHERE user_id = $user_id AND r.status != 'returned'";
		$result = $conn->query($sql);
		$current_day = date('d');
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
			<div class="wrapper">
				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th scope="col">Title</th>
				      <th scope="col">Genre</th>
				      <th scope="col">Date Rented</th>
				      <th scope="col">Note</th>
				    </tr>
				  </thead>
				  <?php  
				  	 while($row = $result->fetch_assoc()): ?>
				  	 	<tr>
				  	 		<td><?php echo $row['title']; ?></td>
				  	 		<td><?php echo $row['genre']; ?></td>
				  	 		<td><?php echo $row['rent_year'].'-'.$row['rent_month'].'-'.$row['rent_day']; ?></td>
				  	 		<td>
				  	 			<?php if( $current_day > $row['return_day']):?>
				  	 				<span class="badge badge-pill badge-danger">Overdue</span>
				  	 			<?php endif; ?>
				  	 		</td>
				  	 		<td>
				  	 			<a href="../actions/process.php?return_book=<?php echo $row['book_id']; ?>"
				  	 				class="btn btn-success">Return</a>
				  	 		</td>
				  	 	</tr>
				  <?php endwhile; ?>
				</table>
			</div>
		</div>
</body>
</html>