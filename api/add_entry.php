<?php
	
	include "include.php";
	
	$uid = $_SESSION["uid"];
	$rid = $_GET["rid"];
	$fid = $_GET["fid"];
	$delish = $_GET["delish"];

	$query = pg_prepare($dbconn, "diary_insert", "INSERT INTO fooddiaries VALUES ($1, $2, $3, $4, now())");
	$result = pg_execute($dbconn, "diary_insert", array($uid, $rid, $fid, $delish));

?>
