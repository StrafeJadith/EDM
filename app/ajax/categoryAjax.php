<?php

    require_once "../../config/app.php";
    require_once "../view/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controller\adminCategoryController;

    if(isset($_POST['modulo_categoria'])){

        $insCategoria = new adminCategoryController();

        if($_POST['modulo_categoria'] == "registrar"){

            echo $insCategoria->agregarCategoriaControlador();

        }

        if($_POST['modulo_categoria'] == "eliminar"){

            echo $insCategoria->eliminarCategoriaControlador();

        }

        if($_POST['modulo_categoria'] == "actualizar"){

            echo $insCategoria->actualizarCategoriaControlador();

        }
    }