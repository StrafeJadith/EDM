<?php

include("./app/model/Conexion.php");
$conexion = new conexion();
$conn = $conexion->getConexion();
?>

<?php require_once "./app/view/inc/headInicio.php" ?> 
<link rel="stylesheet" href="<?= APP_URL; ?>public/css/Usuario/historia.css">
    
</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">


            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL; ?>public/img/logo.png" width="350px" height="200px" style="padding-left: 10px; padding-top: 0px">

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
                                <a href="<?= APP_URL; ?>log-Out/"><button type="button" class="btn">Cerrar
                                        Sesión</button></a>

                                <a href="Usuario/carrito_compra.php">
                                    <li><img src="<?= APP_URL; ?>public/img/Carrito.png" width="40px" height="40px"
                                            style="margin-top: -18px;">
                                    </li>

                                </a>
                                <a href="usuario/index_.php">
                                    <li><img src="<?= APP_URL; ?>public/img/home.svg" width="40px" height="40px"
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
    <br>
    <br>
    <div class="historia">
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h1 style="text-align: center;"><strong>HISTORIA</strong></h1>
        <p>Desde sus inicios, La mano de Dios se ubico en el barrio Villa Lozano de Soledad, fue creada en el año 2004, tuvo inicios simples y una clientela que iba comenzando a llegar con el tiempo, a traves de los años la tienda la mano de Dios fue formando
            su clientela diaria, la cual constaba de la comunidad de sus alrededores, ha seguido vigente diecinueve años desde su creacion y su presencia en la comunidad no es facilmente olvidable a la memoria de sus vecinos.</p>
    </div>

    <div class="row">
        <div class="mision">
            <h4 class="mision2"><strong>MISION</strong></h4>
            <p class="mision3">La tienda la mano de Dios tiene como mision y objetivo el dar el mejor servicio de atencion al cliente de forma rapida, precisa y segura, en el cual se podra atender a la comunidad de forma comoda y se podran realizar prestaciones, proporcionando
                asi a los alrededores un buen servicio en el cual se llenen todas las necesidades que una tienda comun y corriente provee a la comunidad.
            </p>
        </div>
        <div class="vision">
            <h4 class="vision2"><strong>VISION</strong></h4>
            <p class="vision3">La tienda la mano de Dios tiene su vision clara, planea ver por el futuro de la tienda, planea permanecer vigente a largo plazo permitiendo asi que la comunidad de los alrededores no solo sean atendidos de forma eficiente y buena, sino que
                garantiza que la tienda seguira
            </p>
        </div>
    </div>
    <footer class="footerContainer ">
        <div class="Contactos ">
            <h1>Contactanos</h1>
        </div>
        <div class="socialIcons ">
            <a href><i class="fa-brands fa-facebook "></i></a>
            <a href><i class="fa-brands fa-whatsapp "></i></a>
            <a href><i class="fa-brands fa-twitter "></i></a>
            <a href><i class="fa-brands fa-google "></i></a>
        </div>
    </footer>
