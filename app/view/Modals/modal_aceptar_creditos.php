<!--modal editar categorias -->
                
<div class="modal" id="Aceptar_credito<?php echo $row['ID_CR'];?>" data-bs-backdrop="static" data-bs-keyboard="false"  tabindex="-1">
    <div class="modal-dialog"> 
            <div class=" m modal-content">
                    <div class=" header modal-header">
                        <h5 class="modal-title">Aceptar creditos</h5>
                        <button type="button" class=" x btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class=" body modal-body">
                    <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/creditosAjax.php" method="POST" autocomplete="off">
                        <input type="hidden" name="modulo_creditos" value="registrar">
                            <h5 class="modal-title">Desea Aceptar el credito de <?php echo $row['Nombre_US']; ?></h5><br>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">ID Credito</label>
                                <input type="text" class="form-control" id="recipient-name" name="ID_CR" value="<?php echo $row['ID_CR']; ?>" readonly pattern="[0-9]+">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">ID Usuario</label>
                                <input type="text" class="form-control" id="recipient-name" name="ID_US" value="<?php echo $row['ID_US']; ?>" readonly pattern="[0-9]+">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Correo</label>
                                <input type="text" class="form-control" id="recipient-name" name="Correo_CR" value="<?php echo $row['Correo_CR']; ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Monto</label>
                                <input type="text" class="form-control" id="recipient-name" name="Valor_CR" value="<?php echo $row['Valor_CR']; ?>" pattern="[0-9]+" readonly>
                            </div>
                        
                            
                            <button type="submit" class="btn btn-primary" name="Aceptar">ACEPTAR</button>

                        </form>
                    </div>
                    <div class=" footer modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
    </div>
</div>