

<link rel="stylesheet" href="<?= APP_URL ?>public/css/Usuario/index_.css">
</head>
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
            <form class="FormularioAjax" action="<?= APP_URL ?>app/ajax/usuarioAjax.php" method="post">
                <input type="hidden" name="modulo_usuario" value="actualizarPerfilUser">
                <strong>Identificación </strong> <input type="number" name="ID_US_visible" value="<?= $ID ?>" readonly>
                <input type="hidden" name="ID_US" value="<?= $ID ?>">
                <strong>Nombre </strong><input type="text" name="Nombre_US" pattern="^[A-Za-z]+( [A-Za-z]+)*$" maxlength="20" value="<?= $NOMBRE ?>">
                <strong>Correo </strong><input type="text" name="Correo_US" value="<?= $CORREO ?>" required>
                <strong>Dirección </strong><input type="text" name="Direccion_US" value="<?= $DIRECCION ?>">
                <strong>Teléfono </strong><input type="number" name="Telefono_US" pattern="[0-9]{3,20}" maxlength="20" value="<?= $TELEFONO ?>">
                <strong>Contraseña </strong><input type="password" name="Contrasena_US" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required>
                <strong>Repetir contraseña </strong><input type="password" name="Contrasena_US2" pattern="[a-zA-Z0-9]{5,100}"  maxlength="100" required>
                <button type="submit" value="Actualizar Datos" name="ActualizarDatosUs" id="btnActUs">Actualizar Datos</button>
            </form>
    </div>
</div>

<?php include './app/view/inc/footer.php'; ?>
