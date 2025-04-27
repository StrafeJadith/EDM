<?php

require_once("./app/model/Conexion.php");
$conexion = new conexion();
$conn = $conexion->getConexion();

?>

<?php require_once "./app/view/inc/headInicio.php" ?> 
<link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/CreditosInicio.css">
</head>

<body id="bodyCreditos">

    <!-- HEADER -->
    <header id="headerCreditos">
        <div id="barranav">


            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?php echo APP_URL; ?>public/img/logo.png" width="350px" height="200px" style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                        </div>
                    </form>
                </div>


                <nav id="Nav">
                    <div id="NavList">

                        <ul id="Listas">
                            <a href="<?= APP_URL; ?>inicio/">
                                <li><strong> Inicio </strong></li>
                            </a>
                            <a href="<?= APP_URL; ?>indexProductos/">
                                <li><strong> Productos </strong></li>
                            </a>


                            <?php
                            
                            if (empty($_SESSION['correo'])) { ?>
                                <a href="<?= APP_URL; ?>indexCreditosInicio/">
                                    <li><strong> Creditos </strong></li>
                                </a>
                                <a href="<?= APP_URL; ?>indexHistoria/">
                                    <li><strong> Sobre Nosotros </strong></li>
                                </a>
                                <a href="<?= APP_URL; ?>indexInicio/"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>
                                <a href="<?= APP_URL; ?>indexCreditosInicio/">
                                    <li><strong> Creditos </strong></li>
                                </a>
                                <a href="../controller/controladorcerrarsesion.php"><button type="button" class="btn">Cerrar
                                        Sesión</button></a>

                                <a href="Usuario/carrito_compra.php">
                                    <li><img src="../../public/img/Carrito.png" width="40px" height="40px"
                                            style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="usuario/index_.php">
                                    <li><img src="../../public/img/home.svg" width="40px" height="40px"
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


    <!--CONTEXTO DE LA PAGINA O ARTICULOS -->

    <div id="content">
        <p>
        <h3><strong> Solicitar un credito nunca habia sido tan facil.</strong></h3> <br><br>
        <li><strong> Facil de usar. </strong></li><br>
        <li><strong> Facilita los procesos de credito presenciales. </strong></li><br>
        <li><strong> Control de tus transacciones y estado en la tienda. </strong></li><br>
        <li><strong> Haz transacciones con facilidad desde cualquier dispositivo. </strong></li><br>
        </p>

        <?php

        if (!empty($_SESSION['correo'])) {
            $correo = $_SESSION['correo'];
            $sql = "SELECT * FROM credito WHERE Correo_CR = '$correo'";
            $resultado = mysqli_query($conn, $sql);
            if (mysqli_num_rows($resultado) > 0) {
                header("location: Usuario/gasto credito.php");
            }
        }

        if (!empty($_SESSION['correo'])) { ?>
            <a href="inicio/credito.php"><button type="button" id="btn1">Solicitalo aqui</button></a>
        <?php } else { ?>
            <a href="<?php echo APP_URL; ?>indexInicio/"><button type="button" id="btn1">Solicitalo aqui</button></a>
        <?php } ?>


    </div>


    <!--FOOTER-->

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
