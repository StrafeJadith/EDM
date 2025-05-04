<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }
?>

    <?php require_once './app/view/inc/headAdmin.php' ?>
    <link rel="stylesheet" href="<?= APP_URL ?>public/css/Administrador/Ventas.css">
    <!-- <link rel="stylesheet" href="../../../public/css/Administrador/AdministradorDashboard.css"> -->
    
</head>

<body>


    <section>

        <div class="contenedorprincipal">

            <?php require_once './app/view/inc/MenuLateral.php' ?>

            <div class="apartadoVentas">
                <div id="tittleDetalleVentas">

                    <h1><strong>Detalle de Ventas</strong></h1>

                </div>
                <br><br>
                <div id="tableVentas">
                    <table id="table1">
                        <tr>
                            <td><strong>ID CLIENTE</strong></td>
                            <td><strong>NOMBRE</strong></td>
                            <td><strong>VALOR TOTAL</strong></td>
                            <td><strong>FECHA</strong></td>
                            <td><strong>METODO DE PAGO</strong></td>

                        </tr>

                        <tbody>
                            <?php

                            $query = $insLogin->ejecutarConsulta(" SELECT u.Nombre_US, m.Tipo_Pago_MTP, dv.* 
                            FROM detalle_de_venta dv, usuarios u, metodo_pago m 
                            WHERE dv.ID_US = u.ID_US and dv.ID_MTP = m.ID_MTP ");
                            
                            $rows = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach($rows as $row) { ?>
                            <tr>
                                <td><?php echo $row['ID_US'] ?></td>
                                <td><?php echo $row['Nombre_US'] ?></td>
                                <td><?php echo $row['TOTAL_DV'] ?></td>
                                <td><?php echo $row['FECHA_DV'] ?></td>
                                <td><?php echo $row['Tipo_Pago_MTP'] ?></td>
                                <?php } ?>

                            </tr>
                        </tbody>

                    </table>
                    <br>
                    <table id="table2">
                        <thead>
                            <tr>
                                <td>VALOR TOTAL</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = $insLogin->ejecutarConsulta("SELECT sum(TOTAL_DV)  FROM  detalle_de_venta ");
                            
                                $row = $sql->fetch();
                                $sum = (int) $row[0];
                            

                            ?>

                            <tr>
                                <td><?php echo $sum ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>



    <script src="<?= APP_URL ?>public/js/pagos.js"></script> 