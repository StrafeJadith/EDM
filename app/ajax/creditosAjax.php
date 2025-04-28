<?php

    require_once "../../config/app.php";
    require_once "../view/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controller\adminCreditosController;

    if(isset($_POST['modulo_creditos'])){

        $insCreditos = new adminCreditosController();

        if($_POST['modulo_creditos'] == "registrar"){

            echo $insCreditos->agregarCreditosControlador();

        }
        if($_POST['modulo_creditos'] == "eliminar"){

            echo $insCreditos->eliminarCreditoControlador();

        }
        if($_POST['modulo_creditos'] == "actualizar"){

            echo $insCreditos->actualizarCreditosControlador();

        }
        
    }