<?php  
    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

    $categoriaPorPagina = 5;
    $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $categoriaPorPagina;

    $totalCategoriaQuery = $insLogin->ejecutarConsulta("SELECT COUNT(*) as total FROM categoria_producto");
    $totalResult = $totalCategoriaQuery->fetch();
    $totalPaginas = ceil($totalResult['total'] / $categoriaPorPagina);
?>

    <?php require_once './app/view/inc/headAdmin.php' ?>
    <link rel="stylesheet" href="<?= APP_URL;?>public/css/Administrador/AdministradorCategorias.css">
    
</head>
<body>

    <?php require_once './app/view/inc/headerAdmin.php' ?>

    <section>
        <div class="contenedorprincipal">

            <?php require_once './app/view/inc/MenuLateral.php' ?>

            <div class="apartadoCategoria">
                    <div id="tittleDashboard">

                        <h1><strong>Categorias</strong></h1>

                    </div>
            
                <div id="ContenidoCat">

                    <!--modal de agregar categorias -->
                    <button type="button" class="btn1 btn btn-info" data-bs-toggle="modal" data-bs-target="#guardar_cat" id="btnNuevaCat"><strong>Nueva Categoria</strong></button>
                    <br><br>

                    <?php  include('./app/view/Modals/modal_guardar_categoria.php'); ?>
                    

                    <table id="tablaCat">
                    
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <Tbody>
                            <?php 
                                $queryCa = $insLogin->ejecutarConsulta("SELECT * FROM categoria_producto LIMIT $categoriaPorPagina OFFSET $offset");
                                $rows = $queryCa->fetchAll(PDO::FETCH_ASSOC);

                                foreach($rows as $row){
                            ?>

                            <tr>
                                <td><?php echo $row['ID_CAT']?></td>
                                <td><?php echo $row['Nombre_CAT']?></td>
                                <td>
                    
                                    <div id="editCat" data-bs-toggle="modal" data-bs-target="#editar_categoria<?php echo $row['ID_CAT']?>"><img src="<?= APP_URL;?>public/img/Administrador/Editar.png" alt="" class="btnedit" id="editImg"></div>
                                
                                </td>

                                <td>

                                <div id="deleteCat" data-bs-toggle="modal" data-bs-target="#delete_categoria<?php echo $row['ID_CAT']?>"><img src="<?= APP_URL;?>public/img/Administrador/Eliminar.png" alt="" class="btnedit" id="deleteImg"></div>
                                    
                                </td>
                            </tr>
                        
                        <?php
                                include('./app/view/Modals/modal_edit_categoria.php');
                                include('./app/view/Modals/modal_delete_categoria.php'); }?>
                        </Tbody>
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

    <?php include './app/view/inc/footer.php' ?>