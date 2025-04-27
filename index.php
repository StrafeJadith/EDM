<?php

    require_once "./config/app.php";
    require_once "./autoload.php";
    require_once "./app/view/inc/session_start.php";


    if(isset($_GET['views'])){
                                    
        $url = explode("/",$_GET['views']);

    }else{

        $url = ["index"];

    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "./app/view/inc/headInicio.php" ?>



        <?php
        
            use app\controller\viewsController;
            use app\controller\loginController;

            $insLogin = new loginController();

            $viewsController = new viewsController();
            $vista = $viewsController->obtenerViewsController($url[0]);

                if($vista == "inicio" || $vista == "404"){


                    require_once "./app/view/content/Home/".$vista."-view.php";

                }
                else{

                    require_once $vista;

                }

    include "./app/view/inc/script.php"; 


    ?>

</body>
</html>
