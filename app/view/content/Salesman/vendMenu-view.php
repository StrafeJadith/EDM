<?php

require_once("../../model/Conexion.php");

$conexion = new conexion();
$conn = $conexion->getConexion();

//para destruir la session y no dejar que la persona ingrese por medio de un enlace
session_start();

if (empty($_SESSION['correo'])) {
    //si el correo del usuario que esta ingresando esta vacio, mandarlo al login
    header("location: ../inicio/inicio.php");
    session_destroy();
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="../../../public/css/vendedor/menu.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <a href="../inicio_productos/inicio.html"><img src="../../../public/img/logo.png" width="350px" height="200px"
                            style="padding-left: 10px; padding-top: 0px"></a>
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
            <div class="menu">
                <br>
                <div class="imagen1">
                    <img src="../../../public/img/Usuario/iconousuario.png.png" alt="">
                </div>
                <div class="correo">
                    <?php
                    $correo = $_SESSION['correo'];
                    $sql = "SELECT Nombre_US FROM usuarios WHERE Correo_US = '$correo'";
                    $resultado = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($resultado)) {
                        $nombre = $row['Nombre_US'];
                    }
                    echo "Bienvenido " . $nombre . "<br>";
                    echo $correo;
                    ?>
                </div>
                <br>
                <br>
                <div class="subtitulomenu">
                    <a href="menu.php">
                        <h3>Menú</h3>
                    </a>
                </div>
                <br>
                <div class="usuarios">
                    <div class="imagenusuarios">
                        <img src="../../../public/img/Usuario/Usuarios.png" alt="">
                    </div>
                    <div class="usuariossubtitulo">
                        <a href="usuarios.php">
                            <h4>Usuarios</h4>
                        </a>
                    </div>
                </div>
                <div class="productos">
                    <div class="imagenproductos">
                        <img src="../../../public/img/Usuario/Productos.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Productos</summary>
                            <br>
                            <ul>
                                <li><a href="existencias.php">Existencias</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="creditos">
                    <div class="imagencreditos">
                        <img src="../../../public/img/Usuario/Creditos.png" alt="">
                    </div>
                    <div class="creditossubtitulo">
                        <a href="creditosUsuario.php">
                            <h4>Creditos</h4>
                        </a>
                    </div>
                </div>
                <div class="ventas">
                    <div class="ventassubtitulo">
                        <br>
                        <br>
                        <br>
                        <a href="../../controller/controladorcerrarsesion.php">Cerrar sesión</a>
                    </div>
                </div>
            </div>
            <?php


            function ObtenerCount($table, $conn)
            {

                $sqlQuery = "SELECT COUNT(*) as numus FROM $table";
                $Result = mysqli_query($conn, $sqlQuery);

                if (mysqli_num_rows($Result) > 0) {

                    $ResultRow = mysqli_fetch_array($Result);
                    $VariableIterador = $ResultRow['numus'];
                }

                return $VariableIterador;
            }

            ?>

            <div class="apartado">
                <div class="APclientes">
                    <div class="imagenclientes">
                        <img src="../../../public/img/Usuario/Usuarios.png" alt="">
                    </div>
                    <div class="clientes">
                        <h3>Usuarios</h3>
                    </div>
                    <div class="span1">
                        <span><?= ObtenerCount('usuarios', $conn); ?></span>
                    </div>
                </div>
                <div class="APproductos">
                    <div class="imagenproducto">
                        <img src="../../../public/img/Usuario/Productos.png" alt="">
                    </div>
                    <div class="productos2">
                        <h3>Productos</h3>
                    </div>
                    <div class="span2">
                        <span><?= ObtenerCount('productos', $conn); ?></span>
                    </div>
                </div>
                <div class="APexistencias">
                    <div class="imagenesexistencias">
                        <img src="../../../public/img/Usuario/Existencias.png" alt="">
                    </div>
                    <div class="existencias">
                        <h3>Existencias</h3>
                    </div>
                    <div class="span3">
                        <span>
                            <?php
                            $sqlSuma = "SELECT SUM(Cantidad_Total) AS Existencias FROM productos;";
                            $sqlSumaResult = mysqli_query($conn, $sqlSuma);

                            if (mysqli_num_rows($sqlSumaResult) > 0) {

                                $ResultRowSum = mysqli_fetch_array($sqlSumaResult);
                                $ResultSuma = $ResultRowSum['Existencias'];
                                echo $ResultSuma;
                            }

                            ?></span>
                    </div>
                </div>
                <div class="APexistenciasvendida">
                    <div class="imagenesexistenciasvendida">
                        <img src="../../../public/img/Usuario/Existencias.png" alt="">
                    </div>
                    <div class="existenciasvendidas">
                        <h3>Existencias <br> Vendidas</h3>
                    </div>
                    <div class="span4">
                        <span>
                            <?php
                            $sqlSuma1 = "SELECT SUM(Cantidad_Total) - SUM(Cantidad_Existente) AS ExistenciasVendidas FROM productos";
                            $sqlSuma1Result = mysqli_query($conn, $sqlSuma1);

                            if (mysqli_num_rows($sqlSuma1Result) > 0) {

                                $sqlResta = mysqli_fetch_array($sqlSuma1Result);
                                $ResultResta = $sqlResta['ExistenciasVendidas'];
                                echo $ResultResta;
                            }

                            ?>
                        </span>
                    </div>
                </div>
                <div class="APcreditos">
                    <div class="ImagenesCredito">
                        <img src="../../../public/img/Usuario/Creditos.png" alt="">
                    </div>
                    <div class="Credito">
                        <h3>Creditos</h3>
                    </div>
                    <div class="span5">
                        <span><?= ObtenerCount('credito', $conn); ?></span>
                    </div>
                </div>
                <div class="APventas">
                    <div class="Imagenesventas">
                        <img src="../../../public/img/Usuario/Ventas.png" alt="">
                    </div>
                    <div class="Ventas">
                        <h3>Ventas</h3>
                    </div>
                    <div class="span6">
                        <span>10</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
</body>

</html>