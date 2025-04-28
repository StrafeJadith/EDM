<?php
require_once("./app/model/Conexion.php");

$conexion = new conexion();
$conn = $conexion->getConexion();
?>

    <link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/inicio&&registro/Inicio.css">
    
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
        position: relative;
        left: 37px;
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
                    <img src="<?= APP_URL; ?>public/img/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                            
                        </div>
                    </form>
                </div>

                <nav id="Nav">
                    <div id="NavList">

                        <ul class="Listas">
                            <a href="<?= APP_URL; ?>inicio/">
                                <li><strong> Inicio </strong></li>
                            </a>
                            <a href="<?= APP_URL; ?>indexProductos/">
                                <li><strong> Productos </strong></li>
                            </a>
                            <a href="<?= APP_URL; ?>indexCreditosInicio">
                                <li><strong> Creditos </strong></li>
                            </a>
                            <a href="<?= APP_URL; ?>indexHistoria/">
                                <li><strong> Sobre Nosotros </strong></li>
                            </a>
                            <?php

                            if (empty($_SESSION['correo'])) { ?>
                                <a href="<?= APP_URL; ?>indexInicio/"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>
                                <a href="<?= APP_URL; ?>log-Out/"><button type="button" class="btn">Cerrar Sesión</button></a>

                                <a href="../productos/carrito_compra.php">
                                    <li><img src="./imagenes/Carrito.png" width="40px" height="40px" style="margin-top: -18px;">
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
        <div class="cabecera">
            <ul class="Registro">
                <li>
                    <strong>
                        <h3><a href="<?= APP_URL; ?>indexOlvidoContraseña/" style="text-decoration: none;">RECUPERACIÓN DE CUENTA</a></h3>
                    </strong>
                </li>
            </ul>
        </div>
        <div class="linea"></div>
        <br>
        <br>
        <form action="../../controller/controllerInicio.php" method="post">
            <h2 class="sub-one">Correo electrónico</h2>
            <input class="sub-two" type="text" name="correo" value="">
            <br>
            <br>
            <h2 class="sub-one">Nueva contraseña</h2>
            <input class="sub-two" type="password" name="contraseña" value="">
            <br>
            <br>
            <h2 class="sub-one">Repita la contraseña</h2>
            <input class="sub-two" type="password" name="confirmar" value="">
            <br>
            <br>
            <a class="btn-c" href="<?= APP_URL; ?>indexInicio/">Regresar al inicio de sesión</a>
            <br>
            <br>
            <input class="btn-inc" type="submit" name="recuperar" value="Recuperar">
            <br>
            <br>
            <br>
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
