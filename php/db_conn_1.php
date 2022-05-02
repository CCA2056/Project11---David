<?php
//connect to mysql
$mysqli = new mysqli('localhost', 'project11', 'ToorToor1', 'projecttestdb');

if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}
?>