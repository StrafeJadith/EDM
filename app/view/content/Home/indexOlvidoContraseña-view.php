
<link rel="stylesheet" href="<?= APP_URL ?>public/css/inicio&&registro/navHome.css">
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

                <?php require_once './app/view/inc/navHome.php' ?>
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
