<?php
if (isset($_COOKIE['User'])){
	setcookie('User', '', time()-7200, '/');
	}
	header('Location: /login.php');
	exit();
?>
