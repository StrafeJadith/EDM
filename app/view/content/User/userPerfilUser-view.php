<?php include '../../view/inc/header.php'; ?>
<?php include '../../view/inc/nav.php'; ?>
<?php include '../../model/Usuario/ActualizardatosUsuario.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar los Datos del Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../../public/js/alerts.js"></script>
</head>
<body>
<div class="containerUserPerfil">
    <div class="perfilUserIcon">
    <img src="../../../public/img/Usuario/user.svg" alt="" class="user">
            <div class="correo">
                    <?php

                        $correo = $_SESSION['correo'];
                        $sql = "SELECT Nombre_US FROM usuarios WHERE Correo_us = '$correo'";
                        $resultado = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_array($resultado)) {
                            $nombre = $row['Nombre_US'];
                        }

                        echo "Bienvenido ".$nombre."<br>";
                        echo $correo;

                    ?>
                    
                </div>
                <br>
            <hr style="color: #f9f7dc;">
        <a href="index_.php"><button id="btnUser">Volver al inicio</button></a>
    </div>
    <div class="containerForm">
        <h1>DATOS PERSONALES</h1>
        <?php

            $correo = $_SESSION['correo'];
            $Consultar = "SELECT * FROM usuarios WHERE Correo_US = '$correo'";
            $resultConsultar = mysqli_query($conn,$Consultar);
            $row = mysqli_fetch_array($resultConsultar,MYSQLI_ASSOC);
            $ID = $row["ID_US"];
            $NOMBRE = $row["Nombre_US"];
            $CORREO = $row["Correo_US"];
            $DIRECCION = $row["Dirección_US"];
            $TELEFONO = $row["Telefono_US"];
            $CONTRASEÑA = $row["Contraseña_US"];
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

<?php

if (isset($_SESSION["msg"])) {
    $msg = $_SESSION["msg"];

    if ($msg) {
        echo ("<script> $msg </script>");

        unset($_SESSION["msg"]);
    }
}


?>
<?php include '../inc/footer.php'; ?>
</body>
</html>