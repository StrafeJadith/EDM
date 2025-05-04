<div class="menu">
                <br>
                <div class="imagen1">
                    <img src="<?php echo APP_URL; ?>public/img/Administrador/UsuarioLogo.png" alt="">
                </div>
                <div class="correo">
                    <?php

                        $correo = $_SESSION['correo'];
                        $sql = $insLogin->ejecutarConsulta("SELECT Nombre_US FROM usuarios WHERE Correo_us = '$correo'");
                        $sql = $sql->fetch();

                        echo "Bienvenido ".$sql['Nombre_US']."<br>";
                        echo $correo;

                    ?>
                </div>
                <br>
                <br>
                <div class="subtitulomenu">
                    <h3>Menú</h3>
                </div>
                <br>

                <!-- <div class="Dashboard">
                    <div class="imagenusuarios">
                        <img src="<?php echo APP_URL; ?>public/img/Administrador/Dashboard.png" alt="">
                    </div>
                    <div class="usuariossubtitulo">
                        <h4><a href="<?php echo APP_URL; ?>adminDashboard/">Dashboard</a></h4>
                    </div>
                </div> -->

                <div class="Dashboard">
                        <img src="<?= APP_URL ?>public/img/Administrador/Dashboard.png" class="lista_img">
                        <a href="<?= APP_URL; ?>adminDashboard/" class="tittleDashboard"> Dashboard </a>
                </div>

                <br>
                <!-- <div class="usuarios">
                    <div class="imagenusuarios">
                        <img src="<?php echo APP_URL; ?>public/img/Administrador/Usuarios.png" alt="">
                    </div>
                    <div class="usuariossubtitulo">
                        <details>
                            <summary>Tipos de usuarios</summary>
                            <ul>
                                <li><a href="<?php echo APP_URL; ?>adminTablaClientes/">Usuarios</a></li>
                                <li><a href="<?php echo APP_URL; ?>adminVendedores/">Vendedores</a></li>
                            </ul>
                        </details>
                        
                    </div>
                </div> -->

                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="<?= APP_URL ?>public/img/Administrador/Usuarios.png" class="lista_img">
                        <a href="#" class="nav_link"> Tipos de Usuarios </a>
                        <img src="<?= APP_URL ?>public/img/Usuario/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>adminTablaClientes/" class="nav_link nav_link--inside"> Clientes  </a>
                        </li>
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>adminVendedores/" class="nav_link nav_link--inside"> Vendedores </a>
                        </li>
                    </ul>
                </li>

                <br>

                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="<?= APP_URL ?>public/img/Administrador/Productos.png" class="lista_img">
                        <a href="#" class="nav_link"> Productos </a>
                        <img src="<?= APP_URL ?>public/img/Usuario/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>adminCategoria/" class="nav_link nav_link--inside"> Categorias </a>
                        </li>
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>adminProductos/" class="nav_link nav_link--inside"> Productos </a>
                        </li>
                    </ul>
                </li>

                <br>

                <div class="CreditoLat">
                        <img src="<?= APP_URL ?>public/img/Administrador/Creditos.png" class="lista_img">
                        <a href="<?= APP_URL; ?>adminCreditos/" class="tittleCredito"> Creditos </a>
                </div>

                <br>

                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="<?= APP_URL ?>public/img/Administrador/Ventas.png" class="lista_img">
                        <a href="#" class="nav_link"> Ventas </a>
                        <img src="<?= APP_URL ?>public/img/Usuario/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>adminVentas/" class="nav_link nav_link--inside"> Ventas </a>
                        </li>
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>adminDetalleDeVenta/" class="nav_link nav_link--inside"> Detalles de ventas </a>
                        </li>
                    </ul>
                </li>

                <div class="cerrarSesion">
                    <a href="<?php echo APP_URL; ?>log-Out/" id="botonExit">Cerrar Sesión</a>  
                </div>

</div>