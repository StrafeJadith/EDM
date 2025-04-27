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

                <div class="Dashboard">
                    <div class="imagenusuarios">
                        <img src="<?php echo APP_URL; ?>public/img/Administrador/Dashboard.png" alt="">
                    </div>
                    <div class="usuariossubtitulo">
                        <h4><a href="<?php echo APP_URL; ?>adminDashboard/">Dashboard</a></h4>
                    </div>
                </div>

                
                <div class="usuarios">
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
                </div>

                <div class="productos">
                    <div class="imagenproductos">
                        <img src="<?php echo APP_URL; ?>public/img/Administrador/Productos.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Productos</summary>
                            
                            <ul>
                                <li><a href="<?php echo APP_URL; ?>adminCategoria/">Categorias</a></li>
                                <li><a href="<?php echo APP_URL; ?>adminProductos/">Productos</a></li>
                                
                            </ul>

                        </details>
                    </div>
                </div>
                <div class="creditos">
                    <div class="imagencreditos">
                        <img src="<?php echo APP_URL; ?>public/img/Administrador/Creditos.png" alt="">
                    </div>
                    <div class="creditossubtitulo">
                        <h4><a href="<?php echo APP_URL; ?>adminCreditos/">Creditos</a></h4>
                    </div>
                </div>
                <div class="ventas">
                    <div class="imagenproductos">
                        <img src="<?php echo APP_URL; ?>public/img/Administrador/Ventas.png" alt="">
                    </div>
                    <div class="productossubtitulo">
                        <details>
                            <summary>Ventas</summary>
                            
                            <ul>
                                <li><a href="<?php echo APP_URL; ?>adminVentas/">Ventas</a></li>
                                <li><a href="<?php echo APP_URL; ?>adminDetalleDeVenta/">Detalles_de_Ventas</a></li>
                            </ul>

                        </details>
                    </div>

                    <a href="<?php echo APP_URL; ?>log-Out/" style="color: white; position: relative; left:40px; text-decoration: none;" id="botonExit">Cerrar Sesión</a>
                </div>
                
                
</div>