<?php
	include 'api/include.php';
	
	$uid = $_SESSION["uid"];
	
	$stmt = 'SELECT username, first, last, fadded
		FROM friends INNER JOIN users ON (friends.sender = users.uid)
		WHERE uid = $1';
	$query = pg_prepare($dbconn, "friend_info", $stmt);
	$result = pg_execute($dbconn, "friend_info", array($uid));
	
	$friend_details = pg_fetch_all($result);
	//echo $friend_details;
	
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

			</table>
    </div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src=""></script>
	</body>
</html>
