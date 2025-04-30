

<link rel="stylesheet" href="<?= APP_URL ?>public/css/Usuario/index_.css">
</head>
<body>
<header id="headerCreditos">
        <div id="barranav">
            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL; ?>public/img/logo.png" width="350px" height="200px"
                        style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control"
                                placeholder="    Buscar...                                                                                                     🔎        "
                                style="width: 450px; border-radius: 20px; height: 40px;">
                        </div>
                    </form>
                </div>


                <?php require_once './app/view/inc/navUser.php' ?>
            </div>

        </div>
</header>
<div class="containerUserPerfil">
    <div class="perfilUserIcon">
    <img src="<?= APP_URL ?>public/img/Usuario/user.svg" alt="" class="user">
            <div class="correo">
                    <?php

                        $correo = $_SESSION['correo'];
                        $sql = $insLogin->ejecutarConsulta("SELECT Nombre_US FROM usuarios WHERE Correo_us = '$correo'");
                        $resultadoSql = $sql->fetch();
                        $nombre = $resultadoSql['Nombre_US'];

                        echo "Bienvenido ".$nombre."<br>";
                        echo $correo;

                    ?>
                    
                </div>
                <br>
            <hr style="color: #f9f7dc;">
        <a href="<?= APP_URL ?>userIndex/"><button id="btnUser">Volver al inicio</button></a>
    </div>
    <div class="containerForm">
        <h1>DATOS PERSONALES</h1>
        <?php

            $correo = $_SESSION['correo'];
            $Consultar = $insLogin->ejecutarConsulta("SELECT * FROM usuarios WHERE Correo_US = '$correo'");
            $row = $Consultar->fetch();
            $ID = $row["ID_US"];
            $NOMBRE = $row["Nombre_US"];
            $CORREO = $row["Correo_US"];
            $DIRECCION = $row["Direccion_US"];
            $TELEFONO = $row["Telefono_US"];
            $CONTRASEÑA = $row["Contrasena_US"];
        ?>
            <form action="" method="post">
                <strong>Identificación </strong> <input type="number" name="ID_US_visible" value="<?= $ID ?>" readonly><br>
                <input type="hidden" name="ID_US" value="<?= $ID ?>">
                <strong>Nombre </strong><input type="text" name="NOMBRE_US" value="<?= $NOMBRE ?>"><br>
                <strong>Correo </strong><input type="text" name="CORREO_US" value="<?= $CORREO ?>"><br>
                <strong>Dirección </strong><input type="text" name="DIRECCION_US" value="<?= $DIRECCION ?>"><br>
                <strong>Teléfono </strong><input type="number" name="TELEFONO_US" value="<?= $TELEFONO ?>"><br>
                <strong>Contraseña </strong><input type="password" name="CONTRASEÑA_US"><br>
                <button type="submit" value="Actualizar Datos" name="ActualizarDatosUs" id="btnActUs">Actualizar Datos</button>
            </form>
    </div>
</div>

<?php include './app/view/inc/footer.php'; ?>
