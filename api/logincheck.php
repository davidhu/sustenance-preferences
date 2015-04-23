<?php
	if (!isset($_SESSION["uid"])) {
		header('Location: index.php');
	}
?>