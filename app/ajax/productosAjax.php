<?php

    require_once "../../config/app.php";
    require_once "../view/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controller\adminProductosController;

    if(isset($_POST['modulo_productos'])){

        $insProductos = new adminProductosController();

        if($_POST['modulo_productos'] == "registrar"){

            echo $insProductos->agregarProductosControlador();

        }

        if($_POST['modulo_productos'] == "eliminar"){

            echo $insProductos->eliminarProductoControlador();

        }

        if($_POST['modulo_productos'] == "actualizar"){

            echo $insProductos->actualizarProductosControlador();

        }
    }