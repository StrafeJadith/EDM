<!-- MODAL -->
<div class="modal fade" id="modalAgregar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fs-5">Pago del monto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form id="form-agregar" action="../../controller/controllerUser.php" method="post">
          <div class="form-group">
            <label>Digite el monto</label>
            <input type="number" class="form-control" id="monto" name="monto" required>
            <br><br>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" name="enviar">Enviar</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          </div>
        </form>
        
      </div>
      
    </div>
  </div>
</div>