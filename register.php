<?php
	include 'api/include.php';

	if (isset($_SESSION["uid"])) {
		header('Location: home.php');
	}

	$allgood = 1;
	if (isset($_POST["username"]) &&
		isset($_POST["email"]) &&
		isset($_POST["password"]) &&
		isset($_POST["confirm-password"]) &&
		isset($_POST["first"]) &&
		isset($_POST["last"]) &&
		isset($_POST["year"]) &&
		isset($_POST["month"]) &&
		isset($_POST["day"]) &&
		isset($_POST["gender"])) {
			$username = $_POST["username"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$confirm = $_POST["confirm-password"];
			$first = $_POST["first"];
			$last = $_POST["last"];
			$year = $_POST["year"];
			$month = $_POST["month"];
			$day = $_POST["day"];
			$gender = '';
			
			if ($_POST["gender"] == "m") {
				$gender = "m";
			}
			else if ($_POST["gender"] == "f") {
				$gender = "f";
			}
			else {
				$allgood = 0;
			}
			
			if (checkdate($month, $day, $year) == false) {
				$allgood = 0;
			}
			$birthdate = $year.'-'.$month.'-'.$day;
			
			if (strcmp($password, $confirm) != 0) {
				$allgood = 0;
			}
			
			if ($allgood = 1) {				
				$stmt = 'SELECT count(username) FROM users WHERE username = $1';
				$query = pg_prepare($dbconn, "unique", $stmt);
				$result = pg_execute($dbconn, "unique", array($username));
				$count = pg_fetch_result($result, 0, 0);
				
				if ($count != 0) {
					header('Location: index.php?rc=2');
				}
				else {
					$stmt = 'INSERT INTO users (username, email, password, first, last, birthdate, gender)
						VALUES ($1, $2, $3, $4, $5, $6, $7)';
					$query = pg_prepare($dbconn, "add_user", $stmt);
					$result = pg_execute($dbconn, "add_user", array($username, $email, $password, $first, $last, $birthdate, $gender));
					
					if ($result) {
						echo "Registration successful. Please Wait...";
						header('Refresh: 3; URL=home.php');
					}
					else {
						header('Location: index.php?rc=1');
					}
				}
			}
		}
	else {
		header('Location: index.php?rc=1');
	}
	
	
	
?>