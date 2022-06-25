<div id="infoMessage"><?php echo $this->session->flashdata('message'); ?></div>

<div class="table-responsive">
    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addHorarioModal" data-whatever="@mdo"><span class="fa fa-plus"></span> Nuevo</button>
    <table class="table header-border table-hover table-custom spacing5 text-center" style="width:100%" id="tablelistHorario">
        <thead>
            <tr>
                <th><strong>Id</strong></th>
                <th><strong>Fecha Hora</strong></th>
                <th><strong>Descripcion</strong></th>
                <th><i class="fa fa-cog"></i></th>
            </tr>
        </thead>
        <tbody id="listHorario">
        </tbody>
    </table>
</div>

<form id="saveHorarioForm" method="post">
    <div class="modal fade" id="addHorarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Nuevo Horario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            Fecha y Hora
                            <input type="datetime-local" name="fechahora" id="fechahora" class="form-control" required>
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

<form id="editHorarioForm" method="post">
    <div class="modal fade" id="editHorarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Horario</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            Fecha y Hora
                            <input type="datetime-local" name="editfechahora" id="editfechahora" class="form-control" required>
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
                    <input type="hidden" name="editIdHorario" id="editIdHorario" class="form-control">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="deleteHorarioForm" method="post">
    <div class="modal fade" id="deleteHorarioModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">Estás seguro de eliminar el Horario?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <label class="label label-default" name="deleteHorarioNombre" id="deleteHorarioNombre"></label>
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

<script type="text/javascript" src="<?php echo base_url() . 'assets/js/Horario.js' ?>"></script>