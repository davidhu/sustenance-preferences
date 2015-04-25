<?php
	include 'api/include.php';
	include 'api/logincheck.php';
	$uid = $_SESSION["uid"];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sustenance Preferences</title>
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/all.css">
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
					<th>Delish?</th>
					<th>Date Added</th>
				</tr>

				<?php
					$stmt = 'SELECT rname, fname, delish, fdadded FROM fooddiaries
						NATURAL JOIN restaurants NATURAL JOIN foods
						WHERE uid = $1 ORDER BY fdadded DESC;';
					$query = pg_prepare($dbconn, "diary_info", $stmt);
					$result = pg_execute($dbconn, "diary_info", array($uid));
					
					$i = 1;
					while ($row = pg_fetch_row($result)) {
						echo "<tr>";
						echo "<td>$i</td>";
						echo "<td>$row[0]</td>";
						echo "<td>$row[1]</td>";
						if ($row[2] == 'n') {
							echo "<td>No!</td>";
						}
						else {
							echo "<td>Yes!</td>";
						}					
						echo "<td>$row[3]</td>";
						echo "</tr>";	
						$i++;
					}
				?>
			</table>
    </div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src=""></script>
	<footer></footer>
	</body>
</html>
