<?php

    require_once "../../config/app.php";
    require_once "../view/inc/session_start.php";
    require_once "../../autoload.php";

    use app\controller\userRecuperarContraseñaController;

    if(isset($_POST['modulo_recuperar'])){

        $insRecuperar = new userRecuperarContraseñaController();

        if($_POST['modulo_recuperar'] == "recuperarContraseña"){

            echo $insRecuperar->RecuperarContrasenaControlador();

        }

        if ($_POST['modulo_recuperar'] == 'validarCodigo') {
            
            echo $insRecuperar->validarCodigoYActualizarContrasena();
        }
    }