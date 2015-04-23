<?php

	include "api/include.php";
	include 'api/logincheck.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sustenance Preferences</title>
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/restaurants.css">
	</head>

	<body>

		<div class="container">
			<?php include "navbar.php"; ?> 

			<table class="table table-hover">

				<tr>
					<th></th>
					<th>Restaurant</th>
					<th>Location</th>
				</tr>

				<?php
				$stmt1 = "SELECT rid, rname, address FROM restaurants ORDER BY rname ASC;";

				$result = pg_query($dbconn, $stmt1);

				$i = 1;
				while ($row = pg_fetch_row($result)) {
					echo "<tr class='clickable' data-href='restaurant.php?rid=$row[0]'>";
					echo "<td>$i</td>";
					echo "<td>$row[1]</td>";
					echo "<td>$row[2]</td>";
					echo "</tr>";	
					$i++;
				}

//				<tr class="clickable" data-href="restaurant.php?name=Shake+Shack">
//					<td>1</td>
//					<td>Shake Shack</td>
//					<td>2 Metrotech</td>
//				</tr>
				?>
			</table>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src="js/restaurants.js"></script>
	</body>
</html>
