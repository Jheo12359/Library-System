<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
	<?php
		include '../elements/meta.php';
		include '../actions/dbconn.php';
		include '../actions/process.php'; 
		if($_SESSION['type'] == 'admin'){
			$sql = "SELECT * FROM books";
		} else {
			$sql = "SELECT * FROM books WHERE status != 'inactive'";
		}
		
		if(isset($_SESSION['search_query'])){
			$result = $conn->query($_SESSION['search_query']);
			unset($_SESSION['search_query']);
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
			<?php 

			if(isset($_SESSION['message'])): ?>

			<div class="alert alert-<?=$_SESSION['msg_type']?>">
				<?php
					echo $_SESSION['message'];
					unset($_SESSION['message']);
				?>
			</div>
			<?php endif; ?>
			<?php if($_SESSION['type'] == 'admin'): ?>
				<a href="register_book.php" class="btn btn-outline-primary" id="add_bookbtn">Add Book</a>
			<?php else : ?>
				<div class="search_container">
					<form class="form-inline" action="../actions/process.php" method="post">
					  <div class="form-group mx-sm-3 mb-2">
					    <input type="text" class="form-control" name="search" placeholder="Enter book">
					  </div>
					  <button type="submit" class="btn btn-primary mb-2">Submit</button>
					</form>
				</div>
				<div style="clear: both;"></div>
				<div class="filter_container">
					<form class="form-inline" action="../actions/process.php" method="post">
					  <div class="form-group mx-sm-3 mb-2">
					    <select class="form-control" name="genre_search">
					    	<option>Fantasy</option>
					        <option>Comics</option>
					        <option>Adventure</option>
					        <option>Romance</option>
					        <option>Contemporary</option>
					        <option>Dystopian</option>
					        <option>Mystery</option>
					        <option>Horror</option>
					        <option>Thriller</option>
					        <option>Paranormal</option>
					        <option>Historical Fiction</option>
					        <option>Science Fiction</option>
					        <option>Cooking</option>
					        <option>Development</option>
					        <option>History</option>
					        <option>Health</option>
					        <option>Humor</option>
					        <option>Guide / How-to</option>
					        <option>Childrens'</option>
					    </select>
					  </div>
					  <button type="submit" class="btn btn-primary mb-2">Submit</button>
					</form>
				</div>
				<?php endif; ?>
				<table class="table table-bordered">
				  <thead>
				    <tr>
				      <th scope="col">ISBN</th>
				      <th scope="col">Title</th>
				      <th scope="col">Genre</th>
				      <th scope="col">Status</th>
				      <th></th>
				    </tr>
				  </thead>
				  <?php  
				  	 while($row = $result->fetch_assoc()): ?>
				  	 	<tr>
				  	 		<td><?php echo $row['ISBN']; ?></td>
				  	 		<td><?php echo $row['title']; ?></td>
				  	 		<td><?php echo $row['genre']; ?></td>
				  	 		<td>
				  	 		<?php if ($row['status'] == 'inactive') : ?>
				  	 			<span class="badge badge-pill badge-danger">Inactive</span>
				  	 		<?php elseif ($row['status'] == 'rented') : ?>
				  	 			<span class="badge badge-pill badge-info">Rented</span>
				  	 		<?php else : ?>
				  	 			<span class="badge badge-pill badge-success">Available</span>
				  	 		<?php endif; ?>
				  	 		</td>
				  	 		<td>
				  	 			<?php
				  	 				if($_SESSION['type'] == 'admin') : 
				  	 			?>
				  	 			<a href="../pages/update_book.php?edit_book=<?php echo $row['book_id']; ?>"
				  	 				class="btn btn-info">edit</a>
				  	 			<a href="../actions/process.php?delete_book=<?php echo $row['book_id']; ?>"
				  	 				class="btn btn-danger">Delete</a>
				  	 			<?php elseif ($row['status'] == 'rented') : ?>
				  	 				<span class="badge badge-pill badge-info">Unavailable</span>
				  	 			<?php  else : ?>
				  	 				<a href="../actions/process.php?rent_book=<?php echo $row['book_id']; ?>"
				  	 				class="btn btn-info">Rent</a>
				  	 			<?php endif; ?>
				  	 		</td>
				  	 	</tr>
				  <?php endwhile; ?>
				</table>
		</div>
</body>
</html>