<?php

if (!isset($_SESSION['correo'])) {

    $insLogin->cerrarSesionControlador();
    exit();
}
?>

<link rel="stylesheet" href="<?= APP_URL ?>public/css/inicio&&registro/navHome.css">

<link rel="stylesheet" href="<?= APP_URL ?>public/css/Usuario/gasto credito.css">

</head>

<body>
    <header id="headerCreditos">
        <div id="barranav">

            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL ?>public/img/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

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
                    $ConsultaCr = $insLogin->ejecutarConsulta("SELECT * FROM credito WHERE Correo_CR = '$correo'AND Estado_ACT = 1");
                    $rowCr = $ConsultaCr->fetch();
                    $creditoTotal = 0;
                    $estadoCredito = "Sin solicitud de credito";
                    $valorCredito = 0;
                    $gasto_Credito = 0;
                    if (!empty($rowCr)) {
                        $creditID = $rowCr["ID_CR"];
                        $creditoTotal = $rowCr['Valor_Total'];
                        $estadoCredito = $rowCr['Estado_CR'];
                        $valorCredito = $rowCr['Valor_CR'];
                    }

                    //!CONSULTAR ID DEL USUARIO
                    $consultarIdAbono = $insLogin->ejecutarConsulta("SELECT ID_US FROM usuarios WHERE Correo_US = '$correo'");
                    $resultIdAbono = $consultarIdAbono->fetch();
                    $IdeUs = $resultIdAbono['ID_US'];

                    //!TRAER LOS GASTOS DEL USUARIO
                    $ConsultaCr = $insLogin->ejecutarConsulta("SELECT sum(Valor_GC) as gasto FROM gasto_credito WHERE ID_CR = $creditID");
                    $resultConCr = $ConsultaCr->fetch();
                    $gasto_Credito = $resultConCr["gasto"];

                    ?>
                    <tr>
                        <td><strong>Estado Credito</strong></td>
                        <td><strong><?= $estadoCredito ?></strong></td>
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
                        <td><strong><?= $valorCredito ?></strong></td>
                    </tr>
                </thead>
            </table>
            <br><br><br>
            
        </div>
    </div>

    <script src="<?= APP_URL ?>public/js/pagos.js"></script>
    <?php require_once './app/view/inc/footer.php' ?>