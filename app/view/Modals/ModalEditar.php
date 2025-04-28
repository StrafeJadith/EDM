
<div class="modal fade" id="ModalEdit<?php echo $row['ID_PRO'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Productos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/productosAjax.php" method="POST" autocomplete="off">
          <input type="hidden" name="modulo_productos" value="actualizar">
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">ID</label>
              <input type="text" class="form-control" id="recipient-name" name="ID_PRO" pattern="[0-9]{1,15}" maxlength="15" value="<?php echo $row['ID_PRO']; ?>" readonly>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Nombre</label>
              <input type="text" class="form-control" id="recipient-name" name="Nombre_PRO"  value="<?php echo $row['Nombre_PRO']; ?>" pattern="^[A-Za-z]+( [A-Za-z]+)*$" maxlength="20" required>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Descripcion</label>
              <input type="text" class="form-control" id="recipient-name" name="Descripcion_PRO" value="<?php echo $row['Descripcion_PRO']; ?>" pattern="^[A-Za-z]+( [A-Za-z]+)*$" maxlength="40" required>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Categoria</label>
              <select name="Categoria_PRO"class="form-control" id="recipient-name">
              
                  <option value="0" class="option"><?php //echo $row['Categoria_PRO']; ?></option>
                  <?php 
                    
                    $sql = $insLogin->ejecutarConsulta("SELECT ID_CAT, Nombre_CAT from categoria_producto");
                    $result = $sql->fetchAll(PDO::FETCH_ASSOC);

                    if(count($result) > 0){
                        foreach($result as $fila){
                            $selectec = ( $fila['ID_CAT'] == $Categoria_Prod) ? 'selected' : '';
                            echo '<option class="option" value="'.$fila['ID_CAT'].'" '.$selectec.'>'.$fila['Nombre_CAT'].'</option>';
                        }
                    }else{
                        echo'<option class="option" value="">no seleccionaste niguna opcion</option>';
                    }
                ?>
          
                </select>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Valor Unitario</label>
              <input type="text" class="form-control" id="recipient-name" name="Valor_Unitario" value="<?php echo $row['Valor_Unitario']; ?>" pattern="[0-9]{1,15}" maxlength="15" required>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Cantidad Total</label>
              <input type="text" class="form-control" id="recipient-name" name="Cantidad_Total" value="<?php echo $row['Cantidad_Total']; ?>" pattern="[0-9]{1,15}" maxlength="15" required>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Cantidad Existente</label>
              <input type="text" class="form-control" id="recipient-name" name="Cantidad_Existente" value="<?php echo $row['Cantidad_Existente']; ?>" pattern="[0-9]{1,15}" maxlength="15" required>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Fecha Entrada</label>
              <input type="text" class="form-control" id="recipient-name" name="Fecha_Entrada" value="<?php echo $row['Fecha_Entrada']; ?>">
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Fecha Salida</label>
              <input type="text" class="form-control" id="recipient-name" name="Fecha_Expedicion" value="<?php echo $row['Fecha_Expedicion']; ?>">
            </div>
            <button type="submit" class="btn btn-primary" name="ActProd">Guardar</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="ActProd">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>

