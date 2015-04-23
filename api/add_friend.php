<?php

	include "include.php";

	$uid = $_SESSION["uid"];
	$friend_uid = $_GET["uid"];

	$query = pg_prepare($dbconn, "friend_insert", "INSERT INTO friends VALUES ($1, $2, now())");
	$result = pg_execute($dbconn, "friend_insert", array($uid, $friend_uid));

?>
