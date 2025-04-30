<!-- Modal -->

<div class="modal fade" id="ModalDelete<?php echo $row['ID_PRO']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
   
      <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/productosAjax.php" method="POST" autocomplete="off">
        <input type="hidden" name="modulo_productos" value="eliminar">
        <div class="modal-body">
            <h4>¿Desea eliminar el producto <strong style="color: red;"><?php echo $row['Nombre_PRO']?></strong> ?</h4>
            <input type="hidden" name="ID_PRO" value="<?php echo $row['ID_PRO'] ?>">
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-danger" name="Eliminar">Eliminar</button></div>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        
      </div>
    </div>
  </div>
</div>