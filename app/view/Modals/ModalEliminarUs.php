<!-- Modal -->

<div class="modal fade" id="ModalDeleteUs<?php echo $rowusu['ID_US']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black;">Eliminar Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
   
      <form class="FormularioAjax" action="<?php echo APP_URL;?>app/ajax/usuarioAjax.php" method="post">
      <input type="hidden" name="modulo_usuario" value="eliminar">
        <div class="modal-body">
            <h4 style="color:black">¿Desea eliminar el usuario <strong style="color: red;"><?php echo $rowusu['Nombre_US']?></strong> ?</h4>
            <input type="hidden" name="ID_US" value="<?php echo $rowusu['ID_US'] ?>">
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-danger" name="EliminarUs">Eliminar</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        
      </div>
    </div>
  </div>
</div>