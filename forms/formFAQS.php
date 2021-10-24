 <!-- Send message to BD -->
<?php
require('../utils/conexion.php');
$conn = conectar();
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
      }else{
      	$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		

		$sql = "INSERT INTO faqs (name,email,subject,message) VALUES ('$name','$email','$subject','$message')";

			if (mysqli_query($conn, $sql)) {

				header('msg=OK');

			} else {
      			echo "prrr: " . $sql . "<br>" . mysqli_error($conn);
			}
			mysqli_close($conn);


      }

?>