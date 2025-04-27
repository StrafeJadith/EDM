<?php

include("../../model/Conexion.php");
session_start();
$conexion = new conexion();
$conn = $conexion->getConexion();
if (empty($_SESSION['correo'])) {
    header("location: ./inicio.php");
    session_destroy();
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>abono credito</title>
    <link rel="stylesheet" href="../../../public/css/Usuario/abono credito.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="../../../public/img/Usuario/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="Buscar...                                                                               🔎        "
                                style="width: 450px;">
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
                            <a href="../CreditosInicio.php">
                                <li><strong> Creditos </strong></li>
                            </a>
                            <?php

                            if (empty($_SESSION['correo'])) { ?>
                                <a href="./inicio.php"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>
                                <a href="../../controller/controladorcerrarsesion.php"><button type="button"
                                        class="btn">Cerrar Sesión</button></a>

                                <a href="./carrito_compra.php">
                                    <li><img src="../../../public/img/Usuario/Carrito.png" width="40px" height="40px"
                                            style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="./index_.php">
                                    <li><img src="../../../public/img/Usuario/home.svg" width="40px" height="40px"
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

    <div class="containerMid">
        <nav class="nav_">
            <a href="perfiluser.php"><img src="../../../public/img/Usuario/user.svg" alt="" class="user"></a>
            <div class="correo">
                <?php

                $correo = $_SESSION['correo'];
                $sql = "SELECT Nombre_US FROM usuarios WHERE Correo_us = '$correo'";
                $resultado = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($resultado)) {
                    $nombre = $row['Nombre_US'];
                }

                echo "Bienvenido " . $nombre . "<br>";
                echo $correo;

                ?>

            </div>
            <br>
            <hr style="color: #f9f7dc;">

            <ul class="lista">
                <li class="lista_item lista_item--click">
                    <a href="index_.php" class="nav_link">
                        <h2>Navegacion</h2>
                    </a>
                </li>

                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="../../../public/img/Usuario/creditos.png" class="lista_img">
                        <a href="#" class="nav_link"> CREDITOS </a>
                        <img src="../../../public/img/Usuario/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="./gasto credito.php" class="nav_link nav_link--inside"> GASTO DE CREDITO </a>
                        </li>
                        <li class="lista_inside">
                            <a href="./abono credito.php" class="nav_link nav_link--inside"> ABONO DE CREDITO </a>
                        </li>
                    </ul>
                </li>

                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="../../../public/img/Usuario/ventas.png" class="lista_img">
                        <a href="#" class="nav_link"> VENTAS </a>
                        <img src="../../../public/img/Usuario/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="./ventas.php" class="nav_link nav_link--inside"> DETALLE DE VENTA </a>
                        </li>

                    </ul>
                </li>


            </ul>
        </nav>

        <div class="padre_tabla">
            <table>

                <?php
                $correo = $_SESSION['correo'];
                $ConsultaCr = "SELECT * FROM credito WHERE Correo_CR = '$correo' AND Estado_ACT = 1";
                $resultConCr = mysqli_query($conn, $ConsultaCr);
                $rowCr = mysqli_fetch_assoc($resultConCr);
                $creditoTotal = 0;
                $fechasCr = "Sin credito realizado";
                $AbonoMonto = 0;
                $CreditoRestante = 0;
                if (!empty($rowCr["Valor_Total"])) {
                    $creditoTotal = $rowCr['Valor_Total'];
                    $fechasCr = $rowCr['Fecha_CR'];
                    $consultarIdAbono = "SELECT ID_US FROM usuarios WHERE Correo_US = '$correo'";
                    $resultIdAbono = mysqli_query($conn, $consultarIdAbono);
                    $rowAb = mysqli_fetch_assoc($resultIdAbono);
                    $IdeUs = $rowAb['ID_US'];

                    $congastoAbono2 = "SELECT ID_AC FROM abono_credito WHERE ID_US = $IdeUs";
                    $resultAbono2 = mysqli_query($conn, $congastoAbono2);
                    $rowConGast = mysqli_fetch_assoc($resultAbono2);
                    if (!empty($rowConGast)) {
                        $IdAc = $rowConGast["ID_AC"];
                    }
                    $IdAc = 0;



                    $conGastoAbono = "SELECT sum(Monto_AC) as MontoSuma FROM abono_credito WHERE ID_US = $IdeUs";
                    $resultAbono = mysqli_query($conn, $conGastoAbono);
                    $rowAbono = mysqli_fetch_assoc($resultAbono);
                    $AbonoMonto = $rowAbono['MontoSuma'];

                    $CreditoRestante = $creditoTotal - $AbonoMonto;
                    $_SESSION["credRest"] = $CreditoRestante;


                }

                ?>
                <tr>
                    <td>Credito Pedido</td>
                    <td>$<?= $creditoTotal ?></td>
                </tr>

                <tr>
                    <td>Abono Actual</td>
                    <td>$<?= $AbonoMonto ?></td>
                </tr>
                <tr>
                    <td>Total Credito</td>
                    <td>$<?= $CreditoRestante ?></td>
                </tr>

            </table>
            <a href="metodo_abono.php"><button class="btn_abono">Abonar</button></a>
        </div>
    </div>
    <footer class="footerContainer ">
        <div class="contactos ">
            <h1>Contactanos</h1>
        </div>
        <div class="socialIcons ">
            <a href><i class="fa-brands fa-facebook "></i></a>
            <a href><i class="fa-brands fa-whatsapp "></i></a>
            <a href><i class="fa-brands fa-twitter "></i></a>
            <a href><i class="fa-brands fa-google "></i></a>
        </div>
    </footer>
    <script src="../js/alerts.js"></script>
    <script src="../../../public/js/pagos.js"></script>
</body>

</html>