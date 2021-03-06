<div class="modal fade" id="mdlEditarHuesped" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      {{Form::open(['id'=>'frmEditarHuesped', 'method'=>'put'])}}
      {{ csrf_field() }}
      <div class="modal-header" style="background-color:#385a94; color:#fff;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">EDITAR HUESPED HABITACIÓN <strong class="hab_numero"></strong>
        EDIFICIO <strong class="edif_nombre"></strong> </h4>
      </div>
      <div class="modal-body" style="background-color:#e69c2d">
        <div class="panel" style="background-color:#bd7406">
          <div class="panel-body">
            <div class="form-group">
              <input type="text" class="form-control dni input-sm" placeholder="DNI" name="dni"
                required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control mayuscula input-sm nombres" placeholder="NOMBRES" name="nombres"
                required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control mayuscula input-sm apellidos" placeholder="APELLIDOS" name="apellidos" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control input-sm telefono" placeholder="TELÉFONO" name="telefono">
            </div>
            <div class="form-group">
              <input type="text" class="form-control input-sm fecha salida" placeholder="SALIDA" name="salida">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer" style="background-color:#385a94">
        <button type="button" class="btn btn-default" data-dismiss="modal">
          <span class="glyphicon glyphicon-ban-circle"></span> Cancelar</button>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> 
          Modificar</button>
        {{Form::hidden('habitacion_id', null)}}
      </div>
      {{Form::close()}}
    </div>
  </div>
</div>
