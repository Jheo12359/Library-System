<!DOCTYPE html>
<html>
<head>
	<title>Add Book</title>
	<?php
		include '../elements/meta.php'; 
		include '../actions/process.php';
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
	<?php if(isset($_SESSION['message'])): ?>
		<div class="alert alert-<?=$_SESSION['msg_type']?>" role="alert">
			<?php
				echo $_SESSION['message'];
				unset($_SESSION['message']);
			?>
		</div>
	<?php endif ?>
	<div class="wrapper">
		<h1 class="sign-up-header">Add Book</h1>
		<form action="../actions/process.php" method="post">
		  <div class="form-row">
		    <div class="form-group col">
		      <label>ISBN</label>
		      <input type="text" name="isbn" class="form-control" placeholder="example: 978-3-16-148410-0">
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col">
		      <label>Title</label>
		      <input type="text" name="title" class="form-control" placeholder="example: The king">
		    </div>
		  </div>
		  <div class="form-row">
		    <div class="form-group col-md-4">
		      <label>Genre</label>
		      <select class="form-control" name="genre">
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
		  <button type="submit" class="btn btn-primary" name="add_book">Save</button>
		</form>
	</div>
</div>
</body>
</html>