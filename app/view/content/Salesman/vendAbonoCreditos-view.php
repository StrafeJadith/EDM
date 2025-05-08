<?php

    if(!isset($_SESSION['correo'])){

        $insLogin->cerrarSesionControlador();
        exit();
        
    }
?>

    <link rel="stylesheet" href="<?= APP_URL ?>public/css/Vendedor/creditosUs.css">
</head>

<body>

    <div class="contenedorprincipal">
        
    <?php require_once './app/view/inc/menuLateralSales.php' ?>

        <div class="abonoUsuarios">
            <div class="containerForm">
                <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/sellerAjax.php" method="POST" autocomplete="off" id="Formu1">

                <h1><strong>Abono de usuarios</strong></h1>

                    <input type="hidden" name="modulo_vendedor" value="Consultar">

                    <div class="">
                            <span class="input-group-text" id="basic-addon1"><strong>Cedula de identificacion</strong></span>
                            <input type="number" class="form-control" name="usuario_cedula" placeholder="ingrese su cedula" aria-label="ingrese su cedula" aria-describedby="basic-addon1" pattern="[0-9]{1,15}" maxlength="15"><br>
                            
                            
                    </div>
                    <button type="submit" id="btnForm1" data-accion="Consultar"><strong>Consultar</strong></button>


                </form>
                <form class="FormularioAjax" action="<?= APP_URL; ?>app/ajax/sellerAjax.php" method="POST" autocomplete="off">
                        <input type="hidden" name="modulo_vendedor" value="abonarDinero">

                        <input type="hidden" class="form-control" name="usuario_cedula" placeholder="ingrese su cedula" aria-label="ingrese su cedula" aria-describedby="basic-addon1" pattern="[0-9]{1,15}" maxlength="15" id="ID_US" value=""><br>

                    <div class="">
                        <span class="input-group-text" id="basic-addon1"><strong>Nombre de usuario</strong></span>
                        <input type="text" class="form-control" id="Nombre_US" name="usuario_nombre" aria-label="ingrese su nombre de usuario" aria-describedby="basic-addon1" readonly><br>
                    </div>

                    <div class="">

                        <span class="input-group-text" id="basic-addon1"><strong>Correo electronico</strong></span>
                            <input type="email" class="form-control" id="Correo_US" name="usuario_email" aria-label="ingrese su correo electronico" aria-describedby="basic-addon1" readonly><br>
                        <span class="input-group-text" id="basic-addon1"><strong>Telefono</strong></span>
                            <input type="number" class="form-control" id="Telefono_US" name="usuario_telefono" aria-label="ingrese su telefono" aria-describedby="basic-addon1" readonly><br>
                        
                    </div>

                    <div class="">

                        <span class="input-group-text" id="basic-addon1"><strong>Direccion</strong></span>
                            <input type="text" class="form-control" id="Direccion_US" name="usuario_direccion" aria-label="ingrese su direccion" aria-describedby="basic-addon1" readonly><br>
                    </div>

                    <div class="input-group mb-3">

                        <span class="input-group-text" id="basic-addon1"><strong>Credito pedido</strong></span>
                            <input type="text" class="form-control" id="Valor_Total" name="creditoPedido" aria-label="ingrese su contraseña" aria-describedby="basic-addon1"readonly>
                        <span class="input-group-text" id="basic-addon1"><strong>Abono actual</strong></span>
                            <input type="text" class="form-control" id="MontoSuma" name="abonoActual" aria-label="ingrese su contraseña" aria-describedby="basic-addon1" readonly>
                        
                    </div>

                    <div class="input-group mb-3">

                        <span class="input-group-text" id="basic-addon1"><strong>Credito restante</strong></span>
                            <input type="text" class="form-control" id="Valor_CR" name="creditoRestante" aria-label="ingrese su contraseña" aria-describedby="basic-addon1"readonly>
                        <span class="input-group-text" id="basic-addon1"><strong>Abonar dinero</strong></span>
                            <input type="number" class="form-control" name="montoAbono" aria-label="ingrese su contraseña" aria-describedby="basic-addon1" >

                    </div>

                    <button type="submit" data-accion="abonarDinero"><strong>Guardar</strong></button>
                    <button type="reset" class="button"><strong>Limpiar</strong></button>
                </form>

            </div>
        </div>
    </div>
    
    <script src="<?= APP_URL ?>public/js/pagos.js"></script>
    
