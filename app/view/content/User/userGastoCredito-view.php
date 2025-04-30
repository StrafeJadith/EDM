<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }
?>

    <link rel="stylesheet" href="<?= APP_URL ?>public/css/Usuario/gasto credito.css">
    
</head>

<body>
    <header id="headerCreditos"></header>
    <div id="barranav">

        <div id="ContainerNav">
            <div id="Logos">
                <img src="<?= APP_URL ?>public/img/logo.png" width="350px" height="200px"
                    style="padding-left: 10px; padding-top: 0px">

                <form class="form-inline">
                    <div class="form-group">
                        <input type="text" class="form-control"
                            placeholder="Buscar...                                                                               🔎        "
                            style="width: 450px;">
                    </div>
                </form>
            </div>


            <?php require_once './app/view/inc/navUser.php' ?>
        </div>

    </div>
    </header>

    <div class="containerMid">
        <?php require_once './app/view/inc/menuLateralUser.php' ?>
        <div class="padre">
            <table>
                <thead>

                    <?php
                    $correo = $_SESSION['correo'];
                    $ConsultaCr = $insLogin->ejecutarConsulta("SELECT * FROM credito WHERE Correo_CR = '$correo'");
                    $rowCr = $ConsultaCr->fetchAll(PDO::FETCH_ASSOC);
                    $creditoTotal = 0;
                    $fechasCr = "Sin credito realizado";

                    if (!empty($rowCr["Valor_Total"])) {
                        $creditoTotal = $rowCr['Valor_Total'];
                        $fechasCr = $rowCr['Fecha_CR'];
                        //CONSULTAR ID DEL USUARIO
                        $consultarIdAbono = $insLogin->ejecutarConsulta("SELECT ID_US FROM usuarios WHERE Correo_US = '$correo'");
                        $resultIdAbono = $consultarIdAbono->fetchAll(PDO::FETCH_ASSOC);
                        $IdeUs = $resultIdAbono['ID_US'];

                        //TRAER LOS GASTOS DEL USUARIO
                        $ConsultaCr = $insLogin->ejecutarConsulta("SELECT sum(Valor_GC) as gasto FROM gasto_credito WHERE ID_US = $IdeUs");
                        $resultConCr = $ConsultaCr->fetchAll(PDO::FETCH_ASSOC);
                        $gasto_Credito = $resultConCr["gasto"];

                        $sql = $insLogin->ejecutarConsulta("SELECT * FROM credito WHERE Correo_CR = '$correo'");
                        

                        ?>
                        <tr>
                            <td><strong>Estado Credito</strong></td>
                            <td><strong><?php echo $rowCr['Estado_CR'] ?></strong></td>
                        </tr>
                        <tr>

                            <td><strong>Credito Total</strong></td>
                            <td><strong>$<?= $creditoTotal ?></strong></td>
                        </tr>
                        <tr>
                            <td><strong>Gastos</strong></td>
                            <td><strong>$<?= $gasto_Credito ?></strong></td>
                        </tr>
                        <tr>
                            <td><strong>Credito restante</strong></td>
                            <td><strong><?php echo $rowCr['Valor_CR'] ?></strong></td>
                        </tr>
                    <?php }
                    ?>


                </thead>
            </table>
            <br><br><br>
            <tr>
                <?php
                /* consulta para que aparezca el boton*/
                $CreditoSolicitud = 0;
                $estadoCredito = 0;

                $sqlCredito = $insLogin->ejecutarConsulta("SELECT * FROM credito WHERE Correo_CR = '$correo'");
                $consulta = $sqlCredito->fetchAll(PDO::FETCH_ASSOC);
                foreach($consulta as $row ) {
                    
                    $CreditoSolicitud = $row['Estado_ACT'];
                    $estadoCredito = $row['Estado_CR'];
                }
                /* solicitud nuevo credito  */
                if ($CreditoSolicitud == 0 && $estadoCredito == "Aceptado") { ?>
                    <a href="nuevoCredito.php"><button type="button" class="btn">Solicitar un nuevo credito</button></a>
                <?php } ?>
            </tr>
        </div>
    </div>
    
    <script src="<?= APP_URL ?>public/js/pagos.js"></script>
    <?php require_once './app/view/inc/footer.php' ?>