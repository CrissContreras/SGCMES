<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Inicio</title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?php echo base_url() . 'assets/lib/vendor/bootstrap/css/bootstrap.min.css' ?>" rel="stylesheet">
  <link href="<?php echo base_url() . 'assets/lib/vendor/remixicon/remixicon.css' ?>" rel="stylesheet">

  <link href="<?php echo base_url() . 'assets/lib/css/style.css' ?>" rel="stylesheet">
</head>

<body>

  <header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center justify-content-between">

      <h1 class="logo"><a href="<?php echo base_url() ?>"><img src="<?php echo base_url() . 'assets/images/logo.svg' ?>" width="50" height="50"> SGCMES</a></h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="<?php echo base_url() ?>">Inicio</a></li>
          <li><a class="nav-link scrollto" href="<?php echo base_url() . 'login' ?>">Iniciar Sesión</a></li>
          <li><a class="getstarted scrollto" href="<?php echo base_url() . 'registro' ?>">Registrarse</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav>

    </div>
  </header>

  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-2 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>Sistema General de Citas Médicas y Estadísticas de la Salud</h1>
          <ul>
            <li><i class="ri-check-line"></i> Programación de citas</li>
            <li><i class="ri-check-line"></i> Gestión de médicos y pacientes</li>
            <li><i class="ri-check-line"></i> Historial clínico</li>
          </ul>
          <div class="mt-3">
            <a href="<?php echo base_url() . 'login' ?>"" class="btn-get-started scrollto">Iniciar Sesión</a>
            <a href="<?php echo base_url() . 'registro' ?>"" class="btn-get-quote">Registrarse</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img src="assets/images/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section>

  <footer id="footer">

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
        Sistema General de Citas Médicas y Estadísticas de la Salud <strong>by Cristina Contreras</strong>
        </div>
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

</html>