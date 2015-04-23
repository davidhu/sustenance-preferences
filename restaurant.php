<?php

	include "api/include.php";
	include "api/logincheck.php";
	$uid = $_SESSION["uid"];
	$rid = $_GET["rid"];

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

			<div class="row">
				<div class="col-md-3">
					<img src="img/temp.jpg"></img>
				</div>
				<div class="col-md-1"></div>

				<div class="col-md-6">
				
					<table class="table table-bordered">
						<input hidden id="rid" value=<?php echo $rid; ?>></input>
					<?php

					$stmt1 = "SELECT rname, address, description FROM restaurants WHERE rid = $1";
					$result = pg_prepare($dbconn, "query1", $stmt1);
					$result = pg_execute($dbconn, "query1", array($rid)); 

					$row = pg_fetch_row($result);

					echo "<tr>";
					echo "<th>Restaurant</th>";
					echo "<td>$row[0]</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<th>Location</th>";
					echo "<td>$row[1]</td>";
					echo "</tr>";
					echo "<tr>";
					echo "<th>Brief Description</th>";
					echo "<td>$row[2]</td>";
					echo "</tr>";

					?>	
					</table>
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-hover">
						<tr>
							<th>Food</th>
							<th>Description</th>
							<th></th>
						</tr>
						
						<?php

						$stmt2 = "SELECT fid, fname, fdesc FROM foods WHERE rid = $1 ORDER BY fname ASC";
						$result = pg_prepare($dbconn, "query2", $stmt2);
						$result = pg_execute($dbconn, "query2", array($rid));

						$stmt3 = "SELECT uid FROM foods NATURAL JOIN suggestions WHERE uid = $1 AND rid = $2 AND fid = $3";
						$result2 = pg_prepare($dbconn, "query3", $stmt3);
						
						while ($row = pg_fetch_row($result)) {

							echo "<tr>";
							echo "<td>$row[1]</td>";
							echo "<td>$row[2]</td>";
							
							$result2 = pg_execute($dbconn, "query3", array($uid, $rid, $row[0]));
							echo "<td><a class='btn btn-primary' href='add_entry.php?rid=$rid&fid=$row[0]' role='button'>Add to Diary</a>&nbsp;";
							if (pg_fetch_row($result2)) {
								echo "<a class='btn btn-success alrec' role='button' disabled>Already Recommended</a>";
							} else {
								echo "<a class='btn btn-primary rec' role='button' value=" . $row[0] . ">Recommend to Others</a>";
							}
							echo "</td>";
							echo "</tr>";
						}

						?>
					</table>

				</div>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src="js/restaurant.js"></script>
	</body>
</html>
