
<link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/inicio.css">
    
</head>

<body id="bodyOlvidarContraseña">


    <section class="olvidarContraseña">

            <h3><strong>RECUPERAR CONTRASEÑA</strong></h3>

        <form class="FormularioAjax" action="<?= APP_URL ?>app/ajax/recuperarContraseñaAjax.php" method="post">

            <input type="hidden" name="modulo_recuperar" value="recuperarContraseña">
            <div>
                <span class="input-group-text" id="basic-addon1"><strong>Correo electronico</strong></span>
                <input type="text" class="form-control" name="correoElectronico" placeholder="Ingrese su correo" aria-label="ingrese su correo" aria-describedby="basic-addon1" required><br>
                                
            </div>
            
            <a class="btn-c" href="<?= APP_URL; ?>indexInicio/"><strong>Regresar al inicio de sesión</strong></a><br>
            
            <button type="submit" name="Enviar" id="btn1"><strong>Enviar</strong></button>
            <button type="button" id="btn2" class="AggProd" data-bs-toggle="modal" data-bs-target="#RecuperarContraseña"><strong>Ingresar nueva contraseña</strong></button>
            
        </form>
        
    </section>

    <?php include './app/view/Modals/modal_recuperar_contraseña.php'; ?>



    