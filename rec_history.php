<?php
	include 'api/include.php';
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
					<th>Restaurant</th>
					<th>Food</th>
					<th>Date Suggested</th>
				</tr>
				
				<?php
					$stmt = "SELECT rname, fname, sadded
						FROM foods NATURAL JOIN suggestions NATURAL JOIN restaurants
						WHERE uid = $1";
					$query = pg_prepare($dbconn, "suggestinfo", $stmt);
					$result = pg_execute($dbconn, "suggestinfo", array($uid));
					
					$i = 1;
					while ($row = pg_fetch_row($result)) {
						echo "<tr><td>$i</td><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
					$i++;
					}
				?>
				
			</table>
    </div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src=""></script>
	</body>
</html>
