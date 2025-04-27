<?php
    require_once "../../config/app.php";
    require_once "../view/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controller\sellerController;

    if(isset($_POST['modulo_vendedor'])){

        $insVendedor = new sellerController();

        if($_POST['modulo_vendedor'] == "registrar"){

            echo $insVendedor->registrarVendedorControlador();
        }

        if($_POST['modulo_vendedor'] == "eliminar"){

            echo $insVendedor->eliminarVendedorControlador();
        }

        if($_POST['modulo_vendedor'] == "actualizar"){

            echo $insVendedor->actualizarVendedorControlador();
        }

    }