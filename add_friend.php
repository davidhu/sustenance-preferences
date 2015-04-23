<?php
	include 'api/include.php';
	include 'api/insert.php';
	
	$uid = $_SESSION["uid"];
	$fid = $_GET["fid"];
	$input = $_GET["user"];
	
	if (isset($_SESSION["uid"]) && isset($fid)) {
		
		$result = insert_to_friends($uid, $fid);
		header('Location: search.php?user='.$input.'&fi='.$result);
	}
	else {
		return false;
	}
?>
