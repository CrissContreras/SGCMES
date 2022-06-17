<div class="w-50 bg-light border rounded border-white">
        <form class="form-signin" id="catalogo" action="<?= base_url() ?>administracion/catalogo/almacenar" method="post">
            <div class="row text-center">
                <div class="col">
                <h2>Nuevo Catálogo</h2>
                </div>
            </div><hr>
            <div class="row">
                <div class="col">
                    <label>Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" >
                </div>
                <div class="col">
                    <fieldset class="form-group">
                    <div class="row">
                    <legend class="col-form-label col-sm-2 pt-0">Tipo</legend>
            <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="tipo" id="tipo1" value="G" checked>
          <label class="form-check-label" for="gridRadios1">
            Género
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="tipo" id="tipo2" value="C">
          <label class="form-check-label" for="gridRadios2">
            Ciudad
          </label>
        </div>
        <div class="form-check disabled">
          <input class="form-check-input" type="radio" name="tipo" id="tipo3" value="M">
          <label class="form-check-label" for="gridRadios3">
            Medicina
          </label>
          </div>
          <div class="form-check disabled">
          <input class="form-check-input" type="radio" name="tipo" id="tipo4" value="S">
          <label class="form-check-label" for="gridRadios4">
            Síntoma
          </label>
        </div>
        </div>
      </div>
    </div>
  </fieldset>
                </div>
                
            </div><br>
                    <div class="row text-center">
                <div class="col"></div>
                <div class="col">
                    <button class="btn btn-round btn-primary btn-block" type="submit">Crear</button>
                </div>
                <div class="col"></div>
            </div><hr>
        </form>
    </div>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/Catalogo.js' ?>"></script>

    