<div class="menu">
                <br>
                <div class="imagen1">
                    <img src="<?= APP_URL; ?>public/img/Usuario/iconousuario.png.png" alt="">
                </div>
                <div class="correo">
                    <?php
                    $correo = $_SESSION['correo'];
                    $sql = $insLogin->ejecutarConsulta("SELECT Nombre_US FROM usuarios WHERE Correo_US = '$correo'");
                    $rows = $sql->fetch();
                    $nombre = $rows['Nombre_US'];
                    
                    echo "Bienvenido " . $nombre . "<br>";
                    echo $correo;
                    ?>
                </div>
                <br>
                <br>
                <div class="subtitulomenu">
                    <a href="<?= APP_URL; ?>vendMenu/">
                        <h3>Menú</h3>
                    </a>
                </div>
                <br>
                <div class="usuarios">
                    <div class="imagenusuarios">
                        <img src="<?= APP_URL; ?>public/img/Usuario/Usuarios.png" alt="">
                    </div>
                    <div class="usuariossubtitulo">
                        <a href="<?= APP_URL; ?>vendUsuarios/">
                            <h4>Usuarios</h4>
                        </a>
                    </div>
                </div>
                <div class="productos">
                    <div class="imagenproductos">
                        <img src="<?= APP_URL; ?>public/img/Usuario/Productos.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                                <a href="<?= APP_URL; ?>vendExistencias/"><h4>Existencias</h4></a>
                    </div>
                </div>
                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="<?= APP_URL ?>public/img/Administrador/Creditos.png" class="lista_img">
                        <a href="#" class="nav_link"> Creditos </a>
                        <img src="<?= APP_URL ?>public/img/Usuario/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>vendCreditosUsuario/" class="nav_link nav_link--inside"> Creditos activos  </a>
                        </li>
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>vendAbonoCreditos/" class="nav_link nav_link--inside"> Abonos de creditos </a>
                        </li>
                    </ul>
                </li>
                <div class="ventas">
                    <div class="ventassubtitulo">
                        <br>
                        <br>
                        <br>
                        <a href="<?php echo APP_URL; ?>log-Out/" id="botonExit">Cerrar sesión</a>
                    </div>
                </div>
</div>