<?php

  session_start();

//file to create all the tables in the database
  function check($queryResult) {
    if (!$queryResult) {
      die();
    }
  }


  $dbconn = pg_connect("dbname=postgres user=postgres password=password");

  check($dbconn);

	$stmt1 = 'SET search_path TO suspref';
	$result = pg_query($dbconn, $stmt1);
	check($dbconn);

?>

