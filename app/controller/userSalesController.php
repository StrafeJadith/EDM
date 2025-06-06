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

            $dataVent = [
                ["campo_nombre" => "Fecha_VENT",
                "campo_marcador" => ":Fecha",
                "campo_valor" => $fecha
                ],
                
                ["campo_nombre" => "Nombre_VENT",
                "campo_marcador" => ":Nombre",
                "campo_valor" =>$nombreProd],

                ["campo_nombre" => "Precio_VENT",
                "campo_marcador" => ":Precio",
                "campo_valor" => $precioProd],
                
                ["campo_nombre" => "Cantidad_VENT",
                "campo_marcador" => ":Cantidad",
                "campo_valor" =>$cantidadProd],

                ["campo_nombre" => "Valor_Total",
                "campo_marcador" => ":Valor",
                "campo_valor" => $totalPrice],
                
                ["campo_nombre" => "Estado_VENT",
                "campo_marcador" => ":Estado",
                "campo_valor" =>"Proceso"],
                
                ["campo_nombre" => "ID_US",
                "campo_marcador" => ":Id_usuario",
                "campo_valor" => $idUser],

                ["campo_nombre" => "ID_PRO",
                "campo_marcador" => ":Id_producto",
                "campo_valor" => $idProd],

            ];

            $insert_Vent = $this->guardarDatos("ventas", $dataVent);

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

            $dataProdUpdate = [
                ["campo_nombre" => "Cantidad_Existente",
                "campo_marcador" => ":Cantidad",
                "campo_valor" => $newCant]
            ];

            $condicion =[
                "condicion_campo" => "ID_PRO",
                "condicion_marcador" => ":ID_Producto",
                "condicion_valor" => $idProd
            ];

            $update_cant = $this->actualizarDatos("productos", $dataProdUpdate,$condicion);

            $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"¡Guardado! ",
                    "texto"=>"¡Producto guardado exitosamente!",
                    "icono"=>"success"                   
                ];                
                return json_encode($alerta);
                exit();
        }
        

        public function eliminarProducto(){

            $idVent = $this->limpiarCadena($_POST["ID_VENT"]);
            $nameVent = $this->limpiarCadena($_POST["Nombre_VENT"]);
            $cantVent = $this->limpiarCadena($_POST["Cantidad_VENT"]);
            $correo = $_SESSION["correo"];

            $deleteVent = $this->eliminarRegistro("ventas", "ID_VENT" ,$idVent);

            if(!$deleteVent){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Error en el proceso",
                    "texto"=>"¡Vuelvalo a intentar o espere unos minutos!",
                    "icono"=>"error"                   
                ];                
                return json_encode($alerta);
                exit();                
            }

            $checkProd = $this->ejecutarConsulta("SELECT Cantidad_Existente FROM productos Where Nombre_PRO = '$nameVent'");

            $row = $checkProd->fetch();
            $newCant = (int) $row["Cantidad_Existente"];


            $DataProdUpdate = [
                ["campo_nombre" => "Cantidad_Existente",
                "campo_marcador" => ":Cantidad",
                "campo_valor" => $cantVent+$newCant]
            ];

            $condicion =[
                "condicion_campo" => "Nombre_PRO",
                "condicion_marcador" => ":Nombre",
                "condicion_valor" => $nameVent
            ];

            $updateProd = $this->actualizarDatos("productos",$DataProdUpdate,$condicion);
            
            $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"¡Eliminado!",
                    "texto"=>"¡El producto ha sido eliminado de su carrito!",
                    "icono"=>"success"                   
                ];                
                return json_encode($alerta);
                exit();            
            

        }
    }