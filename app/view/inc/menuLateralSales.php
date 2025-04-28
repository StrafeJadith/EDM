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
                        <details>
                            <summary>Productos</summary>
                            <br>
                            <ul>
                                <li><a href="<?= APP_URL; ?>vendExistencias/">Existencias</a></li>
                            </ul>
                        </details>
                    </div>
                </div>
                <div class="creditos">
                    <div class="imagencreditos">
                        <img src="<?= APP_URL; ?>public/img/Usuario/Creditos.png" alt="">
                    </div>
                    <div class="creditossubtitulo">
                        <a href="<?= APP_URL; ?>vendCreditosUsuario/">
                            <h4>Creditos</h4>
                        </a>
                    </div>
                </div>
                <div class="ventas">
                    <div class="ventassubtitulo">
                        <br>
                        <br>
                        <br>
                        <a href="<?php echo APP_URL; ?>log-Out/" id="botonExit">Cerrar sesión</a>
                    </div>
                </div>
</div>