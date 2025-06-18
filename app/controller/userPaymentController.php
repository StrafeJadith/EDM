<?php

namespace app\controller;
use app\model\mainModel;
require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class userPaymentController extends mainModel{

    public function pagoCreditoController(){

        $correo = $_SESSION["correo"];
        $pago = 2;

        $checkUser = $this->ejecutarConsulta("SELECT * FROM usuarios WHERE Correo_US = '$correo'");
        $dataUser = $checkUser->fetch();

        $idUser = $dataUser["ID_US"];
        $nameUser = $dataUser["Nombre_US"];

        $checkSale = $this->ejecutarConsulta("SELECT sum(Valor_total) as sumvent, Cantidad_VENT, Nombre_VENT, Estado_VENT FROM ventas WHERE ID_US = $idUser AND Estado_VENT = 'Proceso'");

        if ($checkSale->rowCount()<1) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "¡Sin ventas!",
                "texto" => "No tienes ventas aun.",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        $dataSale = $checkSale->fetch();

        $sumSale = $dataSale['sumvent'];
        $nameSale = $dataSale['Nombre_VENT'];
        $cantSale = $dataSale['Cantidad_VENT'];
        $saleState = $dataSale['Estado_VENT'];
        $totalSale = $dataSale["sumvent"];
        $checkCredit = $this->ejecutarConsulta("SELECT * FROM credito WHERE Correo_CR = '$correo' AND Estado_ACT = 1");

        if($checkCredit->rowCount() < 0){

            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Credito inactivo",
                "texto"=>"No puede pagar con creditos porque no tiene uno activo en la tienda",
                "icono"=>"error"
            ];

            return json_encode($alerta);
            exit();
        }


        
        $creditData = $checkCredit->fetch();
        $creditValue = $creditData["Valor_CR"];

        if ($sumSale > $creditValue) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Credito insuficiente",
                "texto" => "No tienes suficiente credito para realizar esta compra",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        $spentCredit = $sumSale - $creditValue;
        $dateTime = date("Y-m-d");

        $creditSale = [
            [
                "campo_nombre" => "Valor_GC",
                "campo_marcador" => ":valor_Gasto",
                "campo_valor" => $sumSale
            ],

            [
                "campo_nombre" => "Fecha_GC",
                "campo_marcador" => ":Gasto_Fecha",
                "campo_valor" => $dateTime
            ],

            [
                "campo_nombre" => "ID_US",
                "campo_marcador" => ":idUser",
                "campo_valor" => $idUser
            ]

        ];

        $insertSale = $this->guardarDatos("gasto_credito", $creditSale);

        if (!$insertSale) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Error al guardar creditos",
                "texto" => "Intentelo mas tarde",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        // $checkProd = $this->ejecutarConsulta("SELECT * FROM productos WHERE Nombre_PRO = '$nameSale'");

        // if ($checkProd->rowCount() < 1) {
        //     $alerta = [
        //         "tipo" => "simple",
        //         "titulo" => "Producto no disponible",
        //         "texto" => "El producto no se encuentra disponible",
        //         "icono" => "error"
        //     ];
        //     return json_encode($alerta);
        //     exit();
        // }


        

        $dataCredit = [
            [
                "campo_nombre"=>"Valor_CR",
                "campo_marcador"=>":Valor",
                "campo_valor"=>$spentCredit
            ]
        ];

        $condicion = [
            
                "condicion_campo"=>"ID_US",
                "condicion_marcador"=>":IdUsuario",
                "condicion_valor"=>$idUser
            
        ];

        $updateCredit = $this->actualizarDatos("credito", $dataCredit, $condicion);


        $dataInfoCredit = [
            [
                "campo_nombre" => "FECHA_DV",
                "campo_marcador" => ":Fecha",
                "campo_valor" => $dateTime
            ],
            [
                "campo_nombre" => "TOTAL_DV",
                "campo_marcador" => ":TotalVenta",
                "campo_valor" => $sumSale
            ],
            [
                "campo_nombre" => "ID_US",
                "campo_marcador" => ":IdUsuario",
                "campo_valor" => $idUser
            ],
            [
                "campo_nombre" => "ID_MTP",
                "campo_marcador" => ":MetodoPago",
                "campo_valor" => $pago
            ]
        ];

        $insertInfoCredit = $this->guardarDatos("detalle_de_venta", $dataInfoCredit);

        $updateSaleState = [
            [
                "campo_nombre" => "Estado_VENT",
                "campo_marcador" => ":Estado_venta",
                "campo_valor" => "Confirmado"
            ]
        ];

        $conditionSaleState = [
            
                "condicion_campo" => "ID_US",
                "condicion_marcador" => ":IdUsuario",
                "condicion_valor" => $idUser
            
        ];

        $executeUpdate = $this->actualizarDatos("ventas", $updateSaleState, $conditionSaleState);

        $getProdId = $this->ejecutarConsulta("SELECT ID_PRO FROM productos WHERE Nombre_PRO = '$nameSale'");

        if ($getProdId->rowCount() < 1) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Producto no disponible",
                "texto" => "El producto no se encuentra disponible",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        $dataProd = $getProdId->fetch();
        $idProd = $dataProd["ID_PRO"];


        $existing_quantity = $this->ejecutarConsulta("SELECT cantidad_existente FROM productos  where ID_PRO = $idProd");

        if ($existing_quantity->rowCount() < 1) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Producto no disponible",
                "texto" => "El producto no se encuentra disponible",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        $dataQuantity = $existing_quantity->fetch();
        $existing_values = (int) $dataQuantity["cantidad_existente"];

        $newQuantity = $existing_values - $cantSale;

        $dataProdUpdate = [
            [
                "campo_nombre" => "cantidad_existente",
                "campo_marcador" => ":nuevaCantidad",
                "campo_valor" => $newQuantity
            ]
        ];

        $conditionProdUpdate = [
            
                "condicion_campo" => "ID_PRO",
                "condicion_marcador" => ":IdProducto",
                "condicion_valor" => $idProd
            
        ];

        $executeProdData = $this->actualizarDatos("productos", $dataProdUpdate, $conditionProdUpdate);

        
        $correoEnviado = $this->enviarCorreoCompraExitosa($correo,$nameUser,$dateTime,$nameSale,$cantSale,$totalSale);
        if($executeProdData && $correoEnviado){

            $alerta = [
                "tipo" => "recargar",
                "titulo" => "¡Compra exitosa!",
                "texto" => "Compra realizada con exito",
                "icono" => "success"
            ];
            return json_encode($alerta);
            exit();
            
        }

        else{

            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "No se pudo realizar la compra o no se pudo enviar el correo correctamente",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        

        
    }

    public function enviarCorreoCompraExitosa($correo,$nameUser,$dateTime,$nameSale,$cantSale,$totalSale){

            try {
                    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'jmolinaresnavarro@gmail.com';
                    $mail->Password = 'lgbp qnrr beou qrpq';
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    $mail->setFrom('jmolinaresnavarro@gmail.com', 'TIENDA LA MANO DE DIOS');
                    $mail->addAddress($correo);

                    $mail->isHTML(true);
                    $mail->Subject = 'Compra realizada';
                    $mail->Body = 'Hola, ' . $nameUser . '<br> Gracias por tu compra en la tienda, aqui tienes un detalle de tu compra:  <br> Fecha compra: ' . $dateTime . '<br> Nombre del producto: ' . $nameSale . '<br> Cantidad comprada: ' . $cantSale . '<br> Metodo de pago: ' . "Credito" . '<br> Total Compra: ' . $totalSale . '<br> Se notificara a su numero de telefono para la recoger el producto';

                    $mail->send();
                    return true;
            } catch (\PHPMailer\PHPMailer\Exception $e) {
                    return $mail->ErrorInfo;
            }
    }
}


?>