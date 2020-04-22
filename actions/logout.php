<?php   
	session_destroy();
	unset($_SESSION[ 'user_id' ]);
	unset($_SESSION[ 'username' ]);
	unset($_SESSION[ 'type' ]);
	unset($_SESSION[ 'status' ]);
	header("location: ../pages/login.php");
?>