<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

    $productosPorPagina = 4;
    $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $productosPorPagina;
    
    $totalProductoQuery = $insLogin->ejecutarConsulta("SELECT COUNT(*) as total FROM productos");
    $totalResult = $totalProductoQuery->fetch();
    $totalPaginas = ceil($totalResult['total'] / $productosPorPagina);

?>
    <link rel="stylesheet" href="<?= APP_URL ?>public/css/vendedor/Existencias.css">
    
</head>

<body>
    <!-- <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL ?>public/img/Usuario/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">
                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="Buscar...                                                                               🔎        "
                                style="width: 450px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header> -->
    <section>
        <div class="contenedorprincipal">
            <?php require_once './app/view/inc/menuLateralSales.php' ?>
            <div class="apartados">
                <h3 class="titulotabla">Existencias Productos</h3>

                    <div id="tablaProductos">
                        <table id="tablaProd">
                            <tr>
                                <td><strong>PRODUCTOS</strong></td>
                                <td><strong>ID</strong></td>
                                <td><strong>NOMBRE</strong></td>
                                <td><strong>DESCRIPCION</strong></td>
                                <td><strong>CATEGORIA</strong></td>
                                <td><strong>VALOR UNITARIO</strong></td>
                                <td><strong>CANTIDAD TOTAL</strong></td>
                                <td><strong>CANTIDAD EXISTENTE</strong></td>
                                <td><strong>FECHA ENTRADA</strong></td>
                                <td><strong>FECHA SALIDA</strong></td>
                                
                                
                            </tr>

                            <tbody>
                            
                                <?php

                                    $query = $insLogin->ejecutarConsulta("SELECT c.Nombre_CAT,p.* FROM productos p, categoria_producto c where p.ID_CAT = c.ID_CAT LIMIT $productosPorPagina OFFSET $offset");
                                    $rows = $query->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    
                                    foreach($rows as $row){ ?>
                                    <tr>
                                            <td><img src='<?= APP_URL.$row['Img']; ?>' alt=""></td>
                                            <td><?php echo $row['ID_PRO'] ?></td>
                                            <td><?php echo $row['Nombre_PRO'] ?></td>
                                            <td><?php echo $row['Descripcion_PRO'] ?></td>
                                            <td><?php echo $row['Categoria_PRO'] ?></td>
                                            <td><?php echo $row['Valor_Unitario'] ?></td>
                                            <td><?php echo $row['Cantidad_Total'] ?></td>
                                            <td><?php echo $row['Cantidad_Existente'] ?></td>
                                            <td><?php echo $row['Fecha_Entrada'] ?></td>
                                            <td><?php echo $row['Fecha_Expedicion']?></td>
                                            
                                    <?php } ?>    
                                        
                            </tr>  
                            </tbody>
                                    
                        </table>

                        <div class="paginacion">

                                <?php if ($paginaActual > 1): ?>
                                    <a href="?pagina=<?php echo $paginaActual - 1; ?>">
                                        <img src="<?= APP_URL ?>public/img/Administrador/FlechaIzquierda.png" class="Flechas" alt="Anterior">
                                    </a>

                                    <?php else: ?>
                                        <img src="<?= APP_URL ?>public/img/Administrador/FlechaIzquierda.png" class="Flechas" alt="Anterior" style="opacity: 0.5; cursor: default;">
                                    <?php endif; ?>
                                    
                                    <?php if ($paginaActual < $totalPaginas): ?>
                                        <a href="?pagina=<?php echo $paginaActual + 1; ?>">
                                            <img src="<?= APP_URL ?>public/img/Administrador/FlechaDerecha.png" class="Flechas" alt="Siguiente">
                                        </a>
                                    
                                    <?php else: ?>
                                        <img src="<?= APP_URL ?>public/img/Administrador/FlechaDerecha.png" class="Flechas" alt="Siguiente" style="opacity: 0.5; cursor: default;">
                                    <?php endif; ?>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= APP_URL ?>public/js/pagos.js"></script>