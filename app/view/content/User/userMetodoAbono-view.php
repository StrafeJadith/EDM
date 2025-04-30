<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

?>

    <link rel="stylesheet" href="<?= APP_URL ?>public/css/Usuario/metodo_abono.css">
    

</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL ?>public/img/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="    Buscar...                                                                                                     🔎        "
                                style="width: 450px; border-radius: 20px; height: 40px;">
                        </div>
                    </form>
                </div>


                <?php require_once './app/view/inc/navUser.php'; ?>
            </div>

        </div>
    </header>
    <!--Menu de los productos -->

    <div id="contentContenido">
        <?php require_once './app/view/inc/menuLateralUser.php'; ?>

        <div id="principal">
            <!-- imagenes de los productos-->
            <div id="contenido-a-actualizar">
                <div class="contenido">
                    <h2>Seleccione metodo de abono</h2>
                    <button type="button" class="nequi" data-toggle="modal" data-target="#modal-añadir">Nequi</button>
                    <br>
                    <button type="button" class="efectivo" data-bs-toggle="modal" data-bs-target="#modalAgregar">Efectivo</button>
                </div>
            </div>
            <?php include './app/view/Modals/modalEfectivo.php'; ?>
        </div>
    </div>


    <?php require_once './app/view/inc/footer.php' ?>
    <script src="<?= APP_URL?>public/js/pagos.js"></script>
