<?php
	include "api/include.php";
	$restaurant = $_GET["rid"];
	$food = $_GET["fid"];

	$stmt = 'SELECT rname FROM restaurants WHERE rid = $1';
	$query = pg_prepare($dbconn, "find_rname", $stmt);
	$result = pg_execute($dbconn, "find_rname", array($restaurant));
	$rest_name = pg_fetch_result($result, 0, 0);
	
	$stmt = 'SELECT fname FROM foods WHERE rid = $1 AND fid = $2';
	$query = pg_prepare($dbconn, "find_fname", $stmt);
	$result = pg_execute($dbconn, "find_fname", array($restaurant, $food));
	$food_name = pg_fetch_result($result, 0, 0);
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
			<h2><?php echo $rest_name." - ".$food_name; ?></h2>
			<h3>How was it?</h3>
<form action="#">
<input type="button" class="btn btn-lg btn-default" id="delish" value="Delish!"></input>
<input type="button" class="btn btn-lg btn-default" id="notdelish" value="Not Delish"></input>
<input type="submit" class="btn btn-lg btn-success" disabled></input>
</form>
    </div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src="js/add_entry.js"></script>
	</body
</html>
