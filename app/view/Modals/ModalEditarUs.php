<div class="modal fade" id="ModalEditUs<?php echo $rowusu['ID_US'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Clientes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="FormularioAjax" action="<?php echo APP_URL ?>app/ajax/usuarioAjax.php" method="post">
        <input type="hidden" name="modulo_usuario" value="actualizar">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Identificacion</label>
            <input type="number" class="form-control" id="recipient-name" name="ID_US" value="<?php echo $rowusu['ID_US']; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nombre</label>
            <input type="text" class="form-control" id="recipient-name"  name="Nombre_US" pattern="^[A-Za-z]+( [A-Za-z]+)*$" maxlength="20" value="<?php echo $rowusu['Nombre_US']; ?>">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Correo</label>
            <input type="email" class="form-control" id="recipient-name" name="Correo_US" value="<?php echo $rowusu['Correo_US']; ?>" required>
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label" >Direccion</label>
            <input type="text" class="form-control" id="recipient-name" name="Direccion_US" value="<?php echo $rowusu['Direccion_US']; ?>">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label" >Telefono</label>
            <input type="number" class="form-control" id="recipient-name" name="Telefono_US" pattern="[0-9]{3,20}" maxlength="20" value="<?php echo $rowusu['Telefono_US']; ?>">
          </div>
          <button type="submit" class="btn btn-primary" name="ActUs">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="ActProd">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>