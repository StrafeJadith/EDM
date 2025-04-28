<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

?>

    <link rel="stylesheet" href="<?= APP_URL ?>public/css/Vendedor/usuarios.css">
    
</head>

<body>
    <header id="headerCreditos">
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
    </header>
    <section>
        <div class="contenedorprincipal">

        <?php require_once './app/view/inc/menuLateralSales.php'?>

            <div class="apartados">
                <h3 class="titulotabla">Clientes</h3>
                <div class="contenedorusuarios">
                    <table class="tablausuarios">
                        <tr>
                            <br>
                            <th>Identificación</th>
                            <th>Nombre</th>
                            <th>Correo electronico</th>
                            <th>Dirección</th>
                            <th>Telefono</th>
                        </tr>
                        <tbody>
                            <?php

                            $sql =$insLogin->ejecutarConsulta("SELECT * FROM usuarios Where ID_TU = 3");
                            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);

                            foreach( $rows as $row) { ?>
                                <tr>
                                    <td><?php echo $row['ID_US'] ?></td>
                                    <td><?php echo $row['Nombre_US'] ?></td>
                                    <td><?php echo $row['Correo_US'] ?></td>
                                    <td><?php echo $row['Direccion_US'] ?></td>
                                    <td><?php echo $row['Telefono_US'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <?php require_once './app/view/inc/footer.php' ?>