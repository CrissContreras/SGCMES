<div id="infoMessage"><?php echo $this->session->flashdata('message'); ?></div>

            <div class="table-responsive">
                    <button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#addCatalogoModal" data-whatever="@mdo"><span class="fa fa-plus"></span> Nuevo</button>
                    <table class="table header-border table-hover table-custom spacing5 text-center" style="width:100%" id="tablelistCatalogo">
                        <thead>
                            <tr>
                                <th><strong>Id</strong></th>
                                <th><strong>Nombre</strong></th>
                                <th><strong>Tipo</strong></th>
                                <th><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                        <tbody id="listCatalogo">
                        </tbody>
                    </table>
            </div>

<form id="saveCatalogoForm" method="post">
    <div class="modal fade" id="addCatalogoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Nuevo Catálogo</h4>
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
                            <label>Tipo</label>
                            <select class="form-control" id="tipo" name="tipo">
                                <option selected value="G">Género</option>
                                <option value="C">Ciudad</option>
                                <option value="M">Medicina</option>
                                <option value="S">Síntoma</option>
                                <option value="I">Indetificación tipo</option>
                            </select>
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

<form id="editCatalogoForm" method="post">
    <div class="modal fade" id="editCatalogoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel">Editar Catálogo</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <div class="col">
                             Nombre
                            <input type="text" name="showNombre" id="showNombre" class="form-control" required>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <div class="col">
                            <label>Tipo</label>
                            <select class="form-control" id="showTipo" name="showTipo">
                                <option selected value="G">Género</option>
                                <option value="C">Ciudad</option>
                                <option value="M">Medicina</option>
                                <option value="S">Síntoma</option>
                                <option value="I">Indetificación tipo</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="showId" id="showId" class="form-control">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<form id="deleteCatalogoForm" method="post">
    <div class="modal fade" id="deleteCatalogoModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="editModalLabel">Estás seguro de eliminar el catálogo?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <label class="label label-default" name="deleteCatalogoNombre" id="deleteCatalogoNombre"></label>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="deleteCatalogoId" id="deleteCatalogoId" class="form-control">
                    <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">No</button>
                    <button type="submit" class="btn btn-success btn-sm">Si</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript" src="<?php echo base_url() . 'assets/js/Catalogo.js' ?>"></script>
