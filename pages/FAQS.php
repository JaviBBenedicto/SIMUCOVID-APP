<?php
// Start the session
session_start();
require('../utils/conexion.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SimuCovid</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!--  Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Javier Blasco
  * SIMUCOVID 2021
  ======================================================== -->
</head>

<body>
  <?php
  #Miramos si esta logeado y tine permisos
    if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])|| $_SESSION['rol']=="administrador") {
     
    }else{
      #Si no esta logeado envia a index.php
      header("Location: ../index.php");
    }
  ?>
  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="../index.php" class="scrollto"><span>SimuCOVID</span></a></h1>
        <a href="#header" class="scrollto"></a>
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li><a href="../index.php">Inicio</a></li>
          <li><a href="experimento.php">Simulador</a></li>
        <?php
        #Mostramos navbar segun rol 
          if (isset($_SESSION['usuario'])){
            if($_SESSION['rol'] == 'editor'|| $_SESSION['rol'] == 'administrador'){  
                echo '<li class="nav-item">';
                echo  '<a class="nav-link" href="añadirVariantes.php">Añadir datos</a>';
                echo '</li>';
                }
                if($_SESSION['rol'] == 'administrador'){
                  echo '<li class="nav-item active">';
                  echo  '<a class="nav-link" href="#">FAQS</a>';
                  echo '</li>';
                  }
            } 
        
            if(isset($_SESSION['usuario'])){
              echo '<li class="nav-item">';
              echo' <a class="nav-link" href="../utils/logout.php">SALIR</a>';
              echo'</li>';
            }else{
              echo '<li class="nav-item">';
              echo' <a class="nav-link" href="form2.php">Login</a>';
              echo'</li>';
            }
        ?>
        </ul>
      </nav><!-- .main-nav -->

    </div>
  </header><!-- #header -->

  <main id="main">

    <!-- ======= Grid ======= -->
    <section id="about" class="about section-bg" >
      <div class="col-lg-7 col-md-6">
            <div class="about-content">
              
            </div>
      </div>
      <div class="container">
        <div class="row">
          <h4>Preguntas y quejas registradas</h4>
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Tema</th>
                <th scope="col">Mensaje</th>
              </tr>
            </thead>
            <tbody>
            <?php
            #Hacemos consulta y mostramos en tabla todos los registros
            $conn = conectar();
            if ($conn->connect_error) {
             die("Connection failed: " . $conn->connect_error);
            }else{
              $sql = "SELECT * FROM faqs";
              $resultado=mysqli_query($conn,$sql) or die ('Error en el query database');
              $count = 1;
              while($elemento = $resultado->fetch_assoc()){
                echo '<tr>';
                echo '<th scope="row">'.$count.'</th>';
                echo '<td>'.$elemento["name"].'</th>';
                echo '<td>'.$elemento["email"].'</th>';
                echo '<td>'.$elemento["subject"].'</th>';
                echo '<td>'.$elemento["message"].'</th>';
                echo '</tr>';
                $count = $count +1 ; 
              } 
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>

    </section>
    <!-- End Grid -->
  <!-- ======= Footer ======= -->
  <footer id="footer" class="section-bg">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>SimuCovid</strong>. All Rights Reserved
      </div>
      <div class="credits">
  
        Designed by JBB
      </div>
    </div>
  </footer><!-- End  Footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/venobox/venobox.min.js"></script>
  <script src="../assets/vendor/mobile-nav/mobile-nav.js"></script>
  <script src="../assets/vendor/counterup/counterup.min.js"></script>
  <script src="../assets/vendor/wow/wow.min.js"></script>
  <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>

  <!--  Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>