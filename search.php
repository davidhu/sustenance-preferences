<?php
	include "api/include.php";
	$input = $_GET["user"];
	$search = '%' . $input . '%';

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
					<th>Add As Friend</th>
				</tr>

				<?php

				$i = 1;
				$stmt1 = "SELECT uid, username, first, last FROM users WHERE username LIKE $1";
				$result = pg_prepare($dbconn, "query", $stmt1);
				$result = pg_execute($dbconn, "query", array($search));
				
				while ($row = pg_fetch_row($result)) {
					echo "<tr>";
					echo "<td>$i</td>";
					echo "<td>$row[1]</td>";
					echo "<td>$row[2]</td>";
					echo "<td>$row[3]</td>";
					//echo "<td><button type='button' class='btn btn-success'>Add</button></td>";
					echo "<td><a class='btn btn-success' role='button'>Add<input hidden value=$row[0]></input></a></td>";
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
