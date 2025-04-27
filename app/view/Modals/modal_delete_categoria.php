
<!--modal delete categorias -->

<div class="modal" id="delete_categoria<?php echo $row['ID_CAT'];?>" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1">
   <div class="modal-dialog">
      <div class=" m modal-content">
         <div class=" header modal-header">
            <h5 class="modal-title">Eliminar categoria</h5>
               <button type="button" class=" x btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" body modal-body">
            <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/categoryAjax.php" method = "POST">

                  <input type="hidden" name="modulo_categoria" value="eliminar">

                  <div class="mb-3">
                     <label for="recipient-name" class="col-form-label">ID Categoria</label>
                     <input type="text" class="form-control" id="recipient-name"name="idcat" value="<?php echo $row['ID_CAT'];?>" readonly>
                  </div>
                  <div class="mb-3">
                     <label for="recipient-name" class="col-form-label">ID Categoria</label>
                     <input type="text" class="form-control" id="recipient-name" name="nombrecat" value="<?php echo $row['Nombre_CAT'];?>" readonly>
                  </div>
                     
                  
                  <button type="submit" class="btn btn-danger" name="DeleteCat">ELIMINAR</button>

               </form>
            </div>
            <div class=" footer modal-footer">
               <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      </div>
   </div>
</div>
