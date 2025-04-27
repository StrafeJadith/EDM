<!-- MODAL -->
<div class="modal fade" id="modal-agregar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h5 class="modal-title">Pago del monto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="form-agregar" action="../../controller/controllerUser.php" method="post">
          <div class="form-group">
            <label>Digite el monto</label>
            <input type="number" class="form-control" id="monto" name="monto" required>
            <br><br>
            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>