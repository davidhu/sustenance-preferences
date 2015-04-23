<?php

	include "include.php";

	$uid = $_SESSION["uid"];
	$friend_uid = $_GET["uid"];

	$query = pg_prepare($dbconn, "friend_remove", "DELETE FROM friends WHERE sender = $1 AND receiver = $2");
	$result = pg_execute($dbconn, "friend_remove", array($uid, $friend_uid));

?>
