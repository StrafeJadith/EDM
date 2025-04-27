<?php 
    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

    $productosPorPagina = 3;
    $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $productosPorPagina;
    
    $totalProductoQuery = $insLogin->ejecutarConsulta("SELECT COUNT(*) as total FROM productos");
    $totalResult = $totalProductoQuery->fetch();
    $totalPaginas = ceil($totalResult['total'] / $productosPorPagina);
?>

    <?php require_once './app/view/inc/headAdmin.php' ?>
    <link rel="stylesheet" href="<?= APP_URL; ?>public/css/Administrador/AdministradorProductos.css">
</head>
<body>

    <?php require_once './app/view/inc/headerAdmin.php' ?>

    <section>
        <div class="contenedorprincipal">
            
            <?php require_once './app/view/inc/MenuLateral.php' ?>

            <div class="apartadoProductos">

                <div id="tittleDashboard">
                    <h1><strong>Productos</strong></h1>
                </div>

                

                <div id="tablaProductos">

                    <button class="AggProd" data-bs-toggle="modal" data-bs-target="#ModalPro"><strong>Agregar Productos</strong></button>
                    <br><br><br>

                    <div id="Reportes">
                        <a href="./ReportesProductos.php" class="btn" id="generarReportesProd"><strong>Generar reportes de vendedores</strong></a>
                    </div>

                    
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
                            <td><strong>EDITAR</strong></td>
                            <td><strong>ELIMINAR</strong></td>
                            
                            
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
                                        
                                        <td>
                                            <button id="editPro" class="editarProd" name="EditarProd" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['ID_PRO']; ?>"><img src="<?= APP_URL ?>public/img/Administrador/Editar.png" alt="Editar" id="editImg"></button></td>
                                        
                                        <td>
                                            <button id="deletePro" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['ID_PRO']; ?>"><img src="<?= APP_URL ?>public/img/Administrador/Eliminar.png" alt="Eliminar" id="deleteImg"></button>
                                        </td>
                                        
                                        
                                        <?php include("./app/view/Modals/ModalEditar.php") ?>
                                        <?php include("./app/view/Modals/ModalEliminar.php") ?>
                                <?php } ?>    
                                    
                        </tr>  
                        </tbody>
                                
                    </table>
                    
                    <?php include './app/view/Modals/modal_agregar_productos.php'; ?>

                    
                
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

        
    <?php include './app/view/inc/footer.php' ?>