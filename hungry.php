<?php
	include "api/include.php";
	include "api/logincheck.php";

	$uid = $_SESSION["uid"];

	if (!isset($_GET["longitude"]) || !isset($_GET["latitude"])) {
?>
	<script src="js/location.js"></script>
<?php
	} else {

	$mylong = $_GET["longitude"];
	$mylat = $_GET["latitude"];

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sustenance Preferences</title>
		<link rel="stylesheet" type="text/css" href="bootstrap-3.3.4-dist/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/hungry.css">
		<link rel="stylesheet" type="text/css" href="css/all.css">
	</head>

	<body>

		<div class="container">
			<?php include "navbar.php"; ?> 

			<?php
				
				$arr1 = $arr2 = $arr3 = $arr4 = array();
				$stmt1 = "SELECT rid FROM restaurants ORDER BY sqrt(($1-longitude)^2+($2-latitude)^2) ASC";

				$query1 = pg_prepare($dbconn, "dist", $stmt1);
				$query1 = pg_execute($dbconn, "dist", array($mylong, $mylat));			
				while ($row = pg_fetch_row($query1)) {
					array_push($arr1, $row[0]);
				}

				$stmt2 = "SELECT rid
									FROM (SELECT T.receiver AS uid
									FROM friends T, friends U
									WHERE T.sender = U.receiver AND T.receiver = U.sender AND T.sender = $1) as V NATURAL JOIN suggestions
									GROUP BY rid
									ORDER BY COUNT(rid) DESC";
				$query2 = pg_prepare($dbconn, "rest", $stmt2);
				$query2 = pg_execute($dbconn, "rest", array($uid));
        while ($row = pg_fetch_row($query2)) {
          array_push($arr2, $row[0]);
        }

				$stmt3 = "SELECT rid FROM fooddiaries WHERE uid = $1 ORDER BY fdadded DESC LIMIT 5";
				$query3 = pg_prepare($dbconn, "diary", $stmt3);
				$query3 = pg_execute($dbconn, "diary", array($uid));
        while ($row = pg_fetch_row($query3)) {
          array_push($arr3, $row[0]);
        }

				$stmt4 = "SELECT rid FROM recommended WHERE uid = $1 ORDER BY radded DESC LIMIT 3";
				$query4 = pg_prepare($dbconn, "rec", $stmt4);
				$query4 = pg_execute($dbconn, "rec", array($uid));
        while ($row = pg_fetch_row($query4)) {
          array_push($arr4, $row[0]);
        }

				$arr1 = array_diff(array_diff($arr1, $arr3), $arr4);
				$arr2 = array_diff(array_diff($arr2, $arr3), $arr4);

				$i = 0;
				$a = array();
				foreach ($arr1 as $item) {
					$a[$item] = $i;
					$i++;
				}

				$i = 0;
				$b = array();
				foreach ($arr2 as $item) {
					$b[$item]=$i;
					$i++;
				}

				$len = count($a);
				$c = array();
				foreach ($a as $index=>$value) {
					$c[$index] = $value;
					if (array_key_exists($index, $b)) {
						$c[$index] += $b[$index];
					} else {
						$c[$index] += $len;
					}
				}
				asort($c);
				$c = array_slice($c, 0, 3, true);

				$d = array();
				$i = 0;
				foreach ($c as $key=>$value) {
					$d[$i] = $key;
					$i++;
				}

				exec("backend.exe $d[0], $d[1], $d[2]", $output);

				$rid = intval($output[0]);

				$stmt5 = "	SELECT T.rid, T.fid, COUNT(sadded)
									FROM (SELECT restaurants.rid, fid
									FROM restaurants LEFT JOIN foods ON restaurants.rid = foods.rid
									WHERE restaurants.rid = $1) T LEFT JOIN suggestions ON T.rid = suggestions.rid AND T.fid = suggestions.fid
									GROUP BY T.rid, T.fid
									ORDER BY COUNT(sadded) DESC
									LIMIT 1";


				$query5 = pg_prepare($dbconn, "give", $stmt5);
				$query5 = pg_execute($dbconn, "give", array($rid));
				
				$row = pg_fetch_row($query5);
				$fid = $row[1];

				$stmt6 = "SELECT rname, fname FROM restaurants NATURAL JOIN foods WHERE rid = $1 AND fid = $2";
				$query6 = pg_prepare($dbconn, "final", $stmt6);
				$query6 = pg_execute($dbconn, "final", array($rid, $fid));
				
				$row = pg_fetch_row($query6);
				$rname = $row[0];
				$fname = $row[1];

				$stmt7 = "INSERT INTO recommended VALUES ($1, $2, now())";
				$query7 = pg_prepare($dbconn, "insert", $stmt7);
				$query7 = pg_execute($dbconn, "insert", array($uid, $rid));
				
			
			echo "<h1 class='clickable' data-href='restaurant.php?rid=$rid'>You should go to $rname and get a $fname!</h1>";
		}
?>
		</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script src="bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	<script src="js/hungry.js"></script>
	<footer></footer>
	</body>
</html>
