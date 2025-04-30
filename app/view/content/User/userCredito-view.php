<?php

//este fragmento de codigo es por si la persona esta intentando acceder al apartado de credito sin haber iniciado sesión, si es asi lo mandara a la pagina de inicio para que inicie sesión.

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }

?>

    <link rel="stylesheet" href="<?= APP_URL ?>public/css/inicio&&registro/navHome.css">
    <link rel="stylesheet" href="<?= APP_URL; ?>public/css/inicio&&registro/Estilos.css">
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
        <form action="../../controller/controllerInicio.php" method="post">
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
            <input type="text" name="nombre" class="input1" value="<?php echo $nombre ?>" disabled>
            <br>
            <br>
            <h2 class="sub3 sub-one">Telefono</h2>
            <input type="text" name="telefono" class="input1" value="<?php echo $telefono ?>" disabled>
            <br>
            <br>
            <h2 class="sub4 sub-one">Dirección</h2>
            <input type="text" name="direccion" class="input1" value="<?php echo $direccion ?>" disabled>
            <br>
            <br>
            <h2 class="sub5 sub-one">Nùmero de identificaciòn</h2>
            <input type="text" name="cedula" class="input1" value="<?php echo $cedula ?>" disabled>
            <br>
            <br>
            <h2 class="sub6 sub-one">Monto</h2>
            <input type="number" name="monto" class="input1">
            <button class="btnregistro" type="submit" name="solicitarCredito">Solicitar</button>
        </form>
    </section>

    <?php require_once './app/view/inc/footer.php' ?>