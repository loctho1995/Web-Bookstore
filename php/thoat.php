<?php
	session_start();
	unset($_SESSION['addindex']);
	unset($_SESSION['user_id']);
	header('Content-Type: text/html; charset=UTF-8');

	if(!isset($_SESSION['user_id']))
	{		
  		echo '<script type="text/javascript">
        	window.location="../php/home.php";    
        	</script>';
	}
	session_destroy();
?>