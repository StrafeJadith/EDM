<?php

//este fragmento de codigo es por si la persona esta intentando acceder al apartado de credito sin haber iniciado sesión, si es asi lo mandara a la pagina de inicio para que inicie sesión.

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

?>

    <link rel="stylesheet" href="<?= APP_URL ?>public/css/inicio&&registro/navHome.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>public/css/Usuario/CreditosInicio.css">
    <link rel="stylesheet" href="<?= APP_URL?>public/css/Usuario/sidevar.css">
</head>
<style>
    .btn {
        background-color: #804e23;
        color: white;
        border-radius: 100px;
        width: 170px;
        font-size: 19px;
        margin-left: 150px;
        margin-top: -10px;
    }

    .btn:hover {
        background-color: beige;
        color: #804e23;
        border-radius: 100px;
    }

    h3 {
        margin-top: 20px;
        margin-bottom: 20px;
        color: #804e23;
        font-size: 35px;
    }

    .linea {
        margin-top: 25px;
        padding: 3px;
        background-color: #804e23;
        height: 5px;
        border: none;
    }

    .botonregistrate {
        background-color: #804e23;
        color: white;
        border-radius: 50px;
        border: #804e23;
        width: 200px;
        height: 50px;
        font-size: 20px;
    }

    .Listas a {
        text-decoration: none;
    }
</style>

<body>

    <header id="headerCreditos">
        <div id="barranav">

            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL; ?>public/img/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">
                </div>

                <?php require_once './app/view/inc/navUser.php' ?>
            </div>

        </div>
    </header>

    <section class="Registro">
        <br>
        <br>
        <form class="FormularioAjax" action="<?= APP_URL?>app/ajax/usuarioAjax.php" method="post">
        
            <input type="hidden" name="modulo_usuario" value="solicitarCredito">
            <?php
            //include("../controlador/controladorcredito.php");

            $correo = $_SESSION['correo'];
            $sql = $insLogin->ejecutarConsulta("SELECT * FROM usuarios WHERE Correo_US = '$correo'");
            $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $row) {
                $nombre = $row['Nombre_US'];
                $telefono = $row['Telefono_US'];
                $direccion = $row['Direccion_US'];
                $cedula = $row['ID_US'];
            }

            ?>
            <br>
            <h2 class="sub1 sub-one">Nombre</h2>
            <input type="text" name="nombreUsuarioCr" class="input1" value="<?php echo $nombre ?>" readonly>
            <br>
            <br>
            <h2 class="sub3 sub-one">Telefono</h2>
            <input type="text" name="telefonoUsuarioCr" class="input1" value="<?php echo $telefono ?>" readonly>
            <br>
            <br>
            <h2 class="sub4 sub-one">Dirección</h2>
            <input type="text" name="direccionUsuarioCr" class="input1" value="<?php echo $direccion ?>" readonly>
            <br>
            <br>
            <h2 class="sub5 sub-one">Nùmero de identificaciòn</h2>
            <input type="text" name="cedulaUsuarioCr" class="input1" value="<?php echo $cedula ?>" readonly>
            <br>
            <br>
            <h2 class="sub6 sub-one">Monto</h2>
            <input type="number" name="montoCredito" class="input1" pattern="[0-9]{1,20}" maxlength="20" required>
            <br><br><br>
            <button class="btnregistro" type="submit" name="solicitarCredito">Solicitar</button>
            <br><br>
        </form>
        
    </section>
    
    <?php require_once 'app/view/inc/sidevarCarrito.php'?>
    <script src="<?= APP_URL ?>public/js/sidevar.js"></script>
    <?php require_once './app/view/inc/footer.php' ?>
    