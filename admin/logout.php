<?php
	require_once 'header.php';
	unset($_SESSION['currentUser']);
	
	header ('Location: login.php');
?>