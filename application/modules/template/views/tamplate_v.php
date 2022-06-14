<!Doctype html>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<html>

<head>
    <title>App</title>

    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/font-awesome/css/font-awesome.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/animate-css/vivify.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/dropify/css/dropify.css' ?>">

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/c3/c3.min.css' ?>" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css' ?>" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css' ?>" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css' ?>" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/jvectormap/jquery-jvectormap-2.0.3.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/css/all.css' ?>" />
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/DataTables/datatables.min.css' ?>" />

    <link rel="stylesheet" href="<?php echo base_url() . 'assets/html/assets/css/site.min.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/toastr/toastr.min.css' ?>">

    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.4.1.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/toastr/toastr.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/push.min.js' ?>"></script>
    
</head>
<body id="bodyTema" class="theme-cyan light_version " onload="listMenu()">

    <!--Page Loader -->
    <div id="page-loader" class="page-loader-wrapper">
        <div class="loader">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
            <div class="bar4"></div>
            <div class="bar5"></div>
        </div>
    </div>

    <div class="overlay"></div>

    <div id="wrapper">

        <nav class="navbar top-navbar">
            <div class="container-fluid">

                <div class="navbar-left">
                    <div class="navbar-btn">
                        <a href="#"><img src="<?php echo base_url('assets/images/logo.svg') ?> " alt="Logo" class="img-fluid logo"></a>
                        <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
                    </div>
                    <ul class="nav navbar-nav">
                    <li class="p_blog">&nbsp&nbsp&nbsp<span style="font-size: 20px;" id="tituloPagina"></span></li>
                    </ul>
                </div>

                <div class="navbar-right">
                    <div id="navbar-menu">
                        <ul class="nav navbar-nav">
                        <li>
                        <div class="clock hidden-sm">
                            <span id="hours"></span> :
                            <span id="minutes"></span> :
                            <span id="seconds"></span>
                        </div>
                        </li>
                            <li><a href="<?php echo base_url('login/salir/' . $USUARIO_LOG_ID); ?>" class="icon-menu"><i class="icon-power"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="progress-container">
                <div class="progress-bar" id="myBar"></div>
            </div>
        </nav>
        <div id="megamenu" class="megamenu particles_js">
            <div id="particles-js"></div>
        </div>

        <div id="left-sidebar" class="sidebar ">
            <div class="navbar-brand">
                <a href="<?php echo base_url('administracion/Principal'); ?>"><img src="<?php echo base_url('assets/images/logo.svg'); ?>" alt="Logo" class="img-fluid logo"><span>SGCMES </span></a>
                <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="lnr lnr-menu icon-close"></i></button>
            </div>
            <div class="sidebar-scroll">
                <div class="user-account">
                    <div class="user_div">
                        <img onerror="imgError(this);" src="<?php echo base_url('assets/images/0.jpg'); ?>" alt="No hay Foto" class="user-photo">
                    </div>
                    <div class="dropdown">
                        <span id="bien">Bienvenido,</span><br>
                        <!--<span><strong><?php echo $USUARIO_LOGUEADO ?></strong></span>-->
                        <a><strong><?php echo $USUARIO_LOGUEADO ?></strong></a>
                    </div>
                </div>
                <nav id="left-sidebar-nav" class="sidebar-nav">
                <span class="text-muted">Menú</span>
                    <ul id="main-menu" class="metismenu">

                    </ul>
                    <ul class="metismenu">
                    
                    <li><a href="<?php echo base_url('login/salir/' . $USUARIO_LOG_ID); ?>"><i class="icon-power"></i><span>Salir</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>

        <div id="main-content">
            &nbsp;
            <div class="container-fluid">
                <?php
                $this->load->view($contenido);
                ?>
            </div>
        </div>
    </div>
 
    <!-- Javascript -->

    <script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/html/assets/bundles/libscripts.bundle.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/html/assets/bundles/vendorscripts.bundle.js' ?>"></script>

    <script type="text/javascript" src="<?php echo base_url() . 'assets/html/assets/bundles/c3.bundle.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/html/assets/bundles/jvectormap.bundle.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/html/assets/bundles/knob.bundle.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/html/assets/bundles/flotscripts.bundle.js' ?>"></script>

    <script type="text/javascript" src="<?php echo base_url() . 'assets/html/assets/bundles/mainscripts.bundle.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/html/assets/js/jobdashboard.js' ?>"></script>

    <script type="text/javascript" src="<?php echo base_url() . 'assets/DataTables/datatables.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/dropify/js/dropify.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/all.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/Template.js' ?>"></script>

    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/xlsx.full.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/FileSaver.js' ?>"></script>

</body>

</html>