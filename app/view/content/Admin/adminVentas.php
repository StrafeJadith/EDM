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
    <title>Dashboard</title>
    <?php require_once '../inc/headAdmin.php' ?>
    <link rel="stylesheet" href="../../../public/css/Administrador/Ventas.css">

    
</head>

<body>

    <?php require_once '../inc/headerAdmin.php' ?>

    <section>
        <div class="contenedorprincipal">

            <?php require_once '../inc/MenuLateral.php' ?>


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

                            $query = "SELECT * FROM ventas  Where Estado_VENT = 'Confirmado' ";
                            $resultado = mysqli_query($conn, $query);


                            while ($row = mysqli_fetch_array($resultado)) { ?>
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
                            $sql = "SELECT sum(v.Valor_total)  FROM ventas v Where v.Estado_VENT = 'Confirmado'";
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