<?php

    require_once "../../config/app.php";
    require_once "../view/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controller\userPaymentController;

    if(isset($POST["modulo_pago"])){
        
        $insPaymentMethod = new userPaymentController();

        if($_POST["modulo_pago"] == "pago_credito"){

            $insPaymentMethod = $this->pagoCreditoController();
        }
        
        if($_POST["modulo_pago"] == "pago_efectivo"){
            
            $insPaymentMethod = $this->pagoEfectivoController();

        }


    }








?>