<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

?>

    <link rel="stylesheet" href="<?= APP_URL; ?>public/css/Usuario/ventas.css">
    
</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL; ?>public/img/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="    Buscar...                                                                                                     🔎        "
                                style="width: 450px; border-radius: 20px; height: 40px;">
                        </div>
                    </form>
                </div>


                <?php require_once './app/view/inc/navUser.php' ?>
            </div>

        </div>
    </header>
    <!--Menu de los productos -->
    <div class="contentContent">

        <?php require_once './app/view/inc/menuLateralUser.php' ?>

        <div id="principal">
            <!-- imagenes de los productos-->
            <div id="contenido-a-actualizar">

                <h2>ventas realizadas por clientes</h2>
                <table>
                    <tr>
                        <td><strong>ID VENTA</strong></td>
                        <td><strong>ID USUARIO</strong></td>
                        <td><strong>NOMBRE USUARIO</strong></td>
                        <td><strong>PRODUCTO</strong></td>
                        <td><strong>PRECIO UNITARIO</strong></td>
                        <td><strong>CANTIDAD</strong></td>
                        <td><strong>VALOR TOTAL</strong></td>

                    </tr>

                    <tbody>
                        <?php
                        $correo = $_SESSION['correo'];
                        $query = $insLogin->ejecutarConsulta("SELECT u.ID_US, u.Nombre_US, v.* FROM ventas v, usuarios u 
                        WHERE v.ID_US = u.ID_US 
                        AND v.Estado_VENT = 'Confirmado' AND u.Correo_US = '$correo'");
                        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach($resultado as $row) { ?>
                            <tr>

                                <td><?php echo $row['ID_VENT'] ?></td>
                                <td><?php echo $row['ID_US'] ?></td>
                                <td><?php echo $row['Nombre_US'] ?></td>
                                <td><?php echo $row['Nombre_VENT'] ?></td>
                                <td><?php echo $row['Precio_VENT'] ?></td>
                                <td><?php echo $row['Cantidad_VENT'] ?></td>
                                <td><?php echo $row['Valor_total'] ?></td>



                            <?php } ?>

                        </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    </div>

    <?php require_once './app/view/inc/footer.php' ?>
    <script src="<?= APP_URL ?>public/js/pagos.js"></script>
