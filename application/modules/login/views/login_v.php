<!Doctype html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />

<html lang="es">

<head>
    <title>Login</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/toastr/toastr.min.css' ?>"">

    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.4.1.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/all.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap-show-password.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/vendor/toastr/toastr.js' ?>"></script>
    
    <style>
        html,
        body {
            height: 100%
        }

        body {
            display: -ms-flexbox;
            display: -webkit-box;
            display: flex;
            -ms-flex-align: center;
            -ms-flex-pack: center;
            -webkit-box-align: center;
            align-items: center;
            -webkit-box-pack: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.06);
        }

        .background {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: -1;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }
    </style>
</head>

<body class="text-center">
    <?php
        if (validation_errors()) {
            ?>
                <script type="text/javascript">
                    toastr.warning('<?php echo json_encode(validation_errors()); ?>');
                </script>
            <?php }
    ?>
    <form class="form-signin" action="<?php echo base_url('login') ?>" method="POST" enctype="multipart/form-data">
        <img class="mb-4" src="<?php echo base_url() . 'assets/images/logo.svg' ?>" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesión</h1><br>
        <label class="sr-only">Usuario</label>
        <input type="text" id="userLogin" autocomplete="username" name="userLogin" class="form-control" placeholder="Usuario" required autofocus><br>
        <label class="sr-only">Contraseña</label>
        <input type="password" id="passLogin" autocomplete="current-password" name="passLogin" class="form-control" placeholder="Contraseña" data-toggle="password" required>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
        <br><br>
        <a class="btn btn-success" href="<?php echo base_url() ?>">Regresar al inicio</a>
        <h6 class="mt-5 mb-3 text-muted">Sistema General de Citas Médicas y Estadísticas de la Salud<h6>
    </form>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/Login.js' ?>"></script>
</body>

</html>