<?php

    namespace app\model;

    class viewsModel{

        protected function obtenerViewsModel($vista){

            $listaBlanca=["indexProductos","indexCreditosInicio","indexHistoria","indexInicio","indexRegistro","indexOlvidoContraseña","adminDashboard","adminTablaClientes","adminReportesUsuarios","adminVendedores","adminReportesVendedores",
            "adminCategoria","adminProductos","adminCreditos","adminVentas","adminDetalleDeVenta","log-Out"];

            if(in_array($vista,$listaBlanca)){
                if(is_file("./app/view/content/Home/".$vista."-view.php")){

                    $contenido ="./app/view/content/Home/".$vista."-view.php";

                }
                else if(is_file("./app/view/content/Admin/".$vista."-view.php")){

                    $contenido ="./app/view/content/Admin/".$vista."-view.php";

                }
                else if(is_file("./app/view/content/Salesman/".$vista."-view.php")){

                    $contenido = "./app/view/content/Salesman/".$vista."-view.php";
                }
                else if(is_file("./app/view/content/User/".$vista."-view.php")){

                    $contenido = "./app/view/content/User/".$vista."-view.php";
                }
                else{

                    $contenido = "404";

                }
            }
            elseif($vista == "inicio" || $vista == "index"){

                $contenido = "inicio";
            
            }else{

                $contenido = "404";

            }

            return $contenido;

        }
    }