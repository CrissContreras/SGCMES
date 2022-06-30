<div id="infoMessage"><?php echo $this->session->flashdata('message'); ?></div>
<input type="text" name="baseUrl" hidden id="baseUrl" value="<?php echo base_url() . 'administracion/Usuarios' ?>">
<div class="table-responsive">
    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addUserModal" data-whatever="@mdo"><span class="fa fa-plus"></span> Nuevo</button>
    <table class="table header-border table-hover table-custom spacing5 text-center" style="width:100%" id="tableListUsuarios">
        <thead>
            <tr>
                <th><strong>Id</strong></th>
                <th><strong>Nombres</strong></th>
                <th><strong>Apellido</strong></th>
                <th><strong>Identificación</strong></th>
                <th><strong>Usuario</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Rol</strong></th>
                <th><strong>Estado</strong></th>
                <th><i class="fa fa-cog"></i></th>
            </tr>
        </thead>
        <tbody id="listUsuarios">
        </tbody>
    </table>
</div>

<form id="saveUserForm" method="post">
    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Nombres</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="col">
                            <label>Apellidos</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" required>
                        </div>
                        <div class="col">
                            <label>Tipo de identificación</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipoIdentificacion" id="tipoIdentificacion1" value="C" checked>
                                <label class="form-check-label" for="tipoIdentificacion1">
                                    Cédula
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipoIdentificacion" id="tipoIdentificacion2" value="R">
                                <label class="form-check-label" for="tipoIdentificacion2">
                                    Ruc
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipoIdentificacion" id="tipoIdentificacion3" value="P">
                                <label class="form-check-label" for="tipoIdentificacion3">
                                    Passaporte
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Identificación</label>
                            <input type="text" maxlength="10" class="form-control" id="identificacion" name="identificacion" placeholder="Ejemplo: 1718191615" required>
                        </div>
                        <div class="col">
                            <label>Nombre de usuario</label>
                            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
                        </div>
                        <div class="col">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
                        </div>
                    </div>
                    <div class="form-group row">
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
                    </div>
                    <div class="form-group row">
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
                                <option selected value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Rol</label>
                            <select class="form-control" id="id_Rol" name="id_Rol" onchange="fn_validarRol('n')">
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="divEspecialidad">
                        <div class="col">
                            <label>Especialidad</label>
                            <select class="form-control" id="id_especialidad" name="id_especialidad" multiple>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="showUserForm" method="post">
    <div class="modal fade" id="showUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Datos del Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            Nombre y Apellido
                            <input type="text" name="shownombreUsuario" id="shownombreUsuario" class="form-control" disabled>
                        </div>
                        <div class="col">
                            Nick de Usuario
                            <input type="text" name="shownickUsuario" id="shownickUsuario" class="form-control" disabled>
                        </div>
                        <div class="col">
                            Correo electrónico
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="email" name="showmailUsuario" id="showmailUsuario" class="form-control" placeholder="ej: usuario@mail.com" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            Estado
                            <select name="showestadoUsuario" id="showestadoUsuario" class="form-control" disabled>
                                <option value="">-Seleccione Estado-</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="col">
                            Rol
                            <select name="showrolUsuario" id="showrolUsuario" class="form-control" disabled>

                            </select>
                        </div>
                        <div class="col">
                            Contraseña
                            <input type="text" name="showpassUsuario" id="showpassUsuario" class="form-control" placeholder="Contraseña" disabled>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="editUserForm" method="post">
    <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Usuario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Nombres</label>
                            <input type="text" class="form-control" id="editnombre" name="editnombre" required>
                        </div>
                        <div class="col">
                            <label>Apellidos</label>
                            <input type="text" class="form-control" id="editapellido" name="editapellido" required>
                        </div>
                        <div class="col">
                            <label>Tipo de identificación</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edittipo_identificacion" id="edittipo_identificacion" value="C" checked>
                                <label class="form-check-label" for="edittipo_identificacion">
                                    Cédula
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edittipo_identificacion" id="edittipo_identificacion2" value="R">
                                <label class="form-check-label" for="edittipo_identificacion2">
                                    Ruc
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="edittipo_identificacion" id="edittipo_identificacion3" value="P">
                                <label class="form-check-label" for="edittipo_identificacion3">
                                    Passaporte
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Identificación</label>
                            <input type="text" maxlength="10" class="form-control" id="editidentificacion" name="editidentificacion" placeholder="Ejemplo: 1718191615" required>
                        </div>
                        <div class="col">
                            <label>Nombre de usuario</label>
                            <input type="text" class="form-control" id="editnombre_usuario" name="editnombre_usuario" required>
                        </div>
                        <div class="col">
                            <label>Contraseña</label>
                            <input type="password" class="form-control" id="editcontrasena" name="editcontrasena">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Correo electrónico</label>
                            <input type="email" class="form-control" id="editcorreo" name="editcorreo" required placeholder="Ejemplo: juan@mail.com">
                        </div>
                        <div class="col">
                            <label>Télefono</label>
                            <input type="text" class="form-control" pattern="[0-9]{9,10}" id="edittelefono" name="edittelefono" required placeholder="Ejemplo: 0987654321">
                        </div>
                        <div class="col">
                            <label>Dirección</label>
                            <input type="text" class="form-control" id="editdireccion" name="editdireccion" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Ciudad de residencia</label>
                            <select class="form-control" id="editciudad_residencia" name="editciudad_residencia">
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
                            <input type="date" max="<?php echo date('Y-m-d'); ?>" class="form-control" id="editfecha_nacimiento" name="editfecha_nacimiento" required>
                        </div>
                        <div class="col">
                            <label>Género</label>
                            <select class="form-control" id="editgenero" name="editgenero">
                                <option selected value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <label>Rol</label>
                            <select class="form-control" id="editid_rol" name="editid_rol" onchange="fn_validarRol('m')">
                            </select>
                        </div>
                    </div>
                    <div id="divEditEspecialidad">
                        <div class="form-group row" id="divEditEspecialidad">
                            <div class="col">
                                <label>Especialidad</label>
                                <select class="form-control" id="editid_especialidad" name="editid_especialidad" multiple>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="editIdUsuario" id="editIdUsuario" class="form-control">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="deleteUserForm" method="post">
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">Estás seguro de eliminar?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <label class="label label-default" name="deleteUserNombre" id="deleteUserNombre"></label>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="deleteUserId" id="deleteUserId" class="form-control">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success btn-sm">Si</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="saverel_horario_medicoForm" method="post">
    <div class="modal fade" id="editrel_horario_medicoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Horario del Médico</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Nombres</label>
                            <input type="text" class="form-control" id="nombremedico" name="nombremedico" required>
                        </div>
                        <div class="col">
                            <label>Apellidos</label>
                            <input type="text" class="form-control" id="apellidomedico" name="apellidomedico" required>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label>Horario</label>
                                <select class="form-control" id="editrel_horario_medico" name="editrel_horario_medico" multiple>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="IdUsuarioHorario" id="IdUsuarioHorario" class="form-control">
                        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
</form>

<script type="text/javascript" src="<?php echo base_url() . 'assets/js/Usuarios.js' ?>"></script>