<?php
	include 'api/include.php';
	
	session_destroy();
	header("Location: index.php");
?>