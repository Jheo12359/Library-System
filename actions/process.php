<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	ini_set('display_errors', 0); 
	session_start();
	$book_id = 0;

	$mysqli = new mysqli('localhost', 'root', '', 'library_system') or die (mysqli_error($mysqli));

	// User validation
	if(isset($_POST['loginbtn'])){
		$username = $_POST['username'];
		$password = md5($_POST['password']);


		$result = $mysqli->query("SELECT * FROM users WHERE username = '$username' AND password ='$password' ") or die ($mysqli->error);


		if($result && $result->num_rows){
			$user = $result->fetch_object();
			$_SESSION[ 'user_id' ] = $user->user_id;
			$_SESSION[ 'username' ] = $user->username;
			$_SESSION[ 'type' ] = $user->type;
			$_SESSION[ 'status' ] = $user->status;
			if ($_SESSION['type'] == 'admin') {
				header("location: ../pages/books.php");
			} elseif ($_SESSION['status'] == 'inactive') {
				$_SESSION['message'] = 'Your account was deactivated. Please consult the Librarian.';
				$_SESSION['msg_type'] = 'warning';
				header("location: ../pages/login.php");
			} else {
				header("location: ../pages/books.php");
			}

		} else {
			$_SESSION['message'] = 'Invalid login';
			$_SESSION['msg_type'] = 'warning';
			header("location: ../pages/login.php");
		}
	}
	// Rent book
	if(isset($_GET['rent_book'])){
		$user_id = $_SESSION['user_id'];
		$book_id = $_GET['rent_book'];
		$rent_year = date('Y');
		$rent_month = date('M');
		$rent_week = date('W');
		$rent_day = date('j');
		$return_day = $rent_day + 1;

		$_SESSION['message'] = 'Book rented!';
		$_SESSION['msg_type'] = 'success';

		$mysqli->query("INSERT INTO rent (book_id, user_id, rent_year, rent_month, rent_week, rent_day , return_day) VALUES('$book_id', '$user_id', '$rent_year', '$rent_month', '$rent_week', '$rent_day', '$return_day')") or die($mysqli->error);

		$mysqli->query("UPDATE books SET status = 'rented' WHERE book_id = $book_id") or die($mysqli->error);

		header("location: ../pages/books.php");
	}
	// Return book
	if(isset($_GET['return_book'])){
		$user_id = $_SESSION['user_id'];
		$book_id = $_GET['return_book'];
		$return_year = date('Y');
		$return_month = date('M');
		$return_week = date('W');
		$returned_day = date('j');

		$_SESSION['message'] = 'Book returned!';
		$_SESSION['msg_type'] = 'success';

		$mysqli->query("INSERT INTO rent (book_id, user_id, return_year, return_month, return_week, returned_day) VALUES('$book_id', '$user_id', '$return_year', '$return_month', '$return_week', '$returned_day')") or die($mysqli->error);

		$mysqli->query("UPDATE books SET status = 'returned' WHERE book_id = $book_id") or die($mysqli->error);
		$mysqli->query("UPDATE rent SET status = 'returned' WHERE book_id = $book_id") or die($mysqli->error);

		header("location: ../pages/user_rented.php");
	}
	// Admin Rented books filter by Day, Week, Month, Year
	if(isset($_POST['rent_filter'])){
		$filterq = $_POST['rent_filter'];

		$filter_by_crrntday = date('j');

		$_SESSION['message'] = 'Filtered by '.$filterq.'.';
		$_SESSION['msg_type'] = 'info';
		if($filterq == 'Day'){
			$_SESSION['filter_query'] = "SELECT b.book_id, b.ISBN, b.title, r.rent_year,  r.rent_month,  r.rent_day, u.user_id, u.username, b.genre FROM rent as r INNER JOIN users as u ON r.user_id = u.user_id INNER JOIN books as b ON b.book_id = r.book_id WHERE r.rent_day = '$filter_by_crrntday' ";
		} elseif($filterq == 'Week'){
			$_SESSION['filter_query'] = "SELECT b.book_id, b.ISBN, b.title, r.rent_year,  r.rent_month,  r.rent_day, u.user_id, u.username, b.genre FROM rent as r INNER JOIN users as u ON r.user_id = u.user_id INNER JOIN books as b ON b.book_id = r.book_id WHERE r.rent_year != 0000 ORDER BY rent_week";
		} elseif($filterq == 'Month'){
			$_SESSION['filter_query'] = "SELECT b.book_id, b.ISBN, b.title, r.rent_year,  r.rent_month,  r.rent_day, u.user_id, u.username, b.genre FROM rent as r INNER JOIN users as u ON r.user_id = u.user_id INNER JOIN books as b ON b.book_id = r.book_id WHERE r.rent_year != 0000 ORDER BY rent_month DESC";
		} elseif($filterq == 'Year'){
			$_SESSION['filter_query'] = "SELECT b.book_id, b.ISBN, b.title, r.rent_year,  r.rent_month,  r.rent_day, u.user_id, u.username, b.genre FROM rent as r INNER JOIN users as u ON r.user_id = u.user_id INNER JOIN books as b ON b.book_id = r.book_id WHERE r.rent_year != 0000 ORDER BY rent_year ASC";
		}	
		header("location: ../pages/admin_report_rented.php");
	}
	// Admin Returned books filter by Day, Week, Month, Year
	if(isset($_POST['return_filter'])){
		$filterq = $_POST['return_filter'];

		$filter_by_crrntday = date('j');

		$_SESSION['message'] = 'Filtered by '.$filterq.'.';
		$_SESSION['msg_type'] = 'info';
		if($filterq == 'Day'){
			$_SESSION['filter_query'] = "SELECT b.book_id, b.ISBN, b.title, r.return_year,  r.return_month,  r.return_day, u.user_id, u.username, b.genre FROM rent as r INNER JOIN users as u ON r.user_id = u.user_id INNER JOIN books as b ON b.book_id = r.book_id WHERE r.return_day = '$filter_by_crrntday' ";
		} elseif($filterq == 'Week'){
			$_SESSION['filter_query'] = "SELECT b.book_id, b.ISBN, b.title, r.return_year,  r.return_month,  r.return_day, u.user_id, u.username, b.genre FROM rent as r INNER JOIN users as u ON r.user_id = u.user_id INNER JOIN books as b ON b.book_id = r.book_id WHERE r.return_year != 0000 ORDER BY return_week";
		} elseif($filterq == 'Month'){
			$_SESSION['filter_query'] = "SELECT b.book_id, b.ISBN, b.title, r.return_year,  r.return_month,  r.return_day, u.user_id, u.username, b.genre FROM rent as r INNER JOIN users as u ON r.user_id = u.user_id INNER JOIN books as b ON b.book_id = r.book_id WHERE r.return_year != 0000 ORDER BY return_month DESC";
		} elseif($filterq == 'Year'){
			$_SESSION['filter_query'] = "SELECT b.book_id, b.ISBN, b.title, r.return_year,  r.return_month,  r.return_day, u.user_id, u.username, b.genre FROM rent as r INNER JOIN users as u ON r.user_id = u.user_id INNER JOIN books as b ON b.book_id = r.book_id WHERE r.return_year != 0000 ORDER BY return_year ASC";
		}	
		header("location: ../pages/admin_report_rented.php");
	}

	// Search book title or ISBN
	if(isset($_POST['search'])){
		$searchq = $_POST['search'];

		$_SESSION['message'] = 'Is this the book?';
		$_SESSION['msg_type'] = 'info';

		$_SESSION['search_query'] = "SELECT * FROM books WHERE title = '$searchq' OR ISBN='$searchq' AND status !='inactive'" ;
		header("location: ../pages/books.php");
	}
	// Filter books by genre
	if(isset($_POST['genre_search'])){
		$searchq = $_POST['genre_search'];

		$_SESSION['message'] = 'Is this the book?';
		$_SESSION['msg_type'] = 'info';

		$_SESSION['search_query'] = "SELECT * FROM books WHERE genre = '$searchq' AND status !='inactive'" ;
		header("location: ../pages/books.php");
	}

	// ADD book
	if (isset($_POST['add_book'])){
		$isbn = $_POST['isbn'];
		$title = $_POST['title'];
		$genre = $_POST['genre'];
		$date = date('y-m-d');

		$_SESSION['message'] = 'Book has been added!';
		$_SESSION['msg_type'] = 'success';

		$mysqli->query("INSERT INTO books (ISBN, title, genre, date_added) VALUES('$isbn', '$title', '$genre', '$date')") or die($mysqli->error);

		header("location: ../pages/books.php");
	}
	// ADD user
	if (isset($_POST['add_user'])){
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$confirm_pass = md5($_POST['confirm_pass']);
		$user_type = $_POST['user_type'];
		$date_created = date('y-m-d');

		if(isset($confirm_pass) && $confirm_pass == $password){

			$_SESSION['message'] = 'Congratulations! You now have created your account!';
			$_SESSION['msg_type'] = 'success';

			$mysqli->query("INSERT INTO users (type, fname, lname, username, password, created) VALUES('$user_type', '$fname', '$lname', '$username', '$password' ,'$date_created')") or die($mysqli->error);

			header("location: ../pages/sign_up.php");

		} else {
			$_SESSION['message'] = 'your password does not match';
			$_SESSION['msg_type'] = 'warning';
			header("location: ../pages/sign_up.php");
		}
	}
	// deac book
	if (isset($_POST['deactivate_book'])){
		$book_id = $_POST['deactivate_book'];

		$_SESSION['message'] = "Book has been deactivated";
		$_SESSION['msg_type'] = "danger";

		$mysqli->query("UPDATE books SET status='inactive' WHERE book_id=$book_id") or die($mysqli->error);

		header("location: ../pages/books.php");

	}
	// deac user
	if (isset($_POST['deactivate_user'])){
		$user_id = $_POST['deactivate_user'];

		$_SESSION['message'] = "User has been deactivated";
		$_SESSION['msg_type'] = "danger";

		$mysqli->query("UPDATE users SET status='inactive' WHERE user_id=$user_id") or die($mysqli->error);

		header("location: ../pages/lessees.php");

	}
	// reacti book
	if (isset($_POST['activate_book'])){
		$book_id = $_POST['activate_book'];
		$_SESSION['message'] = "Book has been activated";
		$_SESSION['msg_type'] = "success";


		$mysqli->query("UPDATE books SET status='' WHERE book_id=$book_id") or die($mysqli->error);

		header("location: ../pages/books.php");

	}
	// reacti user
	if (isset($_POST['activate_user'])){
		$user_id = $_POST['activate_user'];
		$_SESSION['message'] = "User has been activated";
		$_SESSION['msg_type'] = "success";


		$mysqli->query("UPDATE users SET status='active' WHERE user_id=$user_id") or die($mysqli->error);

		header("location: ../pages/lessees.php");
	}
	// edit book
	if (isset($_GET['edit_book'])){
		$book_id = $_GET['edit_book'];

		$result = $mysqli->query("SELECT * FROM books WHERE book_id=$book_id") or die($mysqli->error);

		if(count($result)==1){
			$row = $result->fetch_array();
			$isbn = $row['ISBN'];
			$title = $row['title'];
			$genre = $row['genre'];
			$status = $row['status'];
		}
	}
	// edit user
	if (isset($_GET['edit_user'])){
		$user_id = $_GET['edit_user'];

		$result = $mysqli->query("SELECT * FROM users WHERE user_id=$user_id") or die($mysqli->error);

		if(count($result)==1){
			$row = $result->fetch_array();
			$fname = $row['fname'];
			$lname = $row['lname'];
			$username = $row['username'];
			$status = $row['status'];
		}
	}
	// Update book
	if (isset($_POST['update_book'])){
		$book_id = $_POST['book_id'];
		$isbn = $_POST['isbn'];
		$title = $_POST['title'];
		$genre = $_POST['genre'];

		$_SESSION['message'] = "Book has been Updated";
		$_SESSION['msg_type'] = "info";

		$mysqli->query("UPDATE books SET ISBN = '$isbn', title = '$title', genre = '$genre' WHERE book_id=$book_id") or die($mysqli->error);

		header("location: ../pages/books.php");
	}
	// Update user
	if (isset($_POST['update_user'])){
		$user_id = $_POST['user_id'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$username = $_POST['username'];
		$new_password = $_POST['new_password'];
		$confirm_pass = $_POST['confirm_pass'];

		if($confirm_pass == '' && $new_password == ''){

			$_SESSION['message'] = "User has been Updated";
			$_SESSION['msg_type'] = "info";

			$mysqli->query("UPDATE users SET fname = '$fname', lname = '$lname', username = '$username' WHERE user_id=$user_id") or die($mysqli->error);

			header("location: ../pages/lessees.php");

		} elseif(isset($confirm_pass) && $confirm_pass == $new_password) {
			$new_password = md5($_POST['new_password']);

			$_SESSION['message'] = "User has been Updated";
			$_SESSION['msg_type'] = "info";

			$mysqli->query("UPDATE users SET fname = '$fname', lname = '$lname', username = '$username', password = '$new_password' WHERE user_id=$user_id") or die($mysqli->error);
			
			header("location: ../pages/lessees.php");
		} else {
			$_SESSION['user_id'] = $user_id;
			$_SESSION['fname'] = $fname;
			$_SESSION['lname'] = $lname;
			$_SESSION['username'] = $username;

			$_SESSION['message'] = "Password does not match";
			$_SESSION['msg_type'] = "info";

			header("location: ../pages/update_lessees.php");
		}
	}
	// Delete book
	if (isset($_GET['delete_book'])){
		$book_id = $_GET['delete_book'];

		$_SESSION['message'] = "Book has been deleted";
		$_SESSION['msg_type'] = "danger";

		$mysqli->query("DELETE FROM books WHERE book_id=$book_id") or die($mysqli->error);

		header("location: ../pages/books.php");

	}
	// Delete user
	if (isset($_GET['delete_user'])){
		$user_id = $_GET['delete_user'];

		$_SESSION['message'] = "User has been deleted";
		$_SESSION['msg_type'] = "danger";

		$mysqli->query("DELETE FROM users WHERE user_id=$user_id") or die($mysqli->error);

		header("location: ../pages/lessees.php");

	}
?>