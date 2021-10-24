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
  * Author: Javier Blasco
  * SIMUCOVID 2021
  ======================================================== -->
</head>

<body>
  <?php
  #miramos si esta logeado y si el usuario tiene permisopara acceder a la pagina
    if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])|| $_SESSION['rol']=="administrador") {
      
    }else{
      #Si no tiene permiso carga index.php
      header("Location: ../index.php");
    }
  ?>
  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">

      <div class="logo float-left">
       
        <h1 class="text-light"><a href="../index.php" class="scrollto"><span>SimuCOVID</span></a></h1>
        <a href="../index.php" class="scrollto"></a> 
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li><a href="../index.php">Inicio</a></li>
          <li><a href="experimento.php">Simulador</a></li>
        <?php
        #Mostramos nav segun rol 
          if (isset($_SESSION['usuario'])){
            if($_SESSION['rol'] == 'editor'|| $_SESSION['rol'] == 'administrador'){  
                echo '<li class="nav-item active">';
                echo  '<a class="nav-link" href="#">Añadir datos</a>';
                echo '</li>';
                }
                if($_SESSION['rol'] == 'administrador'){
                  echo '<li class="nav-item">';
                  echo  '<a class="nav-link" href="FAQS.php">FAQS</a>';
                  echo '</li>';
                  }
            } 
        
            if(isset($_SESSION['usuario'])){
              echo '<li class="nav-item">';
              echo' <a class="nav-link" href="../utils/logout.php">SALIR</a>';
              echo'</li>';
            }else{
              echo '<li class="nav-item">';
              echo' <a class="nav-link" href="../forms/form2.php">Login</a>';
              echo'</li>';
            }
        ?>
        </ul>
      </nav><!-- .main-nav -->

    </div>
  </header><!-- #header -->

  <main id="main">

    <!-- ======= Form Section ======= -->
    <section id="about" class="about section-bg" >

      <section id="about" class="about section-bg" >

      <div class="container">
        <div class="row">
          <div class="col-sm-3 container" >
            <h5>Añadir nueva variante</h5>
            <form action="../forms/formAñadir.php" method="post">
              <label >Nombre:</label><br>
              <p><textarea id="nombre" name="nombre" cols="40" rows="1"></textarea></p>
              <label>Descripción:</label><br>
              <p><textarea id="descripcion" name="descripcion" cols="40" rows="5" ></textarea></p>
               <label>Exp:</label><br>
              <input type="number" id="exp" name="exp"><br><br>
               <label>Año:</label><br>
              <input type="text" id="año" name="año"><br><br>
               <label>País:</label><br>
              <p><textarea id="pais" name="pais" cols="40" rows="1" ></textarea></p><br><br>
              <input type="submit" value="Añadir">
            </form>
          </div>

        </div>
      </div>

    </section><!-- End Form Section -->
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