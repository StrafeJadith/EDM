
<div class="modal fade" id="ModalEliminarVen<?php echo $rowVen['ID_US']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: black;">Eliminar Vendedores</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/sellerAjax.php" method="POST" autocomplete="off">
        <input type="hidden" name="modulo_vendedor" value="eliminar">
        <div class="modal-body">
            <h4 style="color:black">¿Desea eliminar el vendedor <strong style="color: red;"><?php echo $rowVen['Nombre_US']?></strong> ?</h4>
            <input type="hidden" name="ID_US" value="<?php echo $rowVen['ID_US'] ?>">
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-danger" name="EliminarVend">Eliminar</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        
      </div>
    </div>
  </div>
</div>