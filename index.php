<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>Proyecto Desarrollo Web I</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-breezed.css">
    <link rel="stylesheet" href="assets/css/owl-carousel.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
</head>   
<body>
  
<?php 
       

    session_start();

    if (!isset($_SESSION['username'])) {  
        //Si no hay sesión iniciada la destruye
        $_SESSION = null;  
        session_destroy();
    } 

    include('includes/header.php'); 
?>

    <!-- ***** Search Area ***** -->
    <div id="search">
        <button type="button" class="close">×</button>
        <form id="contact" action="#" method="get">
            <fieldset>
                <input type="search" name="q" placeholder="SEARCH KEYWORD(s)" aria-label="Search through site content">
            </fieldset>
            <fieldset>
                <button type="submit" class="main-button">Search</button>
            </fieldset>
        </form>
    </div>

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner header-text" id="top">
        <div class="Modern-Slider">
          <!-- Item -->
          <div class="item">
            <div class="img-fill">
                <img src="assets/images/slide-01.jpg" alt="">
                <div class="text-content">
                  <h3>Bienvenido</h3>
                  <h5>Mesa de Servicios - Soluciones Rápidas</h5>
                  <a href="login.php" class="main-stroked-button">Iniciar Sesión</a>
                </div>
            </div>
          </div>
          <!-- // Item -->
          <!-- Item -->
          <div class="item">
            <div class="img-fill">
                <img src="assets/images/slide-02.jpg" alt="">
                <div class="text-content">
                  <h3>Soluciones Inmediatas</h3>
                  <h5>Cuéntanos tu requerimiento</h5>
                  <a href="login.php" class="main-filled-button">Iniciar Sesión</a>
                </div>
            </div>
          </div>
          <!-- // Item -->
          <!-- Item -->
          <div class="item">
            <div class="img-fill">
                <img src="assets/images/slide-03.jpg" alt="">
                <div class="text-content">
                  <h3>Somos lideres en Latinoamérica</h3>
                  <h5>Nuestra empresa está comprometida con la calidad</h5>
                  <a href="#about" class="main-stroked-button">Sobre nosotros</a>
                </div>
            </div>
          </div>
          <!-- // Item -->
        </div>
    </div>
    <div class="scroll-down scroll-to-section"><a href="#about"><i class="fa fa-arrow-down"></i></a></div>
    <!-- ***** Main Banner Area End ***** -->

    <!-- ***** About Area Starts ***** -->
    <section class="section" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="left-text-content">
                        <div class="section-heading">
                            <h6>Sobre Nosotros</h6>
                            <h2>Trabajamos con los mejores técnicos de soporte</h2>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <div class="service-item">
                                    <img src="assets/images/service-item-01.png" alt="">
                                    <h4>Rapidez</h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="service-item">
                                    <img src="assets/images/service-item-01.png" alt="">
                                    <h4>Eficacia</h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="service-item">
                                    <img src="assets/images/contact-info-03.png" alt="">
                                    <h4>Nacional</h4>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="service-item">
                                    <img src="assets/images/contact-info-03.png" alt="">
                                    <h4>Internacional</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-12">
                    <div class="right-text-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum. 
                        <br><br>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** About Area Ends ***** -->
    <?php include('includes/footer.php'); ?>  
