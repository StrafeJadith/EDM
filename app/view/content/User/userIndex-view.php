<?php

if(!isset($_SESSION['correo'])){

    $insLogin->cerrarSesionControlador();
    exit();
    
}
?>


    <link rel="stylesheet" href="<?= APP_URL ?>public/css/Usuario/index_.css">
    
</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <a href="<?= APP_URL ?>userIndex/"><img src="<?= APP_URL ?>public/img/Usuario/logo.png"
                            width="350px" height="200px" style="padding-left: 10px; padding-top: 0px"></a>

                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="    Buscar...                                                                                                     🔎        "
                                style="width: 450px; border-radius: 20px; height: 40px;">
                        </div>
                    </form>
                </div>


                <nav id="Nav">
                    <div id="NavList">

                        <ul id="Listas">
                            <a href="<?= APP_URL ?>inicio/">
                                <li><strong> Inicio </strong></li>
                            </a>
                            <a href="<?= APP_URL ?>indexProductos/">
                                <li><strong> Productos </strong></li>
                            </a>
                            <a href="<?= APP_URL ?>indexCreditosInicio/">
                                <li><strong> Creditos </strong></li>
                            </a>
                            <?php

                            if (empty($_SESSION['correo'])) { ?>
                                <a href="<?= APP_URL ?>indexInicio/"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>

                                <a href="<?= APP_URL ?>log-Out/"><button type="button" class="btn">Cerrar Sesión</button></a>

                                <a href="<?= APP_URL ?>userCarritoCompra/">
                                    <li><img src="<?= APP_URL ?>public/img/Usuario/Carrito.png" width="40px" height="40px"
                                            style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="<?= APP_URL ?>userIndex/">
                                    <li><img src="<?= APP_URL ?>public/img/Usuario/home.svg" width="40px" height="40px"
                                            style="margin-top: -18px;">
                                    </li>
                                </a>
                            <?php } ?>

                        </ul>

                    </div>

                </nav>
            </div>

        </div>
    </header>
    <!--Menu de los productos -->
    <div class="containerMid">
        <nav class="nav_">
            <a href="<?= APP_URL ?>userPerfilUser/"><img src="<?= APP_URL ?>public/img/Usuario/user.svg" alt="" class="user"></a>
            <div class="correo">
                <?php

                $correo = $_SESSION['correo'];
                $sql = $insLogin->ejecutarConsulta("SELECT Nombre_US FROM usuarios WHERE Correo_us = '$correo'");
                $row = $sql->fetch();
                $nombre = $row['Nombre_US'];

                echo "Bienvenido " . $nombre . "<br>";
                echo $correo;

                ?>

            </div>
            <br>
            <hr style="color: #f9f7dc;">

            <ul class="lista">
                <li class="lista_item lista_item--click">
                    <a href="<?= APP_URL ?>userIndex/" class="nav_link">
                        <h2>Navegacion</h2>
                    </a>
                </li>
                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="<?= APP_URL ?>public/img/Usuario/creditos.png" class="lista_img">
                        <a href="#" class="nav_link"> CREDITOS </a>
                        <img src="<?= APP_URL ?>public/img/Usuario/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>userGastoCredito/" class="nav_link nav_link--inside"> GASTO DE CREDITO </a>
                        </li>
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>userAbonoCredito/" class="nav_link nav_link--inside"> ABONO DE CREDITO </a>
                        </li>
                    </ul>
                </li>

                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="<?= APP_URL ?>public/img/Usuario/ventas.png" class="lista_img">
                        <a href="#" class="nav_link"> VENTAS </a>
                        <img src="<?= APP_URL ?>public/img/Usuario/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="./ventas.php" class="nav_link nav_link--inside"> DETALLE DE VENTA </a>
                        </li>

                    </ul>
                </li>


            </ul>

        </nav>
        <div id="principal">
            <!-- imagenes de los productos-->
            <div id="contenido-a-actualizar">
                <div class="contenido">
                    <div class="inicio">
                        <h1>Inicio</h1>
                    </div>
                    <div class="contenido">
                        <div class="contenido_titulo">
                            <h1>Tienda la mano de Dios</h1>
                        </div>
                        <div class="contenido_parrafo">
                            <h3 class="contenido_parrafo_1">Ofrecemos un mejor servicio a nuestros clientes con nuestro
                                software</h3>
                        </div>
                        <div class="imagenes">
                            <div class="imagenes_imagen1">
                                <img src="<?= APP_URL ?>public/img/Usuario/lista_de_chequeo_logo-removebg-preview.png"
                                    alt="check list" width="250px">
                            </div>
                            <div class="imagenes_imagen2">
                                <img src="<?= APP_URL ?>public/img/Usuario/confirmacion_logo-removebg-preview.png"
                                    alt="confirmacion" width="250px">
                            </div>
                            <div class="imagenes_imagen3">
                                <img src="<?= APP_URL ?>public/img/Usuario/dinero-removebg-preview.png" alt="dinero"
                                    width="250px">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!-- Pie de pagina -->

    <script src="<?= APP_URL ?>public/js/pagos.js"></script>
    <?php require_once './app/view/inc/footer.php' ?>