<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

?>

    <link rel="stylesheet" href="<?= APP_URL; ?>public/css/vendedor/menu.css">
</head>

<body>
    
    <section>
        <div class="contenedorprincipal">
            <?php require_once './app/view/inc/menuLateralSales.php'?>

            <div class="apartado">
                <div class="APclientes">
                    <div class="imagenclientes">
                        <img src="<?php echo APP_URL; ?>public/img/Usuario/Usuarios.png" alt="">
                    </div>
                    <div class="clientes">
                        <h3>Usuarios</h3>
                    </div>
                    <div class="span1">
                        <span><?= $insLogin->contarRegistros("usuarios"); ?></span>
                    </div>
                </div>
                <div class="APproductos">
                    <div class="imagenproducto">
                        <img src="<?php echo APP_URL; ?>public/img/Usuario/Productos.png" alt="">
                    </div>
                    <div class="productos2">
                        <h3>Productos</h3>
                    </div>
                    <div class="span2">
                        <span><?= $insLogin->contarRegistros("productos"); ?></span>
                    </div>
                </div>
                <div class="APexistencias">
                    <div class="imagenesexistencias">
                        <img src="<?php echo APP_URL; ?>public/img/Usuario/Existencias.png" alt="">
                    </div>
                    <div class="existencias">
                        <h3>Existencias</h3>
                    </div>
                    <div class="span3">
                        <span>
                            <?php
                        
                                $sql = $insLogin->ejecutarConsulta("SELECT SUM(Cantidad_Total) AS Existencias FROM productos;");
                                $rowSuma = $sql->fetchAll(PDO::FETCH_ASSOC);
                                foreach($rowSuma as $rowSumas){
                                    $ResultSuma = $rowSumas['Existencias'];
                                }
                                    
                                echo $ResultSuma;                        
                            ?></span>
                    </div>
                </div>
                <div class="APexistenciasvendida">
                    <div class="imagenesexistenciasvendida">
                        <img src="<?= APP_URL ?>public/img/Usuario/Existencias.png" alt="">
                    </div>
                    <div class="existenciasvendidas">
                        <h3>Existencias <br> Vendidas</h3>
                    </div>
                    <div class="span4">
                        <span>
                            <?php

                                $sql = $insLogin->ejecutarConsulta("SELECT SUM(Cantidad_Total) - SUM(Cantidad_Existente) AS ExistenciasVendidas FROM productos");
                                $rowResta = $sql->fetchAll(PDO::FETCH_ASSOC);
                                foreach($rowResta as $rowRestas){
                                    $ResultResta = $rowRestas['ExistenciasVendidas'];
                                }
                            
                                echo $ResultResta;

                            ?>
                        </span>
                    </div>
                </div>
                <div class="APcreditos">
                    <div class="ImagenesCredito">
                        <img src="<?= APP_URL ?>public/img/Usuario/Creditos.png" alt="">
                    </div>
                    <div class="Credito">
                        <h3>Creditos</h3>
                    </div>
                    <div class="span5">
                        <span><?= $insLogin->contarRegistros("credito"); ?></span>
                    </div>
                </div>
                <div class="APventas">
                    <div class="Imagenesventas">
                        <img src="<?= APP_URL ?>public/img/Usuario/Ventas.png" alt="">
                    </div>
                    <div class="Ventas">
                        <h3>Ventas</h3>
                    </div>
                    <div class="span6">
                        <span><?= $insLogin->contarRegistros("ventas") ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    