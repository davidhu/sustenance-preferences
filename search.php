<?php
	include "api/include.php";
	$input = $_GET["user"];
	$search = '%' . $input . '%';
	$uid = $_SESSION["uid"];

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
					<th>Add/Remove Friend</th>
				</tr>

				<?php

				$i = 1;
				$stmt1 = "SELECT uid, username, first, last FROM users WHERE username LIKE $1 AND uid IN (SELECT receiver FROM friends WHERE sender = $2)";
				$result = pg_prepare($dbconn, "query1", $stmt1);
				$result = pg_execute($dbconn, "query1", array($search, $uid));
				
				while ($row = pg_fetch_row($result)) {
					echo "<tr>";
					echo "<td>$i</td>";
					echo "<td>$row[1]</td>";
					echo "<td>$row[2]</td>";
					echo "<td>$row[3]</td>";
					//echo "<td><button type='button' class='btn btn-success'>Add</button></td>";
					echo "<td><a class='btn btn-success add' role='button' style='display: none;'>Add<input hidden value=$row[0]></input></a><a class='btn btn-danger remove' role='button'>Remove<input hidden value=$row[0]></input></a></td>";
					echo "</tr>";
					$i++;
				}
				
				$stmt2 = "SELECT uid, username, first, last FROM users WHERE username LIKE $1 AND uid NOT IN (SELECT receiver FROM friends WHERE sender = $2) AND uid != $2";
				$result = pg_prepare($dbconn, "query2", $stmt2);
				$result = pg_execute($dbconn, "query2", array($search, $uid));
				
				while ($row = pg_fetch_row($result)) {
					echo "<tr>";
					echo "<td>$i</td>";
					echo "<td>$row[1]</td>";
					echo "<td>$row[2]</td>";
					echo "<td>$row[3]</td>";
					//echo "<td><button type='button' class='btn btn-success'>Add</button></td>";
					echo "<td><a class='btn btn-success add' role='button'>Add<input hidden value=$row[0]></input></a><a class='btn btn-danger remove' role='button' style='display: none;'>Remove<input hidden value=$row[0]></input></a></td>";
					echo "</tr>";
					$i++;
				}
/*
				<tr>
					<td>1</td>
					<td>apple</td>
					<td>John</td>
					<td>Smith</td>
					<td>
						<button type="button" class="btn btn-success">Add</button>
					</td>
				</tr>

				<tr>
					<td>2</td>
					<td>apple2</td>
					<td>John</td>
					<td>Smith2</td>
					<td>
						<button type="button" class="btn btn-success">Add</button>
					</td>
				</tr>
*/
				?>
			</table>
    </div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src="js/search.js"></script>
	</body>
</html>
