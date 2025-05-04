<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

    $usuariosPorPagina = 5;
    $paginaActual =  isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $usuariosPorPagina;

    $totalUsuariosQuery = $insLogin->ejecutarConsulta("SELECT COUNT(*) as total FROM usuarios WHERE ID_TU = 2");
    $totalUsuariosQuery = $totalUsuariosQuery->fetch();
    $totalPaginas = ceil($totalUsuariosQuery['total'] / $usuariosPorPagina);
    // include './app/view/inc/paginacionHead.php';

?>

    <?php require_once './app/view/inc/headAdmin.php' ?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>public/css/Administrador/AdministradorUsuarios.css">
    
</head>
<body>


    <section>
        <div class="contenedorprincipal">
            
            <?php require_once './app/view/inc/MenuLateral.php' ?>
    

            <div class="apartadoVendedores">
                <div id="tittleDashboard">
                    <h1><strong>Vendedores</strong></h1>
                </div>
                

                <div class="TablaAgregarVen">
                    <button id="aggVen" data-bs-toggle="modal" data-bs-target="#ModalVen"><strong>Agregar Vendedores</strong></button>
                        <div id="Reportes">
                            <a href="<?= APP_URL; ?>adminReportesVendedores/" class="btn" id="generarReportesVen" type="submit"><strong>Generar reportes de vendedores</strong></a>
                        </div>
                    <table id="TableVen">
                        <tr>
                            <td><strong>IDENTIFICACION</strong></td>
                            <td><strong>NOMBRE</strong></td>
                            <td><strong>CORREO</strong></td>
                            <td><strong>DIRECCION</strong></td>
                            <td><strong>TELEFONO</strong></td>
                            <td><strong>EDITAR</strong></td>
                            <td><strong>ELIMINAR</strong></td>
                            
                            
                        </tr>                  
                        <tbody>
                            
                            
                                <?php

                                
                                    
                                    $queryVen = $insLogin->ejecutarConsulta("SELECT * FROM usuarios WHERE ID_TU = 2 LIMIT $usuariosPorPagina OFFSET $offset");
                                    $row = $queryVen->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    foreach($row as $rowVen){ ?>
                                    <tr>
                                            <td><?php echo $rowVen['ID_US'] ?></td>
                                            <td><?php echo $rowVen['Nombre_US'] ?></td>
                                            <td><?php echo $rowVen['Correo_US'] ?></td>
                                            <td><?php echo $rowVen['Direccion_US'] ?></td>
                                            <td><?php echo $rowVen['Telefono_US'] ?></td>
                                        
                                            
                                            <td>
                                                <button class="editarVen" id="editarVendedor" name="Editar" data-bs-toggle="modal" data-bs-target="#ModalEditVen<?php echo $rowVen['ID_US']; ?>"><img src="<?= APP_URL ?>public/img/Administrador/Editar.png" alt="Editar" id="editarImg"></button>
                                            </td>
                                            
                                            <td>
                                            <button id="deleteVendedor" data-bs-toggle="modal" data-bs-target="#ModalEliminarVen<?php echo $rowVen['ID_US']; ?>"><img src="<?= APP_URL ?>public/img/Administrador/Eliminar.png" alt="Eliminar" id="deleteImg"></button>
                                            </td>
                                            <?php include './app/view/Modals/ModalEliminarVen.php' ?>
                                            <?php include './app/view/Modals/ModalEditVen.php' ?>
                                            
                                    <?php } ?>    
                                    
                            </tr>  
                        </tbody>   
                    </table>
                            <?php include './app/view/Modals/ModalVen.php' ?>

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
                            <?php //include './app/view/inc/paginacionFoot.php' ?>
                            
                </div>
            </div>
        </div>
    </section>
    
    <script src="<?= APP_URL ?>public/js/pagos.js"></script> 