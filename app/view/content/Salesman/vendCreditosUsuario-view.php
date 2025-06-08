<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

?>

    <link rel="stylesheet" href="<?= APP_URL ?>public/css/vendedor/creditosUS.css">
    
</head>

<body>
    <section>
        <div class="contenedorprincipal">
            <?php require_once './app/view/inc/menuLateralSales.php'  ?>
            <div class="apartados">
                <div class="barra_busqueda">
                    <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/sellerAjax.php" method="POST" autocomplete="off">

                        <input type="hidden" name="modulo_vendedor" value="ConsultarCreditos">

                        <div class="">

                                    <span class="input-group-text" id="basic-addon1"><strong>Identificacion del credito</strong></span>
                                    <input type="number" class="form-control" name="id_credito_usuario" placeholder="Id de credito" aria-label="ingrese su cedula" aria-describedby="basic-addon1" maxlength="15"><br>
                        </div>

                        <button type="submit" id="btnForm1" data-accion="Consultar"><strong>Consultar</strong></button>

                    </form>
                    <!-- <form action="./CreditosUsuario.php" method="post">
                        <input type="number" name="Id" placeholder="Id del cliente"><button type="submit" name="BuscarCliente">Buscar</button><button type="submit" name="Reiniciar">Reiniciar</button>
                    </form> -->
                </div>
                <h3 class="titulotabla">Créditos Usuarios</h3>
                <div class="contenedorusuarios">
                    <table class="tablausuarios" id="tablaCreditos">
                        <thead>
                            <tr>
                                <br>
                                <th>ID CREDITO</th>
                                <th>NOMBRE</th>
                                <th>CORREO</th>
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
                                    <td><?php echo $row['ID_CR'] ?></td>
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