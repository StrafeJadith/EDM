
<?php require_once "./app/view/inc/headInicio.php" ?>
<link rel="stylesheet" href="<?=APP_URL; ?>public/css/Productos/menu.css">
<link rel="stylesheet" href="<?= APP_URL?>public/css/Usuario/sidevar.css">
    
</head>
<?php
if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }
?>
<body>
    <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL; ?>public/img/Producto/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="Buscar...                                                                               🔎        "
                                style="width: 450px; border-radius: 20px;">
                        </div>
                    </form>
                </div>

                <?php require_once './app/view/inc/navHome.php' ?>
            </div>

        </div>
    </header>
    <section>
        <div class="contenedorprincipal">
            <div class="menu">
                <br>
                <br>
                <div class="subtitulomenu">
                    <a href="<?= APP_URL; ?>indexProductos/">
                        <h3>Productos</h3>
                    </a>
                </div>
                <br>
                <br>
                <div class="productos">
                    <div class="imagenalimentos">
                        <img src="<?= APP_URL; ?>public/img/Producto/alimentos.png.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Alimentos</summary>
                            <br>
                            <ul>
                                <li><a href="<?= APP_URL;?>indexProteinas/">Proteinas</a></li>
                                <li><a href="<?= APP_URL; ?>indexVerduras/">Verduras y Frutas</a></li>
                                <li><a href="<?= APP_URL;?>indexGranos/">Granos</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="Aseo">
                    <div class="imagenaseo">
                        <img src="<?= APP_URL; ?>public/img/Producto/aseopersonal.png.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Aseo personal</summary>
                            <br>
                            <ul>
                                <li><a href="<?= APP_URL;?>indexHigieneFacial/">Higiene facial</a></li>
                                <li><a href="<?=APP_URL?>indexHigieneCorporal/">Higiene corporal</a></li>
                                <li><a href="<?=APP_URL?>indexHigieneBucal/">Higiene bucal</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="Limpieza">
                    <div class="imagenlimpieza">
                        <img src="<?= APP_URL; ?>public/img/Producto/aseohogar.png.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Limpieza</summary>
                            <br>
                            <ul>
                                <li><a href="<?=APP_URL?>indexLimpieza/">Productos de limpieza</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="Otros">
                    <div class="imagenotros">
                        <img src="<?= APP_URL; ?>public/img/Producto/otros.png.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Otros</summary>
                            <br>
                            <ul>
                                <li><a href="<?=APP_URL?>indexOtros/">Ver mas</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
            </div>
            <div class="productospopulares">
                <div class="subtitulo">
                    <h2>Productos populares</h2>
                </div>
                <div class="productoscatalogo">
                    <!-- imagenes de los productos-->
                    <center>
                        <?php
                        // 1. Ejecutar consulta
                        $sql = $insLogin->ejecutarConsulta("SELECT * FROM productos");

                        // 2. Obtener todos los productos en un array
                        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);

                        // 3. recorrer $rows para mostrar los productos
                        foreach ($rows as $row) {
                            $idProducto = $row['ID_PRO'];
                            $cantidadExistente = $row['Cantidad_Existente'];
                            // $cantidadExistente = $cantidades[$idProducto]; // o simplemente $row['Cantidad_Existente']
                        ?>

                            <div id="div1">
                                <form class="FormularioAjax" action="<?= APP_URL ?>app/ajax/carritoUserAjax.php" method="post">
                                    <input type="hidden" name="modulo_carrito" value="agregarProd">

                                    <div class="imagenpro">
                                        <img src="<?= APP_URL.$row['Img'] ?>" alt="" class="imgpro"><br>
                                    </div>

                                    <div class="nombrepro">
                                        <input type="hidden" name="Nombre_PRO" value="<?= $row['Nombre_PRO'] ?>">
                                        <input type="hidden" name="ID_PRO" value="<?= $idProducto ?>">
                                        <strong><?= $row['Nombre_PRO'] ?></strong><br>
                                        <strong>Disponible: <?= $cantidadExistente ?></strong><br>
                                    </div>

                                    <div class="descripcionpro">
                                        <p class="descripcion"><?= $row['Descripcion_PRO'] ?></p>
                                    </div>

                                    <div class="preciopro">
                                        <input type="hidden" name="Precio_PRO" value="<?= $row['Valor_Unitario'] ?>">
                                        <strong>$<?= $row['Valor_Unitario'] ?></strong><br>
                                        <input type="number" placeholder="Cantidad" size="10" name="Cantidad_PRO" min="1" max="<?= $cantidadExistente ?>" <?= ($cantidadExistente <= 0 ? 'disabled' : '') ?>>
                                    </div>

                                    <div class="agregarcarrito">
                                        <?php if ($cantidadExistente <= 0): ?>
                                            <button type="submit" disabled>Producto agotado</button>
                                        <?php else: ?>
                                            <button type="submit" name="Guardar">Agregar al carrito</button>
                                        <?php endif; ?>
                                    </div>

                                </form>
                            </div>

                        <?php } ?>

                    </center>
                </div>
            </div>
        </div>
        
    </section>
    <?php require_once 'app/view/inc/sidevarCarrito.php'?>
    <script src="<?= APP_URL ?>public/js/sidevar.js"></script>
    <?php require_once './app/view/inc/footer.php' ?>
    
