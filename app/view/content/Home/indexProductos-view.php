
<?php require_once "./app/view/inc/headInicio.php" ?>
<link rel="stylesheet" href="<?=APP_URL; ?>public/css/Productos/menu.css">
    
</head>

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
                    <a href="productos.php">
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
                                <li><a href="Productos/verduras.php">Verduras y Frutas</a></li>
                                <li><a href="Productos/granos.php">Granos</a></li>
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
                                <li><a href="Productos/higienefacial.php">Higiene facial</a></li>
                                <li><a href="Productos/higienecorporal.php">Higiene corporal</a></li>
                                <li><a href="Productos/higienebucal.php">Higiene bucal</a></li>
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
                                <li><a href="Productos/limpieza.php">Productos de limpieza</a></li>
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
                            <summary>otros</summary>
                            <br>
                            <ul>
                                <li><a href="Productos/otros.php">1</a></li>
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
                        $sql = $insLogin->ejecutarConsulta("SELECT * FROM productos");
                        $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
                        foreach($rows as $row) { ?>

                            <div id="div1">
                                <form class="FormularioAjax" action="<?= APP_URL ?>app/ajax/carritoUserAjax.php" method="post">
                                    <input type="hidden" name="modulo_carrito" value="agregarProd">
                                    <div class="imagenpro">
                                        <img src="<?= APP_URL.$row['Img'] ?>" alt="" class="imgpro"><br>
                                    </div>
                                    <div class="nombrepro">
                                        <input type="hidden" name="Nombre_PRO" value="<?php echo $row['Nombre_PRO'] ?>">
                                        <input type="hidden" name="ID_PRO" value="<?php echo $row['ID_PRO'] ?>">
                                        <strong><?php echo $row['Nombre_PRO'] ?></strong><br>
                                    </div>
                                    <br>
                                    <div class="descripcionpro">
                                        <p class="descripcion"><?php echo $row['Descripcion_PRO'] ?></p>
                                    </div>
                                    <div class="preciopro">
                                        <input type="hidden" name="Precio_PRO" value="<?php echo $row['Valor_Unitario'] ?>">
                                        <strong><?php echo $row['Valor_Unitario'] ?></strong><br>
                                        <input type="number" placeholder="Cantidad" size="10" name="Cantidad_PRO">
                                    </div>
                                    <div class="agregarcarrito">
                                        <br>
                                        <button type="submit" name="Guardar" value="">Agregar al carrito</button>
                                    </div>
                                </form>
                            </div>

                        <?php } ?>
                    </center>
                </div>
            </div>
        </div>
    </section>
    <?php require_once './app/view/inc/footer.php' ?>
