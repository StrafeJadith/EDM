
    <link rel="stylesheet" href="<?= APP_URL ?>public/css/Usuario/productos_carrito.css">

</head>

<body>
    <div>
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
                                    style="width: 450px; border-radius: 20px;">
                            </div>
                        </form>
                    </div>


                    <?php require_once './app/view/inc/navUser.php' ?>
                    
                </div>

            </div>
        </header>

        <br><br><br><br><br>
        <br><br><br><br><br><br>
        <!--Menu de los productos -->
        <div id="principal">

            <!-- imagenes de los productos-->

            <div class="productosima">
                <table>
                    <tr>
                        <!-- <td><strong>ID VENTA</strong></td> -->
                        <td><strong>PRODUCTO</strong></td>
                        <td><strong>PRECIO UNITARIO</strong></td>
                        <td><strong>CANTIDAD</strong></td>
                        <td><strong>VALOR TOTAL</strong></td>
                        <td><strong>CANCELAR PRODUCTO</strong></td>




                    </tr>

                    <tbody>
                        <?php
                        $correo = $_SESSION['correo'];

                        $query = $insLogin->ejecutarConsulta("SELECT v.* FROM ventas v, usuarios u Where v.ID_US = u.ID_US AND v.Estado_VENT = 'Proceso' AND u.Correo_US = '$correo'");
                        $resultado = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach($resultado as $row) { ?>
                            <tr>
                                <td><?php echo $row['Nombre_VENT'] ?></td>
                                <td><?php echo $row['Precio_VENT'] ?></td>
                                <td><?php echo $row['Cantidad_VENT'] ?></td>
                                <td><?php echo $row['Valor_total'] ?></td>

                            <form class="FormularioAjax" action="<?= APP_URL ?>app/ajax/comprasUsuariosAjax.php" method="post">

                                <input type="hidden" name="ID_VENT" value="<?php echo $row['ID_VENT']?>">
                                <input type="hidden" name ="Nombre_VENT" value="<?php echo $row['Nombre_VENT']?>">
                                <input type="hidden" name ="Cantidad_VENT" value="<?php echo $row['Cantidad_VENT']?>">
                                <input type="hidden" name="modulo_compras" value="eliminarProd">

                                <button type="submit" class="deleteProd"><img src="<?= APP_URL ?>public/img/Administrador/Eliminar.png" 
                                        alt="Eliminar" class="img">
                                        </button>
                                    </form>
                                    <!--
                                    <a href="../../controller/controllerCarrito.php?IDCancelar=<?php echo $row['ID_VENT'] ?>">
                                        <button type="submit" class="deleteProd" name="Cancelar"><img
                                                src="<?= APP_URL ?>public/img/Administrador/Eliminar.png" alt="Eliminar"
                                                class="img"></button></a>
                        --->
                                </td>

                            </tr>
                        <?php 
                        
                        include './app/view/Modals/modal_metodo_pago.php';
                        }
                        ?>
                    </tbody>

                </table>



                <div class="confirmarCompra">

                <?php

                $traerId = $insLogin->ejecutarConsulta("SELECT ID_US FROM usuarios WHERE Correo_US = '$correo'");
                $resultId = $traerId->fetch();
                $ID_US = $resultId['ID_US'];

                $sql = $insLogin->ejecutarConsulta("SELECT SUM(Valor_Total) AS valorTotal FROM ventas WHERE ID_US = $ID_US");
                $result = $sql->fetch();
                $valorTotal = $result['valorTotal'];
                
                
                ?>

                    <h3><strong>Resumen de compra</strong></h3>
                    <hr>
                    <h3><strong>Valor Total</strong></h3><br>
                    <h3><strong>$<?= $valorTotal ?></strong></h3><br>
                    <button data-bs-toggle="modal" data-bs-target="#metodoPago" type="submit" class="continuarCompra" name="Comprar"><strong>Continuar con la compra</strong></button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once './app/view/inc/footer.php' ?>

