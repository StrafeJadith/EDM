
<link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/inicio.css">
    
</head>

<body id="bodyOlvidarContraseña">


    <section class="olvidarContraseña">

            <h3><strong>RECUPERAR CONTRASEÑA</strong></h3>

        <form action="" method="post">

            <div>
                <span class="input-group-text" id="basic-addon1"><strong>Correo electronico</strong></span>
                <input type="text" class="form-control" name="correoElectronico" placeholder="Ingrese su correo" aria-label="ingrese su correo" aria-describedby="basic-addon1" required><br>
                                
            </div>
            
            <div>
                <span class="input-group-text" id="basic-addon1"><strong>Nueva contraseña</strong></span>
                <input type="password" class="form-control" name="repetirContraseña" placeholder="Ingrese la nueva contraseña" aria-label="ingrese su correo" aria-describedby="basic-addon1" required><br>
                                
            </div>

            <div>
                <span class="input-group-text" id="basic-addon1"><strong>Repita la contraseña</strong></span>
                <input type="password" class="form-control" name="repetirContraseña" placeholder="Ingrese de nuevo la contraseña" aria-label="ingrese su correo" aria-describedby="basic-addon1" required><br>
                                
            </div>
            
            <a class="btn-c" href="<?= APP_URL; ?>indexInicio/"><strong>Regresar al inicio de sesión</strong></a><br>
            
            <button type="submit" name="Enviar"><strong>Enviar</strong></button>
            
        </form>
        
    </section>
