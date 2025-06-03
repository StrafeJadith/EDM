<?php
if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }
?>

<?php require_once "./app/view/inc/headInicio.php" ?> 
<link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/CreditosInicio.css">
</head>

<body id="bodyCreditos">

    <!-- HEADER -->
    <header id="headerCreditos">
        <div id="barranav">


            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?php echo APP_URL; ?>public/img/logo.png" width="350px" height="200px" style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                        </div>
                    </form>
                </div>


                <?php require_once './app/view/inc/navHome.php' ?>
            </div>

        </div>
    </header>


    <!--CONTEXTO DE LA PAGINA O ARTICULOS -->

    <div id="content">
        <p>
        <h3><strong> Solicitar un credito nunca habia sido tan facil.</strong></h3> <br><br>
        <li><strong> Facil de usar. </strong></li><br>
        <li><strong> Facilita los procesos de credito presenciales. </strong></li><br>
        <li><strong> Control de tus transacciones y estado en la tienda. </strong></li><br>
        <li><strong> Haz transacciones con facilidad desde cualquier dispositivo. </strong></li><br>
        </p>

        <?php

        if (!empty($_SESSION['correo'])) {
            $correo = $_SESSION['correo'];
            $sql = $insLogin->ejecutarConsulta("SELECT * FROM credito WHERE Correo_CR = '$correo'");
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
            if(count($resultado) > 0) {
                header("location: Usuario/gasto credito.php");
            }
        }

        if (!empty($_SESSION['correo'])) { ?>
            <a href="<?php echo APP_URL; ?>userCredito/"><button type="button" id="btn1">Solicitalo aqui</button></a>
        <?php } else { ?>
            <a href="<?php echo APP_URL; ?>indexInicio/"><button type="button" id="btn1">Solicitalo aqui</button></a>
        <?php } ?>


    </div>


    <!--FOOTER-->

    <?php require_once './app/view/inc/footer.php' ?>
