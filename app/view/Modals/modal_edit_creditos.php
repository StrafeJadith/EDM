
<!--modal editar valor de creditos -->
            
<div class="modal" id="editar_credito<?php echo $row['ID_CR'];?>" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1">
   <div class="modal-dialog">
      <div class=" m modal-content">
         <div class=" header modal-header">
            <h5 class="modal-title">Modificar valor de credito</h5>
               <button type="button" class=" x btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" body modal-body">
               <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/creditosAjax.php" method = "POST" autocomplete="off">
                  <input type="hidden" name="modulo_creditos" value="actualizar">

                     <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ID Credito</label>
                        <input type="text" class="form-control" id="recipient-name"  name="idcre" value="<?php echo $row['ID_CR'];?>" readonly>
                     </div>
                     <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">ID Usuario</label>
                        <input type="text" class="form-control" id="recipient-name"   name="idus" value="<?php echo $row['ID_US'];?>" readonly>
                     </div>
                     <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Nombre</label>
                        <input type="text" class="form-control" id="recipient-name"   name="nombrecre" value="<?php echo $row['Nombre_US'];?>" readonly>
                     </div>
                     <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Correo</label>
                        <input type="text" class="form-control" id="recipient-name"    name="apellidocre" value="<?php echo $row['Correo_CR'];?>" readonly>
                     </div>
                     <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Telefono</label>
                        <input type="text" class="form-control" id="recipient-name"     name="telefonocre" value="<?php echo $row['Telefono_CR'];?>" readonly>
                     </div>
                     <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Direccion</label>
                        <input type="text" class="form-control" id="recipient-name"     name="direccioncre" value="<?php echo $row['Direccion_CR'];?>" readonly>
                     </div>
                     <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Estado</label>
                        <input type="text" class="form-control" id="recipient-name"     name="estadocre" value="<?php echo $row['Estado_CR'];?>" readonly>
                     </div>
                     <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Fecha</label>
                        <input type="text" class="form-control" id="recipient-name"     name="fechacre" value="<?php echo $row['Fecha_CR'];?>" readonly>
                     </div>
                     <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Valor</label>
                        <input type="text" class="form-control" id="recipient-name"  name="valorcre" value="<?php echo $row['Valor_CR'];?>" pattern="[0-9]{1,15}" maxlength="15" required>
                     </div>
                     <button type="submit" name="Actualizar" class="btn btn-info" >ACTUALIZAR</button>

               </form>
            </div>
            <div class=" footer modal-footer">
               <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
      </div>
   </div>
</div>
