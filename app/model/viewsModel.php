<?php

    namespace app\model;

    class viewsModel{

        protected function obtenerViewsModel($vista){

            //La variable $listaBlanca es un array que tiene como valor TODAS LAS VISTAS CORRECTAS, si alguna lista que se le pase por el parametro no esta aqui, posiblemente termine en Not Found.
            $listaBlanca=["indexProductos","indexCreditosInicio","indexHistoria","indexInicio",
            "indexRegistro","indexOlvidoContraseña","adminDashboard","adminTablaClientes",
            "adminReportesUsuarios","adminVendedores","adminReportesVendedores","adminCategoria",
            "adminProductos","adminReportesProductos","adminCreditos","adminVentas","adminDetalleDeVenta",
            "vendMenu","vendExistencias","vendCreditosUsuario","vendAbonoCreditos","vendUsuarios",
            "userIndex","userAbonoCredito","userCarritoCompra","userCredito","userGastoCredito",
            "userMetodoAbono","userNuevoCredito","userPago","userPerfilUser","userVentas","log-Out",
            "indexProteinas","indexGranos","indexHigieneBucal","indexHigieneCorporal",
            "indexHigieneFacial","indexLimpieza","indexOtros","indexVerduras"];

            if(in_array($vista,$listaBlanca)){ //Se verifica si en el array $listaBlanca hay una valor de vista que coincida con la el valor de la vista pasada por el parametro.
                if(is_file("./app/view/content/Home/".$vista."-view.php")){ //Si es un archivo la direccion pasada entra a la condicion.

                    $contenido ="./app/view/content/Home/".$vista."-view.php";//Si todo salio bien $contenido tiene el valor de una vista real, en este caso de Home.

                }
                else if(is_file("./app/view/content/Admin/".$vista."-view.php")){

                    $contenido ="./app/view/content/Admin/".$vista."-view.php";//Si todo salio bien $contenido tiene el valor de una vista real, en este caso de Admin.

                }
                else if(is_file("./app/view/content/Salesman/".$vista."-view.php")){

                    $contenido = "./app/view/content/Salesman/".$vista."-view.php";//Si todo salio bien $contenido tiene el valor de una vista real, en este caso de Vendedor.
                }
                else if(is_file("./app/view/content/User/".$vista."-view.php")){

                    $contenido = "./app/view/content/User/".$vista."-view.php";//Si todo salio bien $contenido tiene el valor de una vista real, en este caso de Usuario.
                }
                else{

                    $contenido = "404"; // Si no por defecto tiene el valor 404

                }
            }
            elseif($vista == "inicio" || $vista == "index"){

                $contenido = "inicio"; //Si es igual a inicio o index, se le pone un valor por defecto
            
            }else{

                $contenido = "404"; // Si no es ninguna de las anteriores tiene valor por defecto 404

            }

            return $contenido;// Se retorna el valor de la vista.

        }
    }