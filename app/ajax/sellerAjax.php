<?php

// file_put_contents('debug_post.log', print_r($_POST, true));
// echo "<pre>";
//     var_dump($_POST);
//     echo "</pre>";
//     exit;

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

    require_once "../../config/app.php";
    require_once "../view/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controller\sellerController;

    if (isset($_POST['modulo_vendedor'])) {

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

        if($_POST['modulo_vendedor'] == "abonarDinero"){

            echo $insVendedor->abonarDineroVendedorControlador();
        }

        //Consultar usuario
        if($_POST['modulo_vendedor'] == "Consultar"){

            echo $insVendedor->consultarUsuarioVendedorControlador();
            
        }

        if($_POST['modulo_vendedor'] == "ConsultarCreditos"){

            echo $insVendedor->consultarCreditosUsuariosVendedorControlador();
        }

        

    }