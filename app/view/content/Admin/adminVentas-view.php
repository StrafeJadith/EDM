<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

?>

    <?php require_once './app/view/inc/headAdmin.php' ?>
    <link rel="stylesheet" href="<?= APP_URL; ?>public/css/Administrador/Ventas.css">

    
</head>

<body>


    <section>
        <div class="contenedorprincipal">

            <?php require_once './app/view/inc/MenuLateral.php' ?>


            <div class="apartadoVentas">

                    <div id="tittleVentas">

                        <h1><strong>Ventas</strong></h1>

                    </div>
                <br><br>
                <div id="tableVentas">
                    <table id="table1">
                        <tr>
                            <td><strong>ID VENTA</strong></td>
                            <td><strong>PRODUCTO</strong></td>
                            <td><strong>PRECIO UNITARIO</strong></td>
                            <td><strong>CANTIDAD</strong></td>
                            <td><strong>VALOR TOTAL</strong></td>



                        </tr>

                        <tbody>
                            <?php

                            $query = $insLogin->ejecutarConsulta("SELECT * FROM ventas Where Estado_VENT = 'Confirmado' ");
                            $rows = $query->fetchAll(PDO::FETCH_ASSOC);


                            foreach($rows as $row) { ?>
                            <tr>

                                <td><?php echo $row['ID_VENT'] ?></td>
                                <td><?php echo $row['Nombre_VENT'] ?></td>
                                <td><?php echo $row['Precio_VENT'] ?></td>
                                <td><?php echo $row['Cantidad_VENT'] ?></td>
                                <td><?php echo $row['Valor_total'] ?></td>

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
                            $sql = $insLogin->ejecutarConsulta("SELECT sum(v.Valor_total)  FROM ventas v Where v.Estado_VENT = 'Confirmado'");
                            
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