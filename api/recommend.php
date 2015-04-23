<?php

	include "include.php";

	$uid = $_SESSION["uid"];
	$rid = $_GET["rid"];
	$fid = $_GET["fid"];
	
	$query = pg_prepare($dbconn, "suggestion_insert", "INSERT INTO suggestions VALUES ($1, $2, $3, now())");
	$result = pg_execute($dbconn, "suggestion_insert", array($uid, $rid, $fid));

?>
