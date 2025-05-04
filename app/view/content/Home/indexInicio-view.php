<link rel="stylesheet" href="<?= APP_URL ?>public/css/inicio&&registro/navHome.css">
<link rel="stylesheet" href="<?= APP_URL; ?>public/css/inicio&&registro/Inicio.css">
    
</head>
<body>


    <section class="Registro">

        <img src="<?= APP_URL;?>public/img/banner.jpg" alt="">
            <div class="formularioInicio">
                <form method="post">
                    <h1>Inicio de Sesion</h1>
                    <div>
                            <span class="input-group-text" id="basic-addon1"><strong>Correo electronico</strong></span>
                            <input type="text" class="form-control" name="correo" placeholder="ingrese su correo" aria-label="ingrese su correo" aria-describedby="basic-addon1" required><br>
                            
                    </div>
                    <div>
                            <span class="input-group-text" id="basic-addon1"><strong>Contraseña</strong></span>
                            <input type="password" class="form-control" name="contraseña" placeholder="ingrese su contraseña" aria-label="ingrese su contraseña" aria-describedby="basic-addon1" required><br>
                    </div>
                    <a class="otc" href="<?= APP_URL; ?>indexOlvidoContraseña/"><strong>¿Olvidaste tu contraseña?</strong></a>
                    <br>
                    <br>
                    <a class="btn-c" href="<?= APP_URL; ?>indexRegistro/"><strong>¿No tienes una cuenta? Crea una</strong></a>
                    <br>
                    <br>
                    <button class="btnIniciarSesion" type="submit"><strong>Iniciar Sesión</strong></button>
                    <br>
                    <br>
                    <br>
                </form>
                <a href="<?= APP_URL;?>inicio/" id="volverInicio"><strong>Volver al inicio</strong></a>
            </div>
            
        </div>

    </section>
    

<?php

    if(isset($_POST['correo']) &&  isset($_POST['contraseña'])){

        $insLogin->iniciarSesionControlador();
    }

?>