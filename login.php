<?php
	include 'api/include.php';
	
	if (isset($_SESSION["uid"])) {
		header('Location: home.php');
	}
	else {
		if (isset($_POST["username"]) && isset($_POST["password"])) {
			$uname = $_POST["username"];
			$pwd = $_POST["password"];
			$stmt = 'SELECT uid FROM users WHERE username = $1 AND password = $2';
			$query = pg_prepare($dbconn, "credential", $stmt);
			$result = pg_execute($dbconn, "credential", array($uname, $pwd));
			
			$count = pg_num_rows($result);
			if ($count == 1) {
				$_SESSION["uid"] = pg_fetch_result($result, 0, 0);
				header('Location: home.php');
			}
			else {
				header('Location: index.php?ng=1');
			}
		}
	}
?>