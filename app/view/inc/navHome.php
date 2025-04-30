<nav id="Nav">
                    <div id="NavList">

                        <ul id="Listas">
                            <a href="<?= APP_URL; ?>inicio/">
                                <li><strong> Inicio </strong></li>
                            </a>
                            <a href="<?= APP_URL; ?>indexProductos/">
                                <li><strong> Productos </strong></li>
                            </a>

                            <?php

                            if (empty($_SESSION['correo'])) { ?>

                                <a href="<?= APP_URL; ?>indexCreditosInicio/">

                                    <li><strong> Creditos </strong></li>
                                </a>
                                <a href="<?= APP_URL; ?>indexHistoria/">
                                    <li><strong> Sobre Nosotros </strong></li>
                                </a>
                                <a href="<?= APP_URL; ?>indexInicio/"><button type="button" class="btn">Iniciar
                                        Sesion</button></a>

                            <?php } else { ?>
                                <a href="<?= APP_URL; ?>indexCreditosInicio/">
                                    <li><strong> Creditos </strong></li>
                                </a>
                                <a href="<?= APP_URL; ?>log-Out/"><button type="button" class="btn">Cerrar Sesión</button></a>

                                <a href="<?= APP_URL; ?>userCarritoCompra/">
                                    <li><img src="<?= APP_URL; ?>public/img/carrito.png" width="40px" height="40px" style="margin-top: -18px;">
                                    </li>
                                </a>
                                <a href="<?= APP_URL; ?>userIndex/">
                                    <li><img src="<?= APP_URL; ?>public/img/home.svg" width="40px" height="40px" style="margin-top: -18px;">
                                    </li>
                                </a>
                            <?php } ?>


                        </ul>

                    </div>

</nav>