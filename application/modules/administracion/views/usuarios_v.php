<div id="infoMessage"><?php echo $this->session->flashdata('message'); ?></div>

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
                             Nombre y Apellido
                            <input type="text" name="nombreUsuario" id="nombreUsuario" class="form-control" required>
                        </div>
                        <div class="col">
                             Nick de Usuario
                            <input type="text" onclick="generarNick()" name="nickUsuario" id="nickUsuario" class="form-control" required>
                        </div>
                        <div class="col">
                             Correo electrónico
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="email" name="mailUsuario" id="mailUsuario" class="form-control" placeholder="ej: usuario@mail.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                             Estado
                            <select name="estadoUsuario" id="estadoUsuario" class="form-control" required>
                                <option value="">-Seleccione Estado-</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="col">
                             Rol
                            <select name="rolUsuario" id="rolUsuario" class="form-control" required>

                            </select>
                        </div>
                        <div class="col">
                             Contraseña
                            <input type="text" name="passUsuario" id="passUsuario" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
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
                    <button type="button"  class="btn btn-info btn-sm" data-dismiss="modal">Cerrar</button>
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
                    <div class="form-group row d-flex justify-content-center">
                        <div class="col-5 ">
                            <div class="input-group">
                                <label class="input-group-btn">
                                    <span class="btn btn-primary">
                                        Elegir foto&hellip;<input accept=".jpg" type="file" id="editfotoUsuario" name="editfotoUsuario" style="display: none;">
                                    </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                             Nombre y Apellido
                            <input type="text" name="editnombreUsuario" id="editnombreUsuario" class="form-control" required>
                        </div>
                        <div class="col">
                             Nick de Usuario
                            <input type="text" name="editnickUsuario" id="editnickUsuario" class="form-control" disabled>
                        </div>
                        <div class="col">
                             Correo electrónico
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">@</span>
                                </div>
                                <input type="email" name="editmailUsuario" id="editmailUsuario" class="form-control" placeholder="ej: usuario@mail.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                             Estado
                            <select name="editestadoUsuario" id="editestadoUsuario" class="form-control" required>
                                <option value="">-Seleccione Estado-</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                        <div class="col">
                             Rol
                            <select name="editrolUsuario" id="editrolUsuario" class="form-control" required>

                            </select>
                        </div>
                        <div class="col">
                             Contraseña
                            <input type="text" name="editpassUsuario" id="editpassUsuario" class="form-control">
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

<script type="text/javascript" src="<?php echo base_url() . 'assets/js/Usuarios.js' ?>"></script>
