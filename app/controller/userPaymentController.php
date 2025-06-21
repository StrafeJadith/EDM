<?php

namespace app\controller;
use app\model\mainModel;
use PDO;

require_once __DIR__ . '/../../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class userPaymentController extends mainModel
{

    public function pagoCreditoController()
    {

        $correo = $_SESSION["correo"];
        $pago = 2;

        $checkUser = $this->ejecutarConsulta("SELECT * FROM usuarios WHERE Correo_US = '$correo'");
        $dataUser = $checkUser->fetch();

        $idUser = $dataUser["ID_US"];
        $nameUser = $dataUser["Nombre_US"];

        $checkSale = $this->ejecutarConsulta("SELECT 
                Valor_total AS sumvent, 
                Cantidad_VENT, 
                Nombre_VENT, 
                Estado_VENT 
                FROM ventas 
                WHERE ID_US = $idUser AND Estado_VENT = 'Proceso'");

        if ($checkSale->rowCount() < 1) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "¡Sin ventas!",
                "texto" => "No tienes ventas aun.",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }


        $detalleHTML = '';
        $totalVenta = 0;
        
        $dataSale = $checkSale->fetchAll(PDO::FETCH_ASSOC);
        foreach ($dataSale as $row){

            $nameSale = $row['Nombre_VENT'];
            $cantSale = $row['Cantidad_VENT'];
            $precio = $row['sumvent'];
            // $sumSale = $row['sumvent'];
            // $totalSale = $row['sumvent'];
            $totalVenta += $precio;

            $detalleHTML .= '
                <tr>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">' . htmlspecialchars($nameSale) . '</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">' . intval($cantSale) . '</td>
                    <td style="padding: 8px; border-bottom: 1px solid #eee;">$' . number_format($precio) . '</td>
                </tr>';
        }
        
        $checkCredit = $this->ejecutarConsulta("SELECT * FROM credito WHERE Correo_CR = '$correo' AND Valor_CR > 0");

        if ($checkCredit->rowCount() < 1) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Credito inactivo",
                "texto" => "No puede pagar con creditos porque no tiene uno activo en la tienda",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        $creditData = $checkCredit->fetch();
        $creditId = $creditData["ID_CR"];
        $creditValue = $creditData["Valor_CR"];

        if ($totalVenta > $creditValue) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Credito insuficiente",
                "texto" => "No tienes suficiente credito para realizar esta compra",
                "icono" => "error"
            ];
            return json_encode($alerta);
            exit();
        }

        $spentCredit = $creditValue - $totalVenta;
        $dateTime = date("Y-m-d");

        $creditSale = [
            [
                "campo_nombre" => "Valor_GC",
                "campo_marcador" => ":valor_Gasto",
                "campo_valor" => $totalVenta
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
            ],
            [
                "campo_nombre" => "ID_CR",
                "campo_marcador" => ":idCr",
                "campo_valor" => $creditId
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

        $updateCredit = $this->ejecutarConsulta("UPDATE credito SET Valor_CR = $spentCredit WHERE ID_US = $idUser AND Estado_ACT = 1");
        // $dataCredit = [
        //     [
        //         "campo_nombre" => "Valor_CR",
        //         "campo_marcador" => ":Valor",
        //         "campo_valor" => $spentCredit
        //     ]
        // ];

        // $condicion = [

        //     "condicion_campo" => "ID_US",
        //     "condicion_marcador" => ":IdUsuario",
        //     "condicion_valor" => $idUser

        // ];

        // $updateCredit = $this->actualizarDatos("credito", $dataCredit, $condicion);


        $dataInfoCredit = [
            [
                "campo_nombre" => "FECHA_DV",
                "campo_marcador" => ":Fecha",
                "campo_valor" => $dateTime
            ],
            [
                "campo_nombre" => "TOTAL_DV",
                "campo_marcador" => ":TotalVenta",
                "campo_valor" => $totalVenta
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

        $correoEnviado = $this->enviarCorreoCompraExitosa($correo, $nameUser, $detalleHTML,$totalVenta);

            if ($updateCredit && $correoEnviado) {

                $alerta = [
                    "tipo" => "recargar",
                    "titulo" => "¡Compra exitosa!",
                    "texto" => "Compra realizada con exito",
                    "icono" => "success"
                ];
                return json_encode($alerta);
                exit();

            } else {

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

    public function enviarCorreoCompraExitosa($correo, $nameUser, $detalleHTML,$totalVenta)
    {

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
            $mail->Body = '
                    <div style="max-width: 600px; margin: auto; padding: 30px; background-color: #ffffff; border-radius: 10px; font-family: Arial, sans-serif; color: #333; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                        <div style="text-align: center; border-bottom: 1px solid #eee; padding-bottom: 20px; margin-bottom: 20px;">
                            <h2 style="color: #28a745; margin: 0;">¡Gracias por tu compra!</h2>
                            <p style="font-size: 14px; color: #666;">Aquí tienes el resumen de tu pedido</p>
                        </div>

                        <p style="font-size: 16px;">Hola, <strong>' . $nameUser . '</strong></p>

                        <p style="font-size: 14px;">Gracias por tu compra en nuestra tienda. Aquí están los detalles:</p>

                        <table style="width: 100%; border-collapse: collapse; font-size: 14px; margin-top: 15px;">
                            <thead>
                                <tr style="background-color: #f1f1f1;">
                                    <th style="padding: 10px; text-align: left;">Producto</th>
                                    <th style="padding: 10px; text-align: left;">Cantidad</th>
                                    <th style="padding: 10px; text-align: left;">Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                ' . $detalleHTML . '
                            </tbody>
                        </table>

                        <p style="margin-top: 20px;">Método de pago: <strong>Crédito</strong></p>
                        <p style="color: #28a745; font-size: 16px;"><strong>Total: $' . number_format($totalVenta) . '</strong></p>

                        <p>Se notificará a tu número de teléfono cuando el producto esté listo para recoger.</p>
                        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
                        <p style="font-size: 12px; color: #aaa; text-align: center;">Este es un mensaje automático. No respondas a este correo.</p>
                    </div>
            ';

            $mail->send();
            return true;
        } catch (\PHPMailer\PHPMailer\Exception $e) {
            return $mail->ErrorInfo;
        }
    }
}


?>