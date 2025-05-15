<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }
?>


    <link rel="stylesheet" href="<?= APP_URL ?>public/css/Usuario/index_.css">
    <link rel="stylesheet" href="<?= APP_URL?>public/css/Usuario/sidevar.css">
    
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


                <?php require_once './app/view/inc/navUser.php' ?>
            </div>

        </div>
    </header>
    <!--Menu de los productos -->
    <div class="containerMid">
        <?php require_once './app/view/inc/menuLateralUser.php' ?>
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


    <!-- Botón para abrir el carrito -->
    <button id="openCart" class="esconderCarrito" ><img src="<?= APP_URL ?>public/img/Usuario/Carrito.png" width="40px" height="40px" style="margin-top: -18px;"></button>

    <!-- Sidebar del carrito -->
    <div id="cartSidebar" class="sidebar">
        <button id="closeCart">✖</button>
        <h2 style="color: #804e23;">Tu Carrito</h2>
        <div id="cartItems">
            
                <?php
            $sql = $insLogin->ejecutarConsulta("SELECT * FROM productos");
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $row) { ?>

                <div id="Producto1">
                    
                    <img src="<?= APP_URL.$row['Img'] ?>" alt="" class="imgpro" width="100px">

                    <p class="descripcion"><strong><?php echo $row['Descripcion_PRO'] ?></strong></p>

                    <p><strong><?php echo $row['Valor_Unitario'] ?></strong></p><br>

                    <button><strong>Agregar al carrito</strong></button>

                </div>

            <?php } ?>
            
        </div>
    </div>

    <script src="<?= APP_URL ?>public/js/pagos.js"></script>
    <script src="<?= APP_URL ?>public/js/sidevar.js"></script>
    <?php require_once './app/view/inc/footer.php' ?>