<?php
	include 'include.php';
	
	function insert_to_diary ($uid, $rid, $fid, $delish, $fdadded) {
		if (is_int($uid) && is_int($rid) && is_int($fid) && strlen($delish) == 1 && strtotime($fadded)) {
			$query = pg_prepare($dbconn, "diary_insert", 'INSERT INTO fooddiaries VALUES $1, $2, $3, $4, $5');
			$result = pg_execute($dbconn, "diary_insert", array($uid, $rid, $fid, $delish, $fadded));
			return $result;
		}
		return false;
	}
	
	function insert_to_foods ($rid, $fid, $fname, $fdesc) {
		if (is_int($rid) && is_int($fid)) {
			$query = pg_prepare($dbconn, "food_insert", 'INSERT INTO foods VALUES $1, $2, $3, $4');
			$result = pg_execute($dbconn, "food_insert", array($rid, $fid, $fname, $fdesc));
			return $result;
		}
		return false;
	}
	
	function insert_to_suggestions ($uid, $rid, $fid, $sadded) {
		if (if_int($uid) && if_int(rif) && if_int($fid) && strtotime($sadded)) {
			$query = pg_prepare($dbconn, "suggestion_insert", 'INSERT INTO suggestions VALUES $1, $2, $3, $4');
			$result = pg_execute($dbconn, "suggestion_insert", array($uid, $rid, $fid, $sadded));
			return $result;
		}
		return false;
	}
	
	//see if this friendship is there already
	function duplicate_friend ($sender, $receiver) {
		$query = pg_prepare($dbconn, "find_duplicate", 'SELECT COUNT(sender) FROM friends WHERE sender = $1 AND receiver = $2');
		$result = pg_execute($dbconn, "find_duplicate", array($sender, $receiver));
		return ($result != 0);
	}
	
	/*
	function insert_to_friends ($sender, $receiver) {
		if (is_int($sender) && is_int($receiver)) {
			if ($sender != $receiver && !duplicate_friend($sender, $receiver)) {
				$query = pg_prepare($dbconn, "friends_insert", 'INSERT INTO friends VALUES $1, $2');
				$result = pg_execute($dbconn, "friends_insert", array($sender, $receiver));
				return $result;
			}
		}
		return false;
	}	
	*/
	
	function insert_to_friends ($sender, $receiver) {
		$query = pg_prepare($dbconn, "friends_insert", 'INSERT INTO friends (sender, receiver) VALUES $1, $2');
		$result = pg_execute($dbconn, "friends_insert", array($sender, $receiver));
		return $result;
	}
	
	?>