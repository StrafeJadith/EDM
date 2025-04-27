<div class="modal fade" id="ModalVen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar Vendedores</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/sellerAjax.php" method="POST" autocomplete="off">
                            <input type="hidden" name="modulo_vendedor" value="registrar">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Identificacion</label>
                                <input type="text" class="form-control" id="recipient-name" name="ID_US" pattern="[0-9]{1,15}" maxlength="15" required>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nombre</label>
                                <input type="text" class="form-control" id="recipient-name" name="Nombre_US" pattern="^[A-Za-z]+( [A-Za-z]+)*$" maxlength="20" required>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Correo</label>
                                <input type="email" class="form-control" id="recipient-name" name="Correo_US" maxlength="70">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" >Direccion</label>
                                <input type="text" class="form-control" id="recipient-name" name="Direccion_US" maxlength="100">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" >Telefono</label>
                                <input type="text" class="form-control" id="recipient-name" name="Telefono_US" pattern="[0-9]{3,20}" maxlength="20" required>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" >Contraseña</label>
                                <input type="password" class="form-control" id="recipient-name" name="Contraseña_US" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label" >Repetir Contraseña</label>
                                <input type="password" class="form-control" id="recipient-name" name="Contraseña_US2" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required>
                            </div>
                        
                            <button type="submit" class="btn btn-primary" name="aggVend">Guardar</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" name="ActProd">Cerrar</button>
                            
                        </div>
                        </div>
    </div>
    </div>