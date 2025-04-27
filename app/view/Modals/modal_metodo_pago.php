<!-- modal Metodo de pago -->
<div class="modal" id="metodo_pago" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class=" m modal-content">
            <div class=" header modal-header">
                <h5 class="modal-title">metodo de pago</h5>
                <button type="button" class=" x btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class=" body modal-body">
                <form action="../../controller/controllerCarrito.php" method="POST">

                    <h3>Escoja el metodo de pago por el cual quiera realizar la compra</h3>
                    <br><br>


                    <button type="submit" class="btn btn-primary" name="mcredito">Credito</button>
                    <button type="submit" class="btn btn-success" name="mefectivo">Efectivo</button>

                </form>
            </div>
            <div class=" footer modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>