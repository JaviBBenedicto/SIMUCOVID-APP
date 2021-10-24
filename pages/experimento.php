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

  <title>SimuCOVID</title>
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

  <!--SIMULADOR -->
  <script src="../assets/js/simulador/p5.js"></script>
  <script src="../assets/js/simulador/sketch.js"></script>
  <!--PDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
  <script src="../assets/js/simulador/pdf.js"></script>
  <!--GRAFICAS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="../assets/js/simulador/graficar.js"></script>

  <!-- =======================================================
  * Author: Javier Blasco
  * SIMUCOVID 2021
  ======================================================== -->

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">

      <div class="logo float-left">
        <h1 class="text-light"><a href="../index.php" class="scrollto"><span>SimuCOVID</span></a></h1>
        
      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li><a href="../index.php">Inicio</a></li>
          <li class="active"><a href="#">Simulador</a></li>
        <?php
        #Mostrar nav segun usuario
          if (isset($_SESSION['usuario'])){
            if($_SESSION['rol'] == 'editor'|| $_SESSION['rol'] == 'administrador'){  
                echo '<li class="nav-item">';
                echo  '<a class="nav-link" href="añadirVariantes.php">Añadir datos</a>';
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

    <!-- ======= Simulator Section ======= -->
    <section  class="about section-bg" >
      <div class="container text-center" id="experimentsec">
        <div class="container">
          <div id="experimental">
            <div id="canvas">
            <div id="form1">
              <input id="cx" type="number" name="cx" value="900">
              <input id="cy" type="number" name="cy" value="500">
              <button type="button" onClick=caja()>Tamaño caja</button>
            </div>
            </div>

            <div id="divCa">
              <?php
              #obtener las variantes para obtener la carga virica
              $conn = conectar();
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }else{
                $sql = "SELECT * FROM covid";
                $resultado=mysqli_query($conn,$sql) or die ('Error en el query database'); 
                echo '<select id="carga" onchange="nombre()">';
                while($elemento = $resultado->fetch_assoc()){
                  echo '<option value="'.$elemento["exp"].'">'.$elemento["nombre"].'</option>';
                }
                echo '</select>';
              }
              ?>
              <p id="cargaNombre"></p>
            </div>
            <div id="impnum">
              <input id="numero" type="number" name="" value="2">
              <button type="button" onClick=numBolas()>Automatico</button>
              <button type="button" onClick=prueba()>Manual</button>
            </div>
            <div id="form"></div>
            <div id = "divs"></div>
            <h2 id='clock'>00:00:00</h2>
            <div id = "inf"></div>
            <div id="panic" style="display: none">
              <button type="button" onClick=panic()>Parar experimento</button>
              <button type="button" onClick=reStart()>Reset</button>
            </div>
            <div id="descargar" style="display: none">
              <h5>Quieres descargar los resultados ?</h5>
              <button type="button" onClick="btndownload()">Descargar</button>
              <button type="button" onClick=reStart()>Reset</button>
            </div>
            <div id="experimental"></div>
            <div id="grafica"></div>
          </div>
        </div>
      </div>

    </section><!-- End Simulator Section -->

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

  <!--  JS Files -->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="../assets/vendor/venobox/venobox.min.js"></script>
  <script src="../assets/vendor/mobile-nav/mobile-nav.js"></script>
  <script src="../assets/vendor/counterup/counterup.min.js"></script>
  <script src="../assets/vendor/wow/wow.min.js"></script>
  <script src="../assets/vendor/waypoints/jquery.waypoints.min.js"></script>

  <!--  Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>
<!-- Script to show the covid variants -->
<script>
  //mostrar la carga del valor seleccionado
  function nombre(){
    let carga = document.getElementById("carga").value;
    let string = "Carga infectado: "+str(carga);
    let info = document.getElementById("cargaNombre").innerHTML = string;
  }
</script>

</html>