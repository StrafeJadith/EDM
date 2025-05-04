<link rel="stylesheet" href="<?= APP_URL ?>public/css/inicio&&registro/navHome.css">
<link rel="stylesheet" href="<?= APP_URL; ?>public/css/inicio&&registro/Inicio.css">
<!-- <link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/Bulma/bulma.min.css"> -->

    <!-- <div class="container pb-6 pt-6" id="Form1">
            <h1 class="title">Registro</h1>
        <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off">

            <input type="hidden" name="modulo_usuario" value="registrar">

            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Cedula</label>
                        <input class="input" type="number" name="usuario_cedula" pattern="[0-9]{1,15}" maxlength="15" required >
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Usuario</label>
                        <input class="input" type="text" name="usuario_nombre" pattern="[a-zA-Z]{1,20}" maxlength="20" required >
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="control">
                            <label>Correo electronico</label>
                            <input class="input" type="email" name="usuario_email" maxlength="70" required>
                    </div>
                    
                </div>
                <div class="column">
                    <div class="control">
                            <label>Telefono</label>
                            <input class="input" type="number" name="usuario_telefono" pattern="[0,9]{20}" maxlength="20" required >
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column">
                    <div class="control">
                        <label>Direccion</label>
                        <input class="input" type="text" name="usuario_direccion"  maxlength="100">
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Contraseña</label>
                        <input class="input" type="password" name="usuario_clave" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required >
                    </div>
                </div>
                <div class="column">
                    <div class="control">
                        <label>Confirmar contraseña</label>
                        <input class="input" type="password" name="usuario_clave1" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required >
                    </div>
                </div>
            </div>
            <p class="has-text-centered">
                <button type="reset" class="button is-link is-light is-rounded">Limpiar</button>
                <button type="submit" class="button is-info is-rounded">Guardar</button>
            </p>
        </form>
    </div> -->

    <div id="Form1">
        <img src="<?= APP_URL; ?>public/img/bannerRegistrar.webp" alt="">
        <div id="formularioRegistro">
            <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off">
                <h1>Registro de usuarios</h1>
                    <input type="hidden" name="modulo_usuario" value="registrar">

                <div class="">
                    <span class="input-group-text" id="basic-addon1"><strong>Cedula de identificacion</strong></span>
                    <input type="number" class="form-control" name="usuario_cedula" placeholder="ingrese su cedula" aria-label="ingrese su cedula" aria-describedby="basic-addon1" pattern="[0-9]{1,15}" maxlength="15" required><br>
                    
                </div>
                <div class="">
                    <span class="input-group-text" id="basic-addon1"><strong>Nombre de usuario</strong></span>
                    <input type="text" class="form-control" name="usuario_nombre" placeholder="ingrese su nombre de usuario" aria-label="ingrese su nombre de usuario" aria-describedby="basic-addon1"  pattern="^[A-Za-z]+( [A-Za-z]+)*$" maxlength="20" required><br>
                </div>
                    <div class="">
                    <span class="input-group-text" id="basic-addon1"><strong>Correo electronico</strong></span>
                    <input type="email" class="form-control" name="usuario_email" placeholder="ingrese su correo electronico" aria-label="ingrese su correo electronico" aria-describedby="basic-addon1" maxlength="70" required><br>
                    <span class="input-group-text" id="basic-addon1"><strong>Telefono</strong></span>
                    <input type="number" class="form-control" name="usuario_telefono" placeholder="ingrese su telefono" aria-label="ingrese su telefono" aria-describedby="basic-addon1" pattern="[0-9]{3,20}" maxlength="20" required><br>
                    
                </div>
                <div class="">
                <span class="input-group-text" id="basic-addon1"><strong>Direccion</strong></span>
                <input type="text" class="form-control" name="usuario_direccion" placeholder="ingrese su direccion" aria-label="ingrese su direccion" aria-describedby="basic-addon1" maxlength="100"><br>
                </div>
                <div class="">
                <span class="input-group-text" id="basic-addon1"><strong>Contraseña</strong></span>
                    <input type="password" class="form-control" name="usuario_clave" placeholder="ingrese su contraseña" aria-label="ingrese su contraseña" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required><br>
                    <span class="input-group-text" id="basic-addon1"><strong>Repetir contraseña</strong></span>
                    <input type="password" class="form-control" name="usuario_clave1" placeholder="ingrese su contraseña" aria-label="ingrese su contraseña" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required><br>
                </div>

                <button type="reset" class="button "><strong>Limpiar</strong></button>
                <button type="submit" class="button "><strong>Guardar</strong></button>

            </form>
            <a href="<?= APP_URL;?>inicio/" id="volverInicio"><strong>Volver al inicio</strong></a>
        </div>
    </div>
    
