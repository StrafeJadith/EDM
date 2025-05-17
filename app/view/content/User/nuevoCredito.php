<?php
if(!isset($_SESSION['correo'])){
    $insLogin->cerrarSesionControlador();
    exit();
}

?>
</head>

<body>
    <header id="headerCreditos"></header>
    <div id="barranav">

        <div id="ContainerNav">
            <div id="Logos">
                <img src="<?= APP_URL ?>public/img/logo.png" width="350px" height="200px"
                    style="padding-left: 10px; padding-top: 0px">

            </div>


            <?php require_once './app/view/inc/navUser.php' ?>
        </div>

    </div>
    <div class="containerMid">
        <?php require_once './app/view/inc/menuLateralUser.php' ?>
        

                </div>

            
    </header>

        <div class="padre2">
            <form action="<?php echo APP_URL ?>app/controller/controllerInicio.php" method="post">
                <div>
                    <h2 class="TituloNC">Solicitud nuevo credito</h2>
                    <br>
                    <input type="number" name="monto2" placeholder="Digite un monto" class="caja1">
                    <br><br>
                    <input type="submit" name="SolicitarNC" value="Solicitar un nuevo credito" class="caja2">
            </form>
        </div>
    </div>
    </div>
    <?php

    if (isset($_SESSION["msg"])) {
        $msg = $_SESSION["msg"];

        if ($msg) {
            echo ("<script> $msg </script>");

            unset($_SESSION["msg"]);
        }
    }


    ?>

    <script src="../../../public/js/alerts.js"></script>
    <script src="../../../public/js/pagos.js"></script>
    <footer class=" footerContainer ">
        <div class=" contactos ">
            <h1>Contactanos</h1>
        </div>
        <div class=" socialIcons ">
            <a href><i class=" fa-brands fa-facebook "></i></a>
            <a href><i class=" fa-brands fa-whatsapp "></i></a>
            <a href><i class=" fa-brands fa-twitter "></i></a>
            <a href><i class=" fa-brands fa-google "></i></a>
        </div>
    </footer>
</body>