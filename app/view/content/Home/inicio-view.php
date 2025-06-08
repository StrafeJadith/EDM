

<?php require_once "./app/view/inc/headInicio.php" ?>
<link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/inicio.css">
</head>

<body class="gridContainer">

    
    <header id="headerCreditos">

            <div id="ContainerNav">

                <div id="Logos">
                    <img src="<?= APP_URL; ?>public/img/logo.png">
                </div>

                <?php require_once './app/view/inc/navHome.php' ?>

            </div>
    </header>
    <div id="seccion1" class="containerInicio">


        

        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" id="divCarousel">
                    <img src="<?= APP_URL; ?>public/img/ImagenTienda.jpg" alt="...">
                </div>
                <div class="carousel-item" id="divCarousel">
                    <img src="<?= APP_URL; ?>public/img/ImagenTienda2.jpg" alt="...">
                </div>
                <div class="carousel-item" id="divCarousel">
                    <img src="<?= APP_URL; ?>public/img/ImagenTienda3.jpg" alt="...">
                </div>
            </div>
        </div>

        <div class="parrafoInicio">
            <h1>Tienda la Mano de Dios</h1>

            <p class="fs-4" style="color: white;">Nosotros queremos brindarles el mejor servicio y
                <br> adaptarnos a sus necesidades para ser una
                <br> microempresa conocida y poder mejorar nuestros
                <br> servicios a ustedes.
            </p>

        </div>
    </div>

    <div id="seccion2"  class="containerProductos">
        <h1>Productos</h1>
        <p>En este calago se mostraran algunos de los productos más comprados.</p>

        <div class="productosCatalogo">

            <?php
            $sql = $insLogin->ejecutarConsulta("SELECT * FROM productos LIMIT 6");
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach($rows as $row) { ?>

                <div id="Producto1">
                    
                    <img src="<?= APP_URL.$row['Img'] ?>" alt="" class="imgpro"><br>

                    <p class="descripcion"><strong><?php echo $row['Descripcion_PRO'] ?></strong></p>

                    <p><strong><?php echo $row['Valor_Unitario'] ?></strong></p><br>

                    <button ><a href="<?= APP_URL ?>indexInicio/" class="botonCarritoAlert"><strong>Agregar al carrito</strong></a></button>

                </div>

            <?php } ?>
                    
        </div>
    </div>

    <div id="seccion3" class="containerCreditos">
    <h1 style="text-align: center; position:relative; top: 100px;">Creditos</h1>
        <div id="content">
            <p>
            <h3><strong> Solicitar un credito nunca habia sido tan facil.</strong></h3> <br><br>
            <li><strong> Facil de usar. </strong></li><br>
            <li><strong> Facilita los procesos de credito presenciales. </strong></li><br>
            <li><strong> Control de tus transacciones y estado en la tienda. </strong></li><br>
            <li><strong> Haz transacciones con facilidad desde cualquier dispositivo.</strong></li><br>
            <li><strong> Adquiere creditos mayores por cada pago de un credito.</strong></li><br>
            </p>
            <br>
            <h3><strong>Requisitos o datos a tener en cuenta</strong></h3><br>
            <li><strong>Tener una cuenta registrada.</strong></li><br>
            <li><strong>Si eres nuevo solo puedes acceder a un credito estipulado por el gerente de la tienda.</strong></li><br>
            <li><strong>Los creditos solo pueden ser utilizados dentro de la pagina.</strong></li><br>
            <li><strong>Los creditos solo pueden ser utilizados cuando el gerente lo permita.</strong></li><br>
            <li><strong>Para solicitar un nuevo credito primero debe pagar por completo el anterior.</strong></li><br>
            
            
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
                <a href="<?php echo APP_URL; ?>userCredito/"><button type="button" id="btn1"><strong>Solicitalo aqui</strong></button></a>
            <?php } else { ?>
                <a href="<?php echo APP_URL; ?>indexInicio/"><button type="button" id="btn1"><strong>Solicitalo aqui</strong></button></a>
            <?php } ?>
        </div>
    </div>

    <div id="seccion4" class="containerSobreNosotros">

    <h1 style="text-align: center; position:relative; top: 100px;">Sobre Nosotros</h1>
        <div class="container-custom">

            <img src="<?= APP_URL; ?>public/img/tienbarri.jpg" alt="" id="img-1">
            <img src="<?= APP_URL; ?>public/img/tienbarri2.jpg" alt="" id="img-2">
            <br>
            <br>
            <div class="historia">

                <h3 style="text-align: center;"><strong>HISTORIA</strong></h3> <br>
                <p>Desde sus inicios, La mano de Dios se ubico en el barrio Villa Lozano de Soledad, fue creada en el año 2004, tuvo inicios simples y una clientela que iba comenzando a llegar con el tiempo, a traves de los años la tienda la mano de Dios fue formando
                    su clientela diaria, la cual constaba de la comunidad de sus alrededores, ha seguido vigente diecinueve años desde su creacion y su presencia en la comunidad no es facilmente olvidable a la memoria de sus vecinos.</p>
            </div>
            <br><br><br>

            <div class="mision">

                <h3><strong>MISION</strong></h3><br>

                <p>La tienda la mano de Dios tiene como mision y objetivo el dar el mejor servicio de atencion al cliente de forma rapida, precisa y segura, en el cual se podra atender a la comunidad de forma comoda y se podran realizar prestaciones, proporcionando
                    asi a los alrededores un buen servicio en el cual se llenen todas las necesidades que una tienda comun y corriente provee a la comunidad.
                </p>

            </div>
            <br><br><br>

            <div class="vision">

                    <h3><strong>VISION</strong></h3><br>

                    <p>La tienda la mano de Dios tiene su vision clara, planea ver por el futuro de la tienda, planea permanecer vigente a largo plazo permitiendo asi que la comunidad de los alrededores no solo sean atendidos de forma eficiente y buena, sino que
                        garantiza que la tienda seguira
                    </p>
            </div>
        </div>
    </div>

    
    <?php require_once './app/view/inc/footer.php' ?>
    <script src="<?= APP_URL ?>public/js/alertaBotonCarrito.js"> </script>
    
