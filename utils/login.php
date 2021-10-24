

<?php
// Start the session
session_start();
require('conexion.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login php</title>
</head>
<body>
<?php

$login = $_POST['login'];
$pass = $_POST['password'];
// echo $login . " " . $pass;
$_SESSION ["login"] = $login;

$conn = conectar();

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
else
{
   echo "Conectado correctamente";
   $sql = "SELECT nombre, apellido, login, password, rol FROM autentificacion WHERE login LIKE '$login' AND password LIKE '$pass'";
   
   echo $sql;

   $result = $conn->query($sql);
   
   if ($result->num_rows > 0) {
  // output data of each row
    $row = $result->fetch_assoc();
	$_SESSION ["usuario"] = $row['nombre'] . "," . $row['apellido'];
	$_SESSION ["rol"] = $row['rol'];
}
 else {
  echo "0 results";
}
   
   
}

header("Location: ../index.php");


?>

</body>
</html>