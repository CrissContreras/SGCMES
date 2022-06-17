<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Catalogo</a></li>
  </ol>
</nav>
<div><a href="<?= base_url() ?>administracion/catalogo/crear" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-plus"></span>Agregar</a></div>
 <table class="table table-striped">
           <tbody>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Opciones</th>
                </tr>
                <?= $html ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">
                        <?= $paginado ?>
                    </td>
                </tr>
            </tfoot>
</table>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/Catalogo.js' ?>"></script>