<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

?>
    <link rel="stylesheet" href="<?= APP_URL ?>public/css/vendedor/Existencias.css">
    
</head>

<body>
    <header id="headerCreditos">
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
    </header>
    <section>
        <div class="contenedorprincipal">
            <?php require_once './app/view/inc/menuLateralSales.php' ?>
            <div class="apartados">
                <h3 class="titulotabla">Existencias Productos</h3>
                <div class="contenedorusuarios">
                    <table class="tablausuarios">
                        <thead>
                            <tr>
                                <td>ID</td>
                                <td>NOMBRE</td>
                                <td>DESCRIPCION</td>
                                <td>CATEGORIA</td>
                                <td>VALOR_UNITARIO</td>
                                <td>CANTIDAD_TOTAL</td>
                                <td>CANTIDAD_EXISTENTES</td>
                                <td>FECHA_ENTRADA</td>
                                <td>FECHA_EXPEDICION</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $sql = $insLogin->ejecutarConsulta("SELECT * FROM productos");
                            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
                            foreach($rows as $row) { ?>
                                <tr>
                                    <td><?php echo $row['ID_PRO'] ?></td>
                                    <td><?php echo $row['Nombre_PRO'] ?></td>
                                    <td><?php echo $row['Descripcion_PRO'] ?></td>
                                    <td><?php echo $row['Categoria_PRO'] ?></td>
                                    <td><?php echo $row['Valor_Unitario'] ?></td>
                                    <td><?php echo $row['Cantidad_Total'] ?></td>
                                    <td><?php echo $row['Cantidad_Existente'] ?></td>
                                    <td><?php echo $row['Fecha_Entrada'] ?></td>
                                    <td><?php echo $row['Fecha_Expedicion'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php require_once './app/view/inc/footer.php' ?>