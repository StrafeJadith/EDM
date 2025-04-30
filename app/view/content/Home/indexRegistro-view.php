<link rel="stylesheet" href="<?= APP_URL ?>public/css/inicio&&registro/navHome.css">
<link rel="stylesheet" href="<?= APP_URL; ?>public/css/inicio&&registro/Inicio.css">
<!-- <link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/Bulma/bulma.min.css"> -->
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

                
                <?php include './app/view/inc/navHome.php' ?>
                
            </div>

        </div>
    </header>

    <section class="Registro">
        <div class="cabecera">
            <ul class="Registro">
                <li>
                    <h3><a href="<?= APP_URL; ?>indexInicio/" style="text-decoration: none;">INICIAR SESIÓN</a></h3>
                </li>
                <li>
                    <h3>
                        <a href="<?= APP_URL; ?>indexRegistro/">REGÍSTRATE</a>
                    </h3>
                </li>
            </ul>
        </div>
        <div class="linea"></div>
        <br>
        <br>

        

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

    <div class="container pb-6 pt-6" id="Form1">

        <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" autocomplete="off">
            <input type="hidden" name="modulo_usuario" value="registrar">

            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><strong>Cedula de identificacion</strong></span>
                <input type="number" class="form-control" name="usuario_cedula" placeholder="ingrese su cedula" aria-label="ingrese su cedula" aria-describedby="basic-addon1" pattern="[0-9]{1,15}" maxlength="15" required> <br>
                
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><strong>Nombre de usuario</strong></span>
                <input type="text" class="form-control" name="usuario_nombre" placeholder="ingrese su nombre de usuario" aria-label="ingrese su nombre de usuario" aria-describedby="basic-addon1"  pattern="^[A-Za-z]+( [A-Za-z]+)*$" maxlength="20" required>
            </div>
                <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><strong>Correo electronico</strong></span>
                <input type="email" class="form-control" name="usuario_email" placeholder="ingrese su correo electronico" aria-label="ingrese su correo electronico" aria-describedby="basic-addon1" maxlength="70" required>
                <span class="input-group-text" id="basic-addon1"><strong>Telefono</strong></span>
                <input type="number" class="form-control" name="usuario_telefono" placeholder="ingrese su telefono" aria-label="ingrese su telefono" aria-describedby="basic-addon1" pattern="[0,9]{3,20}" maxlength="20" required>
                
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><strong>Direccion</strong></span>
            <input type="text" class="form-control" name="usuario_direccion" placeholder="ingrese su direccion" aria-label="ingrese su direccion" aria-describedby="basic-addon1" maxlength="100">
            </div>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1"><strong>Contraseña</strong></span>
                <input type="password" class="form-control" name="usuario_clave" placeholder="ingrese su contraseña" aria-label="ingrese su contraseña" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required>
                <span class="input-group-text" id="basic-addon1"><strong>Repetir contraseña</strong></span>
                <input type="password" class="form-control" name="usuario_clave1" placeholder="ingrese su contraseña" aria-label="ingrese su contraseña" aria-describedby="basic-addon1" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required>
            </div>

            <button type="reset" class="button "><strong>Limpiar</strong></button>
            <button type="submit" class="button "><strong>Guardar</strong></button>

        </form>

    </div>
    

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
