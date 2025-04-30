

<?php require_once "./app/view/inc/headInicio.php" ?>
<link rel="stylesheet" href="<?php echo APP_URL; ?>public/css/inicio.css">
    <style>
        footer {
            background-color: #d3b386;
            padding: 50px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body class="gridContainer">

    
    <header id="headerCreditos">
        <div id="barranav">


            <div id="ContainerNav">
                <div id="Logos">
                    <img src="<?= APP_URL; ?>public/img/logo.png" width="350px" height="200px" style="padding-left: 10px; padding-top: 0px">

                    <form class="form-inline">
                        <div class="form-group">
                        </div>
                    </form>
                </div>


                <?php require_once './app/view/inc/navHome.php' ?>
            </div>

        </div>
    </header>
    <div class="containerInicio">


        <div class="parrafoInicio">
            <h1>Tienda la <br> Mano de Dios</h1>

            <p class="fs-4" style="color: #77583e;">Nosotros queremos brindarles el mejor servicio y
                <br> adaptarnos a sus necesidades para ser una
                <br> microempresa conocida y poder mejorar nuestros
                <br> servicios a ustedes.
            </p>

            <?php

            if (empty($_SESSION['correo'])) { ?>
                <a href="<?= APP_URL; ?>indexInicio/"><button type="button" class="btn " style="width: 200px;"> Descubrelo</button></a>

            <?php } ?>

        </div>

        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" id="divCarousel">
                    <img src="<?= APP_URL; ?>public/img/tienda.jpg" alt="...">
                </div>
                <div class="carousel-item" id="divCarousel">
                    <img src="<?= APP_URL; ?>public/img/tienbarri.jpg" alt="...">
                </div>
                <div class="carousel-item" id="divCarousel">
                    <img src="<?= APP_URL; ?>public/img/tienbarri2.jpg" alt="...">
                </div>
            </div>
        </div>
    </div>
    <?php require_once './app/view/inc/footer.php' ?>
