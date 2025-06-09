<?php

//este fragmento de codigo es por si la persona esta intentando acceder al apartado de credito sin haber iniciado sesión, si es asi lo mandara a la pagina de inicio para que inicie sesión.

if (!isset($_SESSION['correo'])) {

    $insLogin->cerrarSesionControlador();
    exit();
}

?>

<link rel="stylesheet" href="<?= APP_URL ?>public/css/inicio&&registro/navHome.css">
<link rel="stylesheet" href="<?= APP_URL; ?>public\css\Usuario\gasto credito.css">

<body class="bodyCreditos">
    <header id="headerCreditos">
        <div id="barranav">

            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL; ?>public/img/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">
                </div>

                <?php require_once './app/view/inc/navUser.php' ?>
            </div>

        </div>
    </header>

    <div class="containerMid_2">
        <?php require_once './app/view/inc/menuLateralUser.php' ?>
        <div class="padre">
            <form action="../../controller/controllerInicio.php" method="post">
                <div>
                    <h2>Solicitud nueva de credito</h2>
                    <br>
                    <input type="number" name="monto2" placeholder="Digite un monto">
                    <br><br>
                    <input type="submit" name="SolicitarNC" value="Solicitar un nuevo credito">
                </div>
            </form>
        </div>
    </div>
    <script src="<?= APP_URL ?>public/js/pagos.js"></script>

    <?php require_once './app/view/inc/footer.php' ?>