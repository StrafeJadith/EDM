<?php

    require_once "./config/app.php";
    require_once "./autoload.php";
    require_once "./app/view/inc/session_start.php";


    if(isset($_GET['views'])){ //Se verifica si se obtiene el valor de la vista
                                    
        $url = explode("/",$_GET['views']); //Explode es una funcion que se usa para partir por decirlo asi, una url. Algo que podria ser como youtube/chanel/jadith, te lo devuelve en forma de array tal que asi, [youtube,chanel,jadith], es decir que $url tiene como valor un array.

    }else{

        $url = ["index"]; //Si no se obtiene nada con el primer if, el valor por defecto de $url es "index"

    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "./app/view/inc/headInicio.php" ?>



        <?php
        
            use app\controller\viewsController; // "Use" se utiliza cuando quieres usar una clase creada a partir de un namespace, por ejemplo "namespace app\controller;"
            use app\controller\loginController; // En este caso queremos usar viewsController y LoginController.

            $insLogin = new loginController(); //Se instancia un objeto

            $viewsController = new viewsController();
            $vista = $viewsController->obtenerViewsController($url[0]); //Aqui mediante una variable accedemos a un metodo o funcion de la clase viewsController y le pasamos el parametro de $url, que si recuerdan $url tiene como valor un array y por eso luego de la variable se le pone un [0], porque queremos acceder al primer valor.

                if($vista == "inicio" || $vista == "404"){ //Se verifica lo que tiene como valor $vista


                    require_once "./app/view/content/Home/".$vista."-view.php"; //Se requiere la vista del inicio o la vista Not Found

                }
                else{

                    require_once $vista; // Por lo contrario si lo de arriba no trae nada, se requiere la vista que desea el usuario.

                }

    include "./app/view/inc/script.php"; 


    ?>

</body>
</html>
