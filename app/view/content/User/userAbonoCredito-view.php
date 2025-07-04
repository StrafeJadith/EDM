<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }
?>

    <link rel="stylesheet" href="<?= APP_URL ?>public/css/Usuario/abono credito.css">
</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL ?>public/img/Usuario/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">
                </div>


                <?php require_once './app/view/inc/navUser.php' ?>

            </div>

        </div>
    </header>

    <div class="containerMid">
        
    <?php require_once './app/view/inc/menuLateralUser.php' ?>

        <div class="padre_tabla">
            <table>

                <?php
                $correo = $_SESSION['correo'];
                $ConsultaCr = $insLogin->ejecutarConsulta("SELECT * FROM credito WHERE Correo_CR = '$correo' AND Estado_ACT = 1");
                $rowCr = $ConsultaCr->fetch();
                $creditoTotal = 0;
                $fechasCr = "Sin credito realizado";
                $AbonoMonto = 0;
                $CreditoRestante = 0;
                if (!empty($rowCr["Valor_Total"])) {
                    $creditoTotal = $rowCr['Valor_Total'];
                    $fechasCr = $rowCr['Fecha_CR'];
                    $consultarIdAbono = $insLogin->ejecutarConsulta("SELECT ID_US FROM usuarios WHERE Correo_US = '$correo'");
                    $rowAb = $consultarIdAbono->fetch(); 
                    $IdeUs = $rowAb['ID_US'];

                    $congastoAbono2 = $insLogin->ejecutarConsulta("SELECT ID_AC FROM abono_credito WHERE ID_US = $IdeUs");;
                    $rowConGast = $congastoAbono2->fetch();
                    if (!empty($rowConGast)) {
                        $IdAc = $rowConGast["ID_AC"];
                    }
                    $IdAc = 0;



                    $conGastoAbono = $insLogin->ejecutarConsulta("SELECT sum(Monto_AC) as MontoSuma FROM abono_credito WHERE ID_US = $IdeUs");
                    $rowAbono = $conGastoAbono->fetch();
                    $AbonoMonto = $rowAbono['MontoSuma'];

                    $CreditoRestante = $creditoTotal - $AbonoMonto;
                    $_SESSION["credRest"] = $CreditoRestante;


                }

                ?>
                <tr>
                    <td>Credito Pedido</td>
                    <td>$<?= $creditoTotal ?></td>
                </tr>

                <tr>
                    <td>Abono Actual</td>
                    <td>$<?= $AbonoMonto ?></td>
                </tr>
                <tr>
                    <td>Total Credito</td>
                    <td>$<?= $CreditoRestante ?></td>
                </tr>

            </table>
        </div>
    </div>
    
    
    <?php require_once './app/view/inc/footer.php' ?>
    <script src="<?= APP_URL ?>public/js/pagos.js"></script>
