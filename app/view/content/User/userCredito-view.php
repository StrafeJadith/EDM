<?php
require_once("../../model/Conexion.php");

$conexion = new conexion();
$conn = $conexion->getConexion();


session_start();

//este fragmento de codigo es por si la persona esta intentando acceder al apartado de credito sin haber iniciado sesión, si es asi lo mandara a la pagina de inicio para que inicie sesión.
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
    <title>Creditos</title>
    <link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/inicio&&registro/Estilos.css">
    <link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/Bootstrap/bootstrap.min.css"> 
    <!-- <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../../public/js/alerts.js"></script>
</head>
<style>
    .btn {
        background-color: #804e23;
        color: white;
        border-radius: 100px;
        width: 170px;
        font-size: 19px;
        margin-left: 150px;
        margin-top: -10px;
    }

    .btn:hover {
        background-color: beige;
        color: #804e23;
        border-radius: 100px;
    }

    h3 {
        margin-top: 20px;
        margin-bottom: 20px;
        color: #804e23;
        font-size: 35px;
    }

    .linea {
        margin-top: 25px;
        padding: 3px;
        background-color: #804e23;
        height: 5px;
        border: none;
    }

    .botonregistrate {
        background-color: #804e23;
        color: white;
        border-radius: 50px;
        border: #804e23;
        width: 200px;
        height: 50px;
        font-size: 20px;
    }

    .Listas a {
        text-decoration: none;
    }
</style>

<body>

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
                                style="width: 450px;">
                        </div>
                    </form>
                </div>

                <nav id="Nav">
                    <div id="NavList">

                        <ul class="Listas">
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
                                <a href="../inicio/inicio.php"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>
                                        <a href="../historia.php">
                                <li><strong> Sobre Nosotros </strong></li>
                            </a>

                            <?php } else { ?>
                                <a href="../../controller/controladorcerrarsesion.php"><button type="button" class="btn">Cerrar Sesión</button></a>

                                <a href="../Usuario/carrito_compra.php">
                                    <li><img src="../../../public/img/carrito.png" width="40px" height="40px" style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="../Usuario/index_.php">
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

    <section class="Registro">
        <br>
        <br>
        <form action="../../controller/controllerInicio.php" method="post">
            <?php
            //include("../controlador/controladorcredito.php");

            $correo = $_SESSION['correo'];
            $sql = "SELECT * FROM usuarios WHERE Correo_US = '$correo'";
            $resultado = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($resultado)) {
                $nombre = $row['Nombre_US'];
                $telefono = $row['Telefono_US'];
                $direccion = $row['Dirección_US'];
                $cedula = $row['ID_US'];
            }

            ?>
            <br>
            <h2 class="sub1 sub-one">Nombre</h2>
            <input type="text" name="nombre" class="input1" value="<?php echo $nombre ?>" disabled>
            <br>
            <br>
            <h2 class="sub3 sub-one">Telefono</h2>
            <input type="text" name="telefono" class="input1" value="<?php echo $telefono ?>" disabled>
            <br>
            <br>
            <h2 class="sub4 sub-one">Dirección</h2>
            <input type="text" name="direccion" class="input1" value="<?php echo $direccion ?>" disabled>
            <br>
            <br>
            <h2 class="sub5 sub-one">Nùmero de identificaciòn</h2>
            <input type="text" name="cedula" class="input1" value="<?php echo $cedula ?>" disabled>
            <br>
            <br>
            <h2 class="sub6 sub-one">Monto</h2>
            <input type="number" name="monto" class="input1">
            <button class="btnregistro" type="submit" name="solicitarCredito">Solicitar</button>
        </form>
    </section>
    <?php

    if (isset($_SESSION["msg"])) {
        $msg = $_SESSION["msg"];

        if ($msg) {
            echo ("<script> $msg </script>");

            unset($_SESSION["msg"]);
        }
    }


    ?>
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