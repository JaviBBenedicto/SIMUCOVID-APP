<?php

function conectar(){
	
	$servername = "*************";
	$username = "****************";
	$password = "****************";
	$dbname = "*******************";
	$conn = new mysqli($servername, $username, $password, $dbname);
	return $conn;
}
?>
