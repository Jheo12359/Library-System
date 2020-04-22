<!DOCTYPE html>
<html>
<head>
	<title>Add Book</title>
	<?php
		include '../elements/meta.php'; 
		include '../actions/process.php';
	?>
</head>
<body>
	<div class="container">
		<?php include '../elements/header.php'; ?>
		<div class="wrapper">
			<h1>Update Book</h1>
			<form action="../actions/process.php" method="post">
			  <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
			  <div class="form-row">
			    <div class="form-group col">
			      <label>ISBN</label>
			      <input type="text" name="isbn" class="form-control" value="<?php echo $isbn; ?>" placeholder="example: 978-3-16-148410-0">
			    </div>
			  </div>
			  <div class="form-group">
			    <label>Title</label>
			    <input type="text" name="title" class="form-control" value="<?php echo $title; ?>" placeholder="example: The Brain that changes itself">
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-4">
			      <label>Genre</label>
			      <select class="form-control" name="genre">
			      	<option><?php echo $genre;?></option>
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
			  </div>
			  <?php 
			  	if ($status == 'inactive'):
			  ?>
			  	<button type="submit" class="btn btn-success" name="activate_book" style="float: right;" value="<?php echo $book_id; ?>">Activate</button>
			  <?php else: ?>
			  	<button type="submit" class="btn btn-danger" name="deactivate_book" style="float: right;" value="<?php echo $book_id; ?>">Deactivate</button>
			  <?php endif; ?>
			  <button type="submit" class="btn btn-primary" name="update_book">Update</button>
			</form>
		</div>
	</div>
</body>
</html>