<?php
    
    require_once "../../config/app.php";
    require_once "../view/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controller\userSalesController;

    if($_POST['modulo_compras']){

        $insCompras = new userSalesController();

        if($_POST['modulo_compras'] == "comprasUsuarios"){

            

        }
    }