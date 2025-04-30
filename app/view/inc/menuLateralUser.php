<nav class="nav_">
            <a href="<?= APP_URL ?>userPerfilUser/"><img src="<?= APP_URL ?>public/img/Usuario/user.svg" alt="" class="user"></a>
            <div class="correo">
                <?php

                $correo = $_SESSION['correo'];
                $sql = $insLogin->ejecutarConsulta("SELECT Nombre_US FROM usuarios WHERE Correo_us = '$correo'");
                $row = $sql->fetch();
                $nombre = $row['Nombre_US'];

                echo "Bienvenido " . $nombre . "<br>";
                echo $correo;

                ?>

            </div>
            <br>
            <hr style="color: #f9f7dc;">

            <ul class="lista">
                <li class="lista_item lista_item--click">
                    <a href="<?= APP_URL ?>userIndex/" class="nav_link">
                        <h2>Navegacion</h2>
                    </a>
                </li>
                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="<?= APP_URL ?>public/img/Usuario/creditos.png" class="lista_img">
                        <a href="#" class="nav_link"> CREDITOS </a>
                        <img src="<?= APP_URL ?>public/img/Usuario/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>userGastoCredito/" class="nav_link nav_link--inside"> GASTO DE CREDITO </a>
                        </li>
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>userAbonoCredito/" class="nav_link nav_link--inside"> ABONO DE CREDITO </a>
                        </li>
                    </ul>
                </li>

                <li class="lista_item lista_item--click">
                    <div class="lista_button lista_button--click">
                        <img src="<?= APP_URL ?>public/img/Usuario/ventas.png" class="lista_img">
                        <a href="#" class="nav_link"> VENTAS </a>
                        <img src="<?= APP_URL ?>public/img/Usuario/arrow.svg" class="lista_flecha">
                    </div>
                    <ul class="lista_show">
                        <li class="lista_inside">
                            <a href="<?= APP_URL ?>userVentas/" class="nav_link nav_link--inside"> DETALLE DE VENTA </a>
                        </li>

                    </ul>
                </li>


            </ul>

        </nav>