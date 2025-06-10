<?php

    namespace app\controller;
    use app\model\mainModel;

    class userPaymentController extends mainModel{

        public function pagoCreditoController(){
            $correo = $this->limpiarCadena($_SESSION["correo"]);
            $pago = 002;
            
            $checkUser = $this->ejecutarConsulta($queryval = "SELECT * FROM usuarios WHERE Correo_US = '$correo'");
            $dataUser = $checkUser->fetch(); 

            $idUser = $dataUser["ID_US"];
            $nameUser = $dataUser["Nombre_US"];

            $checkSale = $this->ejecutarConsulta("SELECT sum(Valor_total) as sumvent, Cantidad_VENT, Nombre_VENT, Estado_VENT FROM ventas WHERE ID_US = $idUser AND Estado_VENT = 'Proceso'");
            $dataSale = $checkSale->fetch();

            $sumSale = $dataSale['sumvent'];
            $nameSale = $dataSale['Nombre_VENT'];
            $cantSale = $dataSale['Cantidad_VENT'];
            $stateSale = $dataSale['Estado_VENT'];   

            $checkCredit = $this->ejecutarConsulta("SELECT * FROM credito WHERE Correo_CR = '$correo' AND Estado_ACT = 1");
            $creditData = $checkCredit->fetch();

            if(!$creditData){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Credito inactivo",
                    "texto"=>"No puede pagar con creditos porque no tiene uno activo en la tienda",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
            }
            $creditValue = $creditData["Valor_CR"];

            if($sumSale>$creditValue){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Credito insuficiente",
                    "texto"=>"No tienes suficiente credito para realizar esta compra",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
            }

            $spentCredit = -$sumSale-$creditValue;
            $dateTime = date("Y-m-d");

            $creditSale = [
                [
                "campo_nombre" => ":Valor_GC",
                "campo_marcador" => ":valor_Gasto",
                "campo_valor" => $sumSale],

                [
                "campo_nombre" => ":Fecha_GC",
                "campo_marcador" => ":Gasto_Fecha",
                "campo_valor" => $dateTime],

                [
                "campo_nombre" => ":ID_US",
                "campo_marcador" => ":idUser",
                "campo_valor" => $idUser]

                ];

                $insertSale = $this->guardarDatos("gasto_credito",$creditSale);

                if(!$insertSale){
                    $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Error al guardar creditos",
                    "texto"=>"Intentelo mas tarde",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
                }

                $checkProd = $this->ejecutarConsulta("SELECT * FROM productos WHERE Nombre_PRO = '$nameSale'");
                
                if($checkProd->rowCount()<1){
                    $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Producto no disponible",
                    "texto"=>"El producto no se encuentra disponible",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
                }

                $dataProd = $checkProd->fetch();
                $idProd = $dataProd["ID_PRO"];



        }



    }


?>