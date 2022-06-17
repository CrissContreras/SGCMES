<!Doctype html>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />

<html lang="es">

<head>
    <title>Registrarse</title>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
    <link rel="stylesheet" href="<?php echo base_url() . 'assets/vendor/toastr/toastr.min.css' ?>"">

    <script type=" text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.4.1.js' ?>">
    </script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.min.js' ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/all.js' ?>"></script>
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
            max-width: 100%;
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

<body >
    <?php
    if (validation_errors()) {
    ?>
        <script type="text/javascript">
            toastr.warning('<?php echo json_encode(validation_errors()); ?>');
        </script>
    <?php }
    ?>
    
    <div class="w-50 bg-light border rounded border-white">
        <form class="form-signin" id="registro_nuevo_paciente" method="post"">
            <div class="row text-center">
                <div class="col">
                <h2>Registro nuevo paciente</h2>
                </div>
            </div><hr>
            <div class="row">
                <div class="col">
                    <label>Nombres</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="col">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required >
                </div>
                
            </div><br>
            <div class="row">
                <div class="col">
                    <label>Tipo Identificación</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                        <label class="form-check-label" for="inlineRadio1">Cédula</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                        <label class="form-check-label" for="inlineRadio2">Ruc</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                        <label class="form-check-label" for="inlineRadio3">Passaporte</label>
                    </div>
                </div>
                <div class="col">
                    <label>Identificación</label>
                    <input type="text" maxlength="10" pattern="[0-9]{10}" class="form-control" id="identificacion" name="identificacion" placeholder="Ejemplo: 1718191615" required>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label>Nombre de usuario</label>
                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                </div>
                <div class="col">
                    <label>Contraseña</label>
                    <input type="text" class="form-control" id="contrasena" name="contrasena" required>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label>Correo electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" required placeholder="Ejemplo: juan@mail.com">
                </div>
                <div class="col">
                    <label>Télefono</label>
                    <input type="text" class="form-control" pattern="[0-9]{9,10}" id="telefono" name="telefono" required placeholder="Ejemplo: 0987654321">
                </div>
                <div class="col">
                    <label>Dirección</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" required>
                </div>
            </div><br>
            <div class="row">
                <div class="col">
                    <label>Ciudad de residencia</label>
                    <select class="form-control" id="ciudad_residencia" name="ciudad_residencia">
                        <option selected value="Quito">Quito</option>
                        <option value="Guayaquil">Guayaquil</option>
                        <option value="Cuenca">Cuenca</option>
                        <option value="Machala">Machala</option>
                        <option value="Ambato">Ambato</option>
                        <option value="Manta">Manta</option>
                        <option value="Santo Domingo">Santo Domingo</option>
                    </select>
                </div>
                <div class="col">
                    <label>Fecha de nacimiento</label>
                    <input type="date" max="<?php echo date('Y-m-d'); ?>" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
                <div class="col">
                    <label>Género</label>
                    <select class="form-control" id="genero" name="genero">
                        <option selected value="M" >Masculino</option>
                        <option value="F" >Femenino</option>
                    </select>
                </div>
            </div><br>
            <div class="row text-center">
                <div class="col"></div>
                <div class="col">
                    <button class="btn btn-round btn-primary btn-block" type="submit">Registrarse</button>
                </div>
                <div class="col"></div>
            </div><hr>
            <div class="row text-center">
                <div class="col-4">
                    <a class="btn btn-round btn-success" href="<?php echo base_url() ?>">Regresar al inicio</a>
                </div>
                <div class="col-8">
                    <h6 class="mt-2 mb-3 text-muted">Sistema General de Citas Médicas y Estadísticas de la Salud<h6>
                </div>
            </div>
            
        </form>
    </div>

    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/Registro.js' ?>"></script>
</body>

</html>