<?php


    namespace app\controller;
    use app\model\mainModel;

    class userSalesController extends mainModel{
        


        public function guardarProducto(){
            $idProd =$this->limpiarCadena($_POST["ID_PRO"]);
            $nombreProd = $this->limpiarCadena($_POST["Nombre_PRO"]);
            $precioProd = $this->limpiarCadena($_POST["Precio_PRO"]);
            $cantidadProd =$this->limpiarCadena($_POST["Cantidad_PRO"]);

            if(empty($cantidadProd)){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Campo vacio",
                    "texto"=>"No has llenado todos los campos que son obligatorios",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
            }
            if($cantidadProd <=0){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Cantidad invalida",
                    "texto"=>"Por favor digite una cantidad valida",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
            }

            $check_prod = $this->ejecutarConsulta("SELECT Cantidad_Existente FROM productos WHERE ID_PRO = $idProd");

            if($check_prod->rowCount()<1){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Error en la consulta ",
                    "texto"=>"Por favor espere unos minutos o intente mas tarde",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
            }

            $datos = $check_prod->fetch();
            $cantExist = $datos["Cantidad_Existente"];                      

            if($cantidadProd>$cantExist){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Cantidad excedida ",
                    "texto"=>"La cantidad escogida es mayor a la cantidad existente {$cantExist}",
                    "icono"=>"error"                   
                ];                
                return json_encode($alerta);
                exit();
            }
        }
        
        
    }