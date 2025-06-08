
<div class="modal fade" id="RecuperarContraseña" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Recuperar Contraseña</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/recuperarContraseñaAjax.php" method="POST" autocomplete="off">
        
                <input type="hidden" name="modulo_recuperar" value="validarCodigo">
                <div class="modal-body">
                    <span class="input-group-text" id="basic-addon1"><strong>Codigo</strong></span>
                    <input type="text" class="form-control" name="Codigo" placeholder="Ingrese el codigo enviado al correo" aria-label="ingrese su correo" aria-describedby="basic-addon1" required>
                </div>
                <div class="modal-body">
                    <span class="input-group-text" id="basic-addon1"><strong>Nueva contraseña</strong></span>
                    <input type="password" class="form-control" name="Contraseña" placeholder="Ingrese la nueva contraseña" aria-label="ingrese su correo" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required>
                                        
                </div>
                <div class="modal-body">
                        <span class="input-group-text" id="basic-addon1"><strong>Repita la contraseña</strong></span>
                        <input type="password" class="form-control" name="repetirContraseña" placeholder="Ingrese de nuevo la contraseña" aria-label="ingrese su correo" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required>
                                        
                </div>
                <div class="modal-footer">
                    <button type="submit" name="Eliminar"><strong>Actualizar</strong></button>
                    <button type="button" data-bs-dismiss="modal"><strong>Cancelar</strong></button>
                </div>
        
            </form>
        
        
        </div>
    </div>
</div>
