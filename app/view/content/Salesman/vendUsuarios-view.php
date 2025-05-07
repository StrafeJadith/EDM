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

    <link rel="stylesheet" href="<?= APP_URL ?>public/css/Vendedor/usuarios.css">
    
</head>

<body>
    <!-- <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL ?>public/img/logo.png" width="350px" height="200px"
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

        <?php require_once './app/view/inc/menuLateralSales.php'?>

            <div class="apartados">
                    <div id="tittleDashboard">
                        <h1><strong>Usuarios</strong></h1>
                    </div>

                    <div id="tablaUsers">
                        
                        <br>
                            <table id="Cl">
                                <tr>
                                    <td><strong>IDENTIFICACION</strong></td>
                                    <td><strong>NOMBRE</strong></td>
                                    <td><strong>CORREO</strong></td>
                                    <td><strong>DIRECCION</strong></td>
                                    <td><strong>TELEFONO</strong></td>
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
    </section>
    