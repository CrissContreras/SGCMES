<div id="infoMessage"><?php echo $this->session->flashdata('message'); ?></div>
<input type="text" name="baseUrl" hidden id="baseUrl" value="<?php echo base_url() . 'gestionCitasMedicas/CitaMedica' ?>">
<div class="table-responsive">
    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addCitaMedicaModal" data-whatever="@mdo"><span class="fa fa-plus"></span> Nuevo</button>
    <table class="table header-border table-hover table-custom spacing5 text-center" style="width:100%" id="tableListCitaMedica">
        <thead>
            <tr>
                <th><strong>Id</strong></th>
                <th><strong>Paciente</strong></th>
                <th><strong>Medico</strong></th>
                <th><strong>Especialidad</strong></th>
                <th><strong>Horario</strong></th>
                <th><strong>Estado</strong></th>
                <th><i class="fa fa-cog"></i></th>
            </tr>
        </thead>
        <tbody id="listCitaMedica">
        </tbody>
    </table>
</div>

<form id="saveCitaMedicaForm" method="post">
    <div class="modal fade" id="addCitaMedicaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Nueva Cita</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Paciente</label>
                            <select class="form-control" id="id_paciente" name="id_paciente" required>
                            </select>
                        </div>
                        <div class="col">
                            <label>Especialidad</label>
                            <select class="form-control" id="id_especialidad" name="id_especialidad" onchange="comboMedico()">
                            </select>
                        </div>
                        <div class="col">
                            <label>Médico</label>
                            <select class="form-control" id="id_medico" name="id_medico" onchange="comboHorario()" required>
                            </select>
                        </div>
                        <div class="col">
                            <label>Horario</label>
                            <select class="form-control" id="id_horario" name="id_horario" required>
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

<form id="editCitaMedicaForm" method="post">
    <div class="modal fade" id="editCitaMedicaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Cita Medica</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Paciente</label>
                            <select class="form-control" id="editid_paciente" name="editid_paciente">
                            </select>
                        </div>
                        <div class="col">
                            <label>Especialidad</label>
                            <select class="form-control" id="editid_especialidad" name="editid_especialidad">
                            </select>
                        </div>
                        <div class="col">
                            <label>Médico</label>
                            <select class="form-control" id="editid_medico" name="editid_medico">
                            </select>
                        </div>
                        <div class="col">
                            <label>Horario</label>
                            <select class="form-control" id="editid_horario" name="editid_horario">
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="editIdCitaMedica" id="editIdCitaMedica" class="form-control">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="deleteCitaMedicaForm" method="post">
    <div class="modal fade" id="deleteCitaMedicaModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">Está seguro que desea eliminar la cita para esta fecha y hora?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <label class="label label-default" name="deleteFechahora" id="deleteFechahora"></label>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="deleteCitaMedicaId" id="deleteCitaMedicaId" class="form-control">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success btn-sm">Si</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="editDatosCitaMedicaForm" method="post">
    <div class="modal fade" id="editDatosCitaMedicaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Datos de la Cita Medica</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Síntoma</label>
                            <textarea type="text" row="100" id="sintoma" name="sintoma" class="form-control" placeholder="Síntoma del paciente..." required></textarea>
                        </div>
                        <div class="col">
                            <label>Diagnónstico</label>
                            <textarea type="text" row="100" id="diagnostico" name="diagnostico" class="form-control" placeholder="Diagnóstico del paciente..." required></textarea>
                        </div>
                        <div class="col">
                            <label>Receta</label>
                            <textarea type="text" row="100" id="receta" name="receta" class="form-control" placeholder="Receta..." required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="editDatosIdCitaMedica" id="editDatosIdCitaMedica" class="form-control">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="showDatosCitaMedicaForm" method="post">
    <div class="modal fade" id="showDatosCitaMedicaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Datos de la Cita Medica</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                            <label>Síntoma</label>
                            <textarea type="text" row="10" id="showsintoma" name="showsintoma" class="form-control" placeholder="Síntoma del paciente..." readonly></textarea>
                        </div>
                        <div class="col">
                            <label>Diagnónstico</label>
                            <textarea type="text" row="10" id="showdiagnostico" name="showdiagnostico" class="form-control" placeholder="Diagnóstico del paciente..." readonly></textarea>
                        </div>
                        <div class="col">
                            <label>Receta</label>
                            <textarea type="text" row="10" id="showrecete" name="showreceta" class="form-control" placeholder="Receta..." readonly></textarea>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label>Historial</label>
                        <textarea type="text" row="10" id="showhistorial" name="showhistorial" class="form-control" placeholder="historial...." readonly></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
    </div>
</form>

<script type="text/javascript" src="<?php echo base_url() . 'assets/js/CitaMedica.js' ?>"></script>