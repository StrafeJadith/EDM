<?php
    include("../../model/Conexion.php");

    session_start();

    if (empty($_SESSION['correo'])) {
        header("location: ../registro/inicio.php");
        session_destroy();
        die();
    }
    
    $conexion = new Conexion();
    $conn = $conexion->getConexion();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de ventas</title>
    <?php require_once '../inc/headAdmin.php' ?>
    <link rel="stylesheet" href="../../../public/css/Administrador/Ventas.css">
    <!-- <link rel="stylesheet" href="../../../public/css/Administrador/AdministradorDashboard.css"> -->
    
</head>

<body>

    <?php require_once '../inc/headerAdmin.php' ?>

    <section>

        <div class="contenedorprincipal">

            <?php require_once '../inc/MenuLateral.php' ?>

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

                            $query = " SELECT u.Nombre_US, m.Tipo_Pago_MTP, dv.* FROM detalle_de_venta dv, usuarios u, metodo_pago m WHERE dv.ID_US = u.ID_US and dv.ID_MTP = m.ID_MTP ";
                            $resultado = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_array($resultado)) { ?>
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
                            $sql = "SELECT sum(TOTAL_DV)  FROM  detalle_de_venta ";
                            $resultado = mysqli_query($conn, $sql);

                            if ($resultado) {
                                $row = $resultado->fetch_array(MYSQLI_NUM);
                                $sum = (int) $row[0];
                            }

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



    <?php include '../../view/inc/footer.php' ?>