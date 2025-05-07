<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

?>

    <link rel="stylesheet" href="<?= APP_URL ?>public/css/vendedor/creditosUS.css">
    
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
            <?php require_once './app/view/inc/menuLateralSales.php'  ?>
            <div class="apartados">
                <div class="barra_busqueda">
                    <form action="./CreditosUsuario.php" method="post">
                        <input type="number" name="Id" placeholder="Id del cliente"><button type="submit" name="BuscarCliente">Buscar</button><button type="submit" name="Reiniciar">Reiniciar</button>
                    </form>
                </div>
                <h3 class="titulotabla">Créditos Usuarios</h3>
                <div class="contenedorusuarios">
                    <table class="tablausuarios">
                        <thead>
                            <tr>
                                <br>
                                <th>NOMBRE</th>
                                <th>APELLIDO</th>
                                <th>TELEFONO</th>
                                <th>DIRECCION</th>
                                <th>ESTADO</th>
                                <th>FECHA</th>
                                <th>VALOR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //variable de consunlta
                            
                            // include("../../controller/controllerVendedor.php");

                            $sql = $insLogin->ejecutarConsulta("SELECT * FROM credito");
                            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
                        
                            foreach($rows as $row) { ?>
                                <tr>
                                    <td><?php echo $row['Nombre_CR'] ?></td>
                                    <td><?php echo $row['Correo_CR'] ?></td>
                                    <td><?php echo $row['Telefono_CR'] ?></td>
                                    <td><?php echo $row['Direccion_CR'] ?></td>
                                    <td><?php echo $row['Estado_CR'] ?></td>
                                    <td><?php echo $row['Fecha_CR'] ?></td>
                                    <td><?php echo $row['Valor_CR'] ?></td>
                                </tr>
                            <?php }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <script src="<?= APP_URL ?>public/js/pagos.js"></script>