<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../public/css/Usuario/productos_carrito.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../../public/js/alerts.js"></script>
    <script src="../../../public/js/pagos.js"></script>
    <?php
    include('../../model/Conexion.php');
    $conexion = new conexion();
    $conn = $conexion->getConexion();

    
    ?>


</head>

<body>
    <div>
        <header id="headerCreditos">
            <div id="barranav">
                <div id="ContainerNav">
                    <div id="Logos">
                        <img src="../../../public/img/logo.png" width="350px" height="200px"
                            style="padding-left: 10px; padding-top: 0px">

                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control"
                                    placeholder="Buscar...                                                                               🔎        "
                                    style="width: 450px; border-radius: 20px;">
                            </div>
                        </form>
                    </div>


                    <nav id="Nav">
                        <div id="NavList">

                            <ul id="Listas">
                                <a href="../inicio_index.php">
                                    <li><strong> Inicio </strong></li>
                                </a>
                                <a href="../productos.php">
                                    <li><strong> Productos </strong></li>
                                </a>

                                <?php
                                session_start();
                                if (empty($_SESSION['correo'])) { ?>
                                    <a href="./inicio_credito.php">
                                        <li><strong> Creditos </strong></li>
                                    </a>
                                    <a href="../historia.php">
                                        <li><strong> Sobre Nosotros </strong></li>
                                    </a>
                                    <a href="../inicio/inicio.php"><button type="button" class="btn1">Iniciar
                                            Sesion</button></a>

                                <?php } else { ?>
                                    <a href="../CreditosInicio.php">
                                        <li><strong> Creditos </strong></li>
                                    </a>
                                    <a href="../../controller/controladorcerrarsesion.php"><button type="button"
                                            class="btn1">Cerrar Sesión</button></a>

                                    <a href="./carrito_compra.php">
                                        <li><img src="../../../public/img/Carrito.png" width="40px" height="40px"
                                                style="margin-top: -18px;">
                                        </li>
                                    </a>
                                    <a href="./index_.php">
                                        <li><img src="../../../public/img/home.svg" width="40px" height="40px"
                                                style="margin-top: -18px;">
                                        </li>
                                    </a>
                                <?php } ?>



                            </ul>

                        </div>

                    </nav>
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
                        <td><strong>ID VENTA</strong></td>
                        <td><strong>PRODUCTO</strong></td>
                        <td><strong>PRECIO UNITARIO</strong></td>
                        <td><strong>CANTIDAD</strong></td>
                        <td><strong>VALOR TOTAL</strong></td>
                        <td><strong>CANCELAR PRODUCTO</strong></td>




                    </tr>

                    <tbody>
                        <?php
                        $correo = $_SESSION['correo'];

                        $query = "SELECT v.* FROM ventas v, usuarios u Where v.ID_US = u.ID_US AND v.Estado_VENT = 'Proceso' AND u.Correo_US = '$correo'  ";
                        $resultado = mysqli_query($conn, $query);


                        while ($row = mysqli_fetch_array($resultado)) { ?>
                            <tr>

                                <td><?php echo $row['ID_VENT'] ?></td>
                                <td><?php echo $row['Nombre_VENT'] ?></td>
                                <td><?php echo $row['Precio_VENT'] ?></td>
                                <td><?php echo $row['Cantidad_VENT'] ?></td>
                                <td><?php echo $row['Valor_total'] ?></td>
                                <td>

                                    <a href="../../controller/controllerCarrito.php?IDCancelar=<?php echo $row['ID_VENT'] ?>">
                                        <button type="submit" class="editarProd" name="Cancelar"><img
                                                src="../../../public/img/Administrador/Eliminar.png" alt="Eliminar"
                                                class="img"></button></a>
                                </td>

                            </tr>
                        <?php include('../../model/Modals/modal_metodo_pago.php');
                        }
                        if (isset($_SESSION["msg"])) {
                            $msg = $_SESSION["msg"];
                            if ($msg) {
                                echo ("<script>$msg</script>");
                                unset($_SESSION["msg"]);
                            }
                        }
                        ?>
                    </tbody>

                </table>



                <div data-bs-toggle="modal" data-bs-target="#metodo_pago" style="width: 70px" ;> <button type="submit"
                        class="editarProd" name="Comprar"><img src="../../../public/img/Administrador/AceptarCreditos.png"
                            alt="" class="btnedit" style="width: 70px"></button></div>
            </div>



            <footer class="footerContainer">
                <div class="contactos">
                    <h1>Contactanos</h1>
                </div>
                <div class="socialIcons">
                    <a href><i class="fa-brands fa-facebook"></i></a>
                    <a href><i class="fa-brands fa-whatsapp"></i></a>
                    <a href><i class="fa-brands fa-twitter"></i></a>
                    <a href><i class="fa-brands fa-google"></i></a>
                </div>
            </footer>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <script src="productos.js"></script>

</body>

</html>