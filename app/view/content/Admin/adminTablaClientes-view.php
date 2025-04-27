<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

    $usuariosPorPagina = 5;
    $paginaActual =  isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $usuariosPorPagina;

    $totalUsuariosQuery = $insLogin->ejecutarConsulta("SELECT COUNT(*) as total FROM usuarios WHERE ID_TU = 3");
    $totalUsuarios = $totalUsuariosQuery->fetch();
    $totalPaginas = ceil($totalUsuarios['total'] / $usuariosPorPagina);
?>

    <?php require_once './app/view/inc/headAdmin.php' ?>
    <link rel="stylesheet" href="<?php echo APP_URL ?>public/css/Administrador/AdministradorUsuarios.css">
    
    
</head>
<body>
    
<?php require_once './app/view/inc/headerAdmin.php' ?>

    <section>

        <div class="contenedorprincipal">

            <?php require_once './app/view/inc/MenuLateral.php' ;
            
            
            
            ?>

                <div class="apartadoClientes">

                    <div id="tittleDashboard">
                        <h1><strong>Usuarios</strong></h1>
                    </div>

                    <div id="tablaUsers">

                        <div id="Reportes">
                            <a href="<?= APP_URL; ?>adminReportesUsuarios/" class="btn" id="generarReportesUs"><strong>Generar reportes de usuarios</strong></a>
                        </div>
                        
                        <br>
                            <table id="Cl">
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

                                        $query = $insLogin->ejecutarConsulta("SELECT * FROM usuarios WHERE ID_TU = 3 LIMIT $usuariosPorPagina OFFSET $offset"); 
                                        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
                                        foreach($rows as $rowusu) { ?>
                                    
                                        <tr>
                                            <td><?php echo $rowusu['ID_US']; ?></td>
                                            <td><?php echo $rowusu['Nombre_US']; ?></td>
                                            <td><?php echo $rowusu['Correo_US']; ?></td>
                                            <td><?php echo $rowusu['Direccion_US']; ?></td>
                                            <td><?php echo $rowusu['Telefono_US']; ?></td>

                                            <td>
                                                <button id="editarUs" class="editarProd" data-bs-toggle="modal" data-bs-target="#ModalEditUs<?php echo $rowusu['ID_US'];?>">
                                                    <img src="<?= APP_URL; ?>public/img/Administrador/Editar.png" alt="Editar" id="editarImg">
                                                </button>
                                            </td>

                                            <td>
                                                <button id="deleteUs" data-bs-toggle="modal" data-bs-target="#ModalDeleteUs<?php echo $rowusu['ID_US']; ?>">
                                                    <img src="<?= APP_URL; ?>public/img/Administrador/Eliminar.png" alt="Eliminar" id="deleteImg">
                                                </button>
                                            </td>

                                            <?php include './app/view/Modals/ModalEliminarUs.php'; ?>
                                            <?php include './app/view/Modals/ModalEditarUs.php'; ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <!-- Flechas de paginación -->
                            <div class="paginacion">
                                    <!-- Flecha izquierda -->
                                <?php if ($paginaActual > 1): ?>
                                    <a href="?pagina=<?php echo $paginaActual - 1; ?>">
                                        <img src="<?= APP_URL; ?>public/img/Administrador/FlechaIzquierda.png" class="Flechas" alt="Anterior">
                                    </a>
                                <?php else: ?>
                                        <!-- Imagen deshabilitada -->
                                        <img src="<?= APP_URL; ?>public/img/Administrador/FlechaIzquierda.png" class="Flechas" alt="Anterior" style="opacity: 0.5; cursor: default;">

                                <?php endif; ?>

                                    <!-- Flecha derecha -->
                                <?php if ($paginaActual < $totalPaginas): ?>
                                    <a href="<?= APP_URL; ?>adminTablaClientes/?pagina=<?php echo $paginaActual + 1; ?>">


                                        <img src="<?= APP_URL; ?>public/img/Administrador/FlechaDerecha.png" class="Flechas" alt="Siguiente">
                                    </a>
                                    <?php else: ?>
                                        <!-- Imagen deshabilitada -->
                                        <img src="<?= APP_URL; ?>public/img/Administrador/FlechaDerecha.png" class="Flechas" alt="Siguiente" style="opacity: 0.5; cursor: default;">
                                    
                                    <?php endif; ?>

                                    
                            </div>
                    </div>
            </div>
        </div>
    
    </section>
    
    <?php require_once './app/view/inc/footer.php' ?>