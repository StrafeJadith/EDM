<?php

include("../PhpJadith/Conexion.php");
session_start();

if (empty($_SESSION['correo'])) {
    header("location: ../registro/inicio.php");
    session_destroy();
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos usuario</title>
    <link rel="stylesheet" href="./css/pago.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="img/logo.png" width="350px" height="200px" style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="    Buscar...                                                                                                     🔎        " style="width: 450px; border-radius: 20px; height: 40px;">
                        </div>
                    </form>
                </div>


                <nav id="Nav">
                    <div id="NavList">

                        <ul id="Listas">
                            <a href="../inicio_productos/inicio.html">
                                <li><strong> Inicio </strong></li>
                            </a>
                            <a href="../productos/productos.php">
                                <li><strong> Productos </strong></li>
                            </a>
                            <a href="../CreditosEDM/CreditosInicio.html">
                                <li><strong> Creditos </strong></li>
                            </a>
                            <a href="../historia/historia.html">
                                <li><strong> Sobre Nosotros </strong></li>
                            </a>
                            <a href="../controlador/controladorcerrarsesion.php"><button type="button" class="btn">Cerrar Sesión</button></a>
                            <li><img src="./img/carrito.png" width="40px" height="40px" style="margin-top: -18px;">
                            </li>

                        </ul>

                    </div>

                </nav>
            </div>

        </div>
    </header>
    <!--Menu de los productos -->
    <div class="ContentMid">
        <nav class="nav_">
            <a href="perfiluser.php"><img src="./img/icons/user.svg" alt="" class="user"></a>
            <div class="correo">
                    <?php

                        $correo = $_SESSION['correo'];
                        $sql = "SELECT Nombre_US FROM usuarios WHERE Correo_us = '$correo'";
                        $resultado = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($resultado)) {
                            $nombre = $row['Nombre_US'];
                        }

                        echo "Bienvenido ".$nombre."<br>";
                        echo $correo;

                    ?>
                    
                </div>
                <br>
            <hr style="color: #f9f7dc;">

            <ul class="lista">
                <li class="lista_item lista_item--click">
                    <a href="index_.php" class="nav_link"><h2>Navegacion</h2></a>
                </li>

                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="./img/icons/creditos.png" class="lista_img">
                        <a href="#" class="nav_link"> CREDITOS </a>
                        <img src="./img/icons/arrow.svg" class="lista_flecha">
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
                        <img src="./img/icons/ventas.png" class="lista_img">
                        <a href="#" class="nav_link"> VENTAS </a>
                        <img src="./img/icons/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="./ventas.php" class="nav_link nav_link--inside"> DETALLE DE VENTA </a>
                        </li>

                    </ul>
                </li>

                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="./img/icons/pagos.png" class="lista_img">
                        <a href="#" class="nav_link">METODO DE PAGO </a>
                        <img src="./img/icons/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="./pago.php" class="nav_link nav_link--inside"> TIPO DE PAGO </a>
                        </li>


                    </ul>
                </li>

            </ul>
        </nav>

    
    <div id="principal">
        <!-- imagenes de los productos-->
        <div id="contenido-a-actualizar">
            <div class="contenido">
                <div class="escaneame">
                   <h2>Seleccione metodo de Pago de Compra</h2>
                </div>
                <a href="#" onclick="actualizarContenido_nequi()"><button type="button" class="nequi" >Nequi</button></a>
                <br>
                <a href="#" onclick="actualizarContenido_efectivo()"><button type="button" class="efectivo" >Efectivo</button></a>
               
            </div>

        </div>


    </div>       

    </div>

     <!-- Pie de pagina -->
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


    <script src="./js/pagos.js"></script>

</body>

</html>