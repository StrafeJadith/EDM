<?php

    namespace app\controller;
    use app\model\mainModel;

    class userSalesController extends mainModel{
        

        public function guardarProducto(){
            $idProd =$this->limpiarCadena($_POST["ID_PRO"]);
            $nombreProd = $this->limpiarCadena($_POST["Nombre_PRO"]);
            $precioProd = $this->limpiarCadena($_POST["Precio_PRO"]);
            $cantidadProd =$this->limpiarCadena($_POST["Cantidad_PRO"]);
            $correo = $_SESSION["correo"];

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

            //?Se obtiene la fecha
            $fecha= date("Y-m-d");
            $totalPrice = (int)($precioProd*$cantidadProd);

            $check_user = $this->ejecutarConsulta("SELECT ID_US FROM usuarios Where Correo_US = '$correo'");
            $row = $check_user->fetch();
            $idUser = $row["ID_US"];

            $insert_Vent= $this->ejecutarConsulta("INSERT INTO ventas( Fecha_VENT, Nombre_VENT, Precio_VENT, Cantidad_VENT,	Valor_total, Estado_VENT, ID_US) VALUES ('$fecha','$nombreProd', $precioProd, $cantidadProd, $totalPrice, 'Proceso', $idUser)");

            if($insert_Vent->rowCount()<1){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Uops",
                    "texto"=>"Hubo un error en la insercion de datos, vuelva a intentarlo",
                    "icono"=>"error"                   
                ];                
                return json_encode($alerta);
                exit();
            }
            $newCant = $cantExist - $cantidadProd;
            $update_cant = $this->ejecutarConsulta("UPDATE productos SET cantidad_existente = $newCant WHERE ID_PRO = $idProd");

            $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"¡Guardado! ",
                    "texto"=>"¡Producto guardado exitosamente!",
                    "icono"=>"success"                   
                ];                
                return json_encode($alerta);
                exit();
        }
        
    }