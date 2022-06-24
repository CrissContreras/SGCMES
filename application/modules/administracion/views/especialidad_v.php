<div id="infoMessage"><?php echo $this->session->flashdata('message'); ?></div>

<div class="table-responsive">
    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addEspecialidadModal" data-whatever="@mdo"><span class="fa fa-plus"></span> Nuevo</button>
    <table class="table header-border table-hover table-custom spacing5 text-center" style="width:100%" id="tablelistEspecialidad">
        <thead>
            <tr>
                <th><strong>Id</strong></th>
                <th><strong>Nombre</strong></th>
                <th><strong>Descripcion</strong></th>
                <th><i class="fa fa-cog"></i></th>
            </tr>
        </thead>
        <tbody id="listEspecialidad">
        </tbody>
    </table>
</div>

<form id="saveEspecialidadForm" method="post">
    <div class="modal fade" id="addEspecialidadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Nueva Especilidad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            Nombre
                            <input type="text" name="nombre" id="nombre" class="form-control" required>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <div class="col">
                            Descripcion
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
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

<form id="editEspecialidadForm" method="post">
    <div class="modal fade" id="editEspecialidadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Especilidad</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            Nombre
                            <input type="text" name="editNombre" id="editNombre" class="form-control" required>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <div class="col">
                            Descripcion
                            <input type="text" name="editDescripcion" id="editDescripcion" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="editIdEspecialidad" id="editIdEspecialidad" class="form-control">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="deleteEspecialidadForm" method="post">
    <div class="modal fade" id="deleteEspecialidadModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">Estás seguro de eliminar la Especialidad?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <label class="label label-default" name="deleteEspecialidadNombre" id="deleteEspecialidadNombre"></label>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="deleteEspecialidadId" id="deleteEspecialidadId" class="form-control">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success btn-sm">Si</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript" src="<?php echo base_url() . 'assets/js/Especialidad.js' ?>"></script>