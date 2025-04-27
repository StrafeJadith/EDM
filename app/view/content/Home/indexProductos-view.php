<?php

include "./app/model/Conexion.php";
$conexion = new conexion();
$conn = $conexion->getConexion();
?>

<?php require_once "./app/view/inc/headInicio.php" ?>
<link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/Productos/menu.css">
    
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

                <nav id="Nav">
                    <div id="NavList">

                        <ul id="Listas">
                            <a href="<?= APP_URL; ?>inicio/">
                                <li><strong>Inicio</strong></li>
                            </a>
                            <a href="<?= APP_URL; ?>indexProductos/">
                                <li><strong> Productos </strong></li>
                            </a>


                            <?php
                            
                            if (empty($_SESSION['correo'])) { ?>
                                <a href="<?= APP_URL; ?>indexCreditosInicio/">

                                    <li><strong> Creditos </strong></li>
                                </a>
                                <a href="<?= APP_URL; ?>indexHistoria/">
                                    <li><strong> Sobre Nosotros </strong></li>
                                </a>
                                <a href="<?= APP_URL; ?>indexInicio/"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>
                                <a href="<?= APP_URL; ?>indexCreditosInicio/">
                                    <li><strong> Creditos </strong></li>
                                </a>
                                <a href="../controller/controladorcerrarsesion.php"><button type="button" class="btn">Cerrar
                                        Sesión</button></a>

                                <a href="Usuario/carrito_compra.php">
                                    <li><img src="../../public/img/Carrito.png" width="40px" height="40px"
                                            style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="usuario/index_.php">
                                    <li><img src="../../public/img/home.svg" width="40px" height="40px"
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
                        <img src="../../public/img/Producto/alimentos.png.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Alimentos</summary>
                            <br>
                            <ul>
                                <li><a href="Productos/proteinas.php">Proteinas</a></li>
                                <li><a href="Productos/verduras.php">Verduras y Frutas</a></li>
                                <li><a href="Productos/granos.php">Granos</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="Aseo">
                    <div class="imagenaseo">
                        <img src="../../public/img/Producto/aseopersonal.png.png" alt="">
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
                        <img src="../../public/img/Producto/aseohogar.png.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Limpieza del hogar</summary>
                            <br>
                            <ul>
                                <li><a href="Productos/limpieza.php">Productos de limpieza</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="Otros">
                    <div class="imagenotros">
                        <img src="../../public/img/Producto/otros.png.png" alt="">
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
                        $sql = "SELECT * FROM productos";
                        $resultado = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($resultado)) { ?>

                            <div id="div1">
                                <form action="../controller/controllerCarrito.php" method="post">
                                    <div class="imagenpro">
                                        <img src="<?php echo $row['Img'] ?>" alt="" class="imgpro"><br>
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
                                        <input type="hidden" name="Precio" value="<?php echo $row['Valor_Unitario'] ?>">
                                        <strong><?php echo $row['Valor_Unitario'] ?></strong><br>
                                        <input type="number" placeholder="Cantidad" size="10" name="Cantidad">
                                    </div>
                                    <div class="agregarcarrito">
                                        <br>
                                        <button type="submit" name="Guardar" value="">Agregar al carrito</button>
                                    </div>
                                </form>
                            </div>

                        <?php } ?>
                    </center>
                    <?php
                    // if (isset($_SESSION["msg"])) {
                    //     $msg = $_SESSION["msg"];

                    //     if ($msg) {
                    //         echo ("<script> $msg </script>");

                    //         unset($_SESSION["msg"]);
                    //     }
                    // }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <footer class="footerContainer">
        <div class="contactos">
            <h1>Contactanos</h1>
        </div>
        <div class="socialIcons">
            <a href><i class="fa-brands fa-facebook"></i></a>
            <a href><i class="fa-brands fa-whatsapp"></i></a>
            <a href><i class="fa-brands fa-twitter"></i></a>
            <a href><i class="fa-brands fa-google"></i></a>
        </div>
    </footer>
