<?php
	ob_start();
	session_start();
	$timezone = date_default_timezone_set("Europe/London");
	define('SETURL', 'http://localhost/music-streaming-project/');
	$con = mysqli_connect("localhost", "root", "", "geet");
	if(mysqli_connect_errno()) {
		echo "Failed to connect: " . mysqli_connect_errno();
	}
?>