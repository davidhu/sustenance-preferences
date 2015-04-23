<?php
	include 'api/include.php';
	include 'api/logincheck.php';
	
	$uid = $_SESSION["uid"];
/*	
	$stmt = 'SELECT username, first, last, fadded
		FROM friends INNER JOIN users ON (friends.sender = users.uid)
		WHERE uid = $1';
	$query = pg_prepare($dbconn, "friend_info", $stmt);
	$result = pg_execute($dbconn, "friend_info", array($uid));
	
	$friend_details = pg_fetch_all($result);
*/	//echo $friend_details;
	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sustenance Preferences</title>
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="">
	</head>

	<body>

		<div class="container">
			<?php include "navbar.php"; ?> 

			<table class="table table-hover">

				<tr>
					<th></th>
					<th>Username</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Date Added</th>
					<th>Remove Friend</th>
				</tr>

				<?php

				$stmt1 = "SELECT T.receiver, username, first, last, T.fadded FROM friends T, friends U, users WHERE T.sender = U.receiver AND T.receiver = U.sender AND T.sender = $1 AND T.receiver = uid ORDER BY username ASC";
				$result = pg_prepare($dbconn, "query1", $stmt1);
				$result = pg_execute($dbconn, "query1", array($uid));

				$i = 1;
				while ($row = pg_fetch_row($result)) {
					echo "<tr>";
					echo "<td>$i</td>";
					echo "<td>$row[1]</td>";
					echo "<td>$row[2]</td>";
					echo "<td>$row[3]</td>";
					echo "<td>$row[4]</td>";
					echo "<td><a class='btn btn-success add' role='button' style='display: none;'>Add<input hidden value=$row[0]></input></a><a class='btn btn-danger remove' role='button'>Remove<input hidden value=$row[0]></input></a></td>";
					echo "</tr>";
					$i++;
				}
					
/*
				<tr>
					<td>1</td>
					<td>apple</td>
					<td>John</td>
					<td>Smith</td>
					<td>June 10, 1990</td>
					<td>
						<button type="button" class="btn btn-danger">Remove</button>
					</td>
				</tr>

				<tr>
					<td>2</td>
					<td>apple2</td>
					<td>John</td>
					<td>Smith2</td>
					<td>June 10, 1991</td>
					<td>
						<button type="button" class="btn btn-danger">Remove</button>
					</td>
				</tr>
*/
				?>
			</table>
    </div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src="js/friends.js"></script>
	</body>
</html>
