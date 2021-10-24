<?php

function conectar(){
	#$servername = "localhost";
	#$username = "miaplicacion";
	#$password = "miaplicacion";
	#$dbname = "miaplicacion";

	$servername = "bswfhyhurmgadcbjofpa-mysql.services.clever-cloud.com";
	$username = "u7ihnxsxcwprnh7p";
	$password = "oc7fN6kLZK8QQuXia0S2";
	$dbname = "bswfhyhurmgadcbjofpa";
	$conn = new mysqli($servername, $username, $password, $dbname);
	return $conn;
}
?>