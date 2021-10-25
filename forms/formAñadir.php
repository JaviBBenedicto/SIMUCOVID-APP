<?php
require('../utils/conexion.php');
$conn = conectar();
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
      }else{
      	$nombre = $_POST['nombre'];
		$descripcion = $_POST['descripcion'];
		$exp = $_POST['exp'];
		$año = $_POST['año'];
		$pais = $_POST['pais'];

		$sql = "INSERT INTO covid (nombre,descripcion,exp,año,pais) VALUES ('$nombre','$descripcion','$exp','$año','$pais')";

			if (mysqli_query($conn, $sql)) {
     		 header("Location:../pages/añadirVariantes.php");
			} else {
      			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);


      }

?>
