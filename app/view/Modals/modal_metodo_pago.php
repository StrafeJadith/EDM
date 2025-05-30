<!-- modal Metodo de pago -->
<div class="modal" id="metodoPago" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class=" m modal-content">
            <div class="header modal-header">
                <h5 class="modal-title">metodo de pago</h5>
                <button type="button" class=" x btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" body modal-body">
                <form action="<?= APP_URL ?> app/ajax/paymentMethodsAjax.php" class= "FormularioAjax" method="POST">

                    <h3>Escoja el metodo de pago por el cual quiera realizar la compra</h3>
                    <br><br>


                    <button type="submit" class="btn btn-primary" name="mcredito">Credito</button>
                    <input type="hidden" name= "modulo_pago" value= "pago_credito">
                    <button type="submit" class="btn btn-success" name="mefectivo">Efectivo</button>
                    <input type="hidden" name= "modulo_pago" value= "pago_efectivo">
                </form>
            </div>
            <div class=" footer modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>