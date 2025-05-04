<?php 

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }
    
    $creditosPorPagina = 4;
    $paginaActual = isset($_GET['pagina']) ? (int) $_GET['pagina'] : 1;
    $offset = ($paginaActual - 1) * $creditosPorPagina;

    $totalCreditosQuery = $insLogin->ejecutarConsulta("SELECT COUNT(*) as total FROM credito");
    $totalRow = $totalCreditosQuery->fetch();
    $totalPaginas = ceil($totalRow['total'] / $creditosPorPagina);
?>

    <?php require_once './app/view/inc/headAdmin.php' ?>
    <link rel="stylesheet" href="<?= APP_URL; ?>public/css/Administrador/AdministradorCreditos.css">
</head>
<body>


    <section>
        <div class="contenedorprincipal">
            

            <?php require_once './app/view/inc/MenuLateral.php' ?>

            <div class="apartadoCreditos">
                    <div id="tittleDashboard">

                        <h1><strong>Creditos</strong></h1>

                    </div>

                <div id="tablaCreditos">

                    <!--modal de agregar creditos -->

                    <table id="Cred">
                    <thead>
                            <tr>
                                <th>CODIGO</th>
                                <th>ID_USUARIO</th>
                                <th>NOMBRE</th>
                                <th>CORREO</th>
                                <th>TELEFONO</th>
                                <th>DIRECCION</th>
                                <th>ESTADO</th>
                                <th>FECHA</th>
                                <th>VALOR</th>
                                <th>ACEPTAR</th>
                                <th>EDITAR</th>
                                <th>ELIMINAR</th>
                            </tr>
                        </thead>
                        <Tbody>
                            <?php 
                                $query = $insLogin->ejecutarConsulta("SELECT c.ID_CR, u.ID_US, u.Nombre_US, c.Correo_CR, c.Telefono_CR,c.Direccion_CR, c.Estado_CR, c.Fecha_CR,c.Valor_CR 
                                FROM credito c, usuarios u 
                                WHERE c.ID_US = u.ID_US LIMIT $creditosPorPagina OFFSET $offset");  
                                $rows = $query->fetchAll(PDO::FETCH_ASSOC);

                                foreach($rows as $row){
                            ?>

                            <tr>
                                
                                <td><?php echo $row['ID_CR']?></td>
                                <td><?php echo $row['ID_US']?></td>
                                <td><?php echo $row['Nombre_US']?></td>
                                <td><?php echo $row['Correo_CR']?></td>
                                <td><?php echo $row['Telefono_CR']?></td>
                                <td><?php echo $row['Direccion_CR']?></td>
                                <td><?php echo $row['Estado_CR']?></td>
                                <td><?php echo $row['Fecha_CR']?></td>
                                <td><?php echo $row['Valor_CR']?></td>

                                <td>

                                    <div id="aceptarCr" data-bs-toggle="modal" data-bs-target="#Aceptar_credito<?php echo $row['ID_CR']?>"><img src="<?= APP_URL; ?>public/img/Administrador/AceptarCreditos.png" alt="" class="btnedit" id="aceptarImg"></div>

                                </td>

                                <td>

                                    <div id="editarCr" data-bs-toggle="modal" data-bs-target="#editar_credito<?php echo $row['ID_CR']?>"><img src="<?= APP_URL; ?>public/img/Administrador/Editar.png" alt="" class="btnedit" id="editarImg"></div>
        
                                </td>

                                <td>
        
                                    <div id="deleteCr" data-bs-toggle="modal" data-bs-target="#delete_creditos<?php echo $row['ID_CR']?>"><img src="<?= APP_URL; ?>public/img/Administrador/Eliminar.png" alt="" id="deleteImg"  ></div>
                                </td>
                            </tr>

                        <?php 
                            include("./app/view/Modals/modal_aceptar_creditos.php");
                            include("./app/view//Modals/modal_delete_creditos.php");
                            include("./app/view/Modals/modal_edit_creditos.php");

                        }?>
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

        
    <script src="<?= APP_URL ?>public/js/pagos.js"></script> 
