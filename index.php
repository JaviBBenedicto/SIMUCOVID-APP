<?php
// Start the session
session_start();
require('utils/conexion.php');
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
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">


  <!--  Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Author: Javier Blasco 
  * SIMUCOVID 2021
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header">

    <div id="topbar">
      <div class="container">
        <div class="social-links">
          <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
          <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
          <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
          <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
        </div>
      </div>
    </div>

    <div class="container">

      <div class="logo float-left">
 
        <h1 class="text-light"><a href="index.php" class="scrollto"><span>SimuCOVID</span></a></h1>

      </div>

      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="#">Inicio</a></li>
          <li><a href="pages/experimento.php">Simulador</a></li>
        <?php
        #Codigo para mostrar pestañas en el navbar, dependiendo si estamos logeados y del rol del logueado.
        #Se mostraran diferentes pestañas
          if (isset($_SESSION['usuario'])){
            if($_SESSION['rol'] == 'editor'|| $_SESSION['rol'] == 'administrador'){  
                echo '<li class="nav-item">';
                echo  '<a class="nav-link" href="pages/añadirVariantes.php">Añadir datos</a>';
                echo '</li>';
                }
                if($_SESSION['rol'] == 'administrador'){
                  echo '<li class="nav-item">';
                  echo  '<a class="nav-link" href="pages/FAQS.php">FAQS</a>';
                  echo '</li>';
                  }
            } 
        
            if(isset($_SESSION['usuario'])){
              echo '<li class="nav-item">';
              echo' <a class="nav-link" href="utils/logout.php">SALIR</a>';
              echo'</li>';
            }else{
              echo '<li class="nav-item">';
              echo' <a class="nav-link" href="forms/form2.php">Login</a>';
              echo'</li>';
            }
        ?>
        </ul>
      </nav><!-- .main-nav -->

    </div>
  </header><!-- #header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="clearfix">
    <div class="container d-flex h-100">
      <div class="row justify-content-center align-self-center">
        <div class="col-md-6 intro-info order-md-first order-last">
          <h2>Un simulador<br>intuitivo de<span> COVID-19</span></h2>
          <div>
            <a href="pages/experimento.php" class="btn-get-started scrollto">Empieza ahora</a>
          </div>
        </div>

        <div class="col-md-6 intro-img order-md-last order-first">
          <img src="assets/img/intro-img.svg" alt="" class="img-fluid">
        </div>
      </div>

    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container">
        <div class="row">

          <div class="col-lg-5 col-md-6">
            <div class="about-img">
              <img src="assets/img/about-img.jpg" alt="">
            </div>
          </div>

          <div class="col-lg-7 col-md-6">
            <div class="about-content">
              <h2>Que és SimuCovid ?</h2>
              <h3>El simulador fácil e intuitivo apto para todos los públicos.</h3>
              <p>Debido a la situación de alarma mundial causada por el virus SARS-CoV-2, des de SimuCovid hemos querido ofrecer a todos los públicos una herramienta gratuita de simulación de situaciones de contagio del virus SARS-CoV-2 en espacios cerrados.</p>
              <p>Con esta herramienta lo que se busca es que los usuarios puedan experimentar con diferentes situaciones de exposición, las cuales podrán ayudar a crear medidas de distanciamiento en espacios cerrados, para que así el indice de contagio y la exposición de las personas al virus sea la menor posible.</p>
              <p>Algunas de las características de SimuCovid son:</p>
              <ul>
                <li><i class="ion-android-checkmark-circle"></i> Simula en diferentes espacios.</li>
                <li><i class="ion-android-checkmark-circle"></i> Asigna de forma personalizada la carga y el numero de sujetos.</li>
                <li><i class="ion-android-checkmark-circle"></i> Elige la variante que más desees para experimentar.</li>
                <li><i class="ion-android-checkmark-circle"></i> Una vez finalizada la simulación podras ver y descargar los resultados.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </section><!-- End About Section -->
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container">

        <header class="section-header">
          <h3 class="section-title">Variantes</h3>
          <p>Variantes con las que podras simular.</p>
        </header>

        <div class="row">
          <div class="col-lg-12">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">Todas</li>
              <li data-filter=".filter-app">2020</li>
              <li data-filter=".filter-card">2021</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">

          <!--parte php-->
          <?php
          #Obtenemos todas la varaintes de la base de datos y las mostramos
        $conn = conectar();
        if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
          }else{
             $sql = "SELECT * FROM covid";
            $resultado=mysqli_query($conn,$sql) or die ('Error en el query database');  
            while($elemento = $resultado->fetch_assoc())
            {

              $año = $elemento["año"];
              $tag = "";
              $img = 0;
              if($año == "2020"){
                $tag = "filter-app";
                $img = 1;
              }else{
                $tag = "filter-card";
              }
              echo'<div class="col-lg-3 col-md-6 portfolio-item '.$tag.'">';
              echo'<div class="portfolio-wrap">';
              if($img == 1){
                 echo'<img src="assets/img/portfolio/virus2.jpg" class="img-fluid" alt="">';
              }else{
                 echo'<img src="assets/img/portfolio/virus.jpg" class="img-fluid" alt="">';
              }
              echo'<div class="portfolio-info">';
              echo"<h4><a>".$elemento["nombre"]."</a></h4>";
              echo"<p>".$elemento["descripcion"]."</p>";
              echo"<p>".$elemento["exp"]."</p>";
              echo"<p>".$elemento["año"]."</p>";
              echo"<p>".$elemento["pais"]."</p>";
              echo"</div>";
              echo"</div>";
              echo"</div>";
            }
          }
        ?>  

        </div>

      </div>
    </section><!-- End Portfolio Section -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="section-bg">
    <div class="footer-top">
      <div class="container">

        <div class="row">

          <div class="col-lg-6">

            <div class="row">

              <div class="col-sm-6">

                <div class="footer-info">
                  <h3>SimuCovid</h3>
                  <p>SimuCovid es una empresa de desarrollo privada, la cual quiere brindar de forma gratuita y altruista todas las herramientas necesarias para ayudar a combatir el virus SARS-CoV-2.</p>
                </div>

                <div class="footer-newsletter">
                  <h4>Nuestras noticias</h4>
                  <p>Suscríbete para no perderte ninguna de nuestras novedades o información.</p>
                  <form action="" method="post">
                    <input type="email" name="email"><input type="submit" value="Subscríbete">
                  </form>
                </div>

              </div>

              <div class="col-sm-6">
                <div class="footer-links">
                  <h4>Links de utilidad</h4>
                  <ul>
                    <li><a href="#">Inicio</a></li>
                    <li><a href="#about">Quien somos?</a></li>
                    <li><a href="pages/experimento.php">Simulador</a></li>
                  </ul>
                </div>

                <div class="footer-links">
                  <h4>Contacta con nosotros</h4>
                  <p>
                    Institut la Guinaueta<br>
                    Carrer de l'Artesania, 55<br>
                    Barcelona<br>
                    <strong>Teléfono:</strong> 933 593 404<br>
                    <strong>Email:</strong> a8034205@xtec.cat<br>
                  </p>
                </div>

                <div class="social-links">
                  <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                  <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                  <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                  <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                </div>

              </div>

            </div>

          </div>

          <div class="col-lg-6">

            <div class="form">
              <!--Formulario FAQS -->
              <h4>Envianos un mensaje</h4>
              <p>Rellena el formulario con tus dudas o quejas y te responderemos lo antes posible.</p>
              <form action="forms/formFAQS.php" method="post" role="form" class="php-email-form">
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" data-rule="minlen:4" data-msg="Como mínimo 4 caracteres." />
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Porfavor utiliza un email valido." />
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Tema" data-rule="minlen:4" data-msg="Como mínimo ha de ser de 8 caracteres." />
                  <div class="validate"></div>
                </div>
                <div class="form-group">
                  <textarea type="" class="form-control" name="message" rows="5" data-rule="required" data-msg="Porfavor escibe un mensaje." placeholder="Mensaje"></textarea>
                  <div class="validate"></div>
                </div>

                <div class="mb-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>

                <div class="text-center"><button type="submit" title="Send Message">Enviar mensaje</button></div>
              </form>

            </div>

          </div>

        </div>

      </div>
    </div>

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
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/mobile-nav/mobile-nav.js"></script>
  <script src="assets/vendor/wow/wow.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>

  <!--  Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>