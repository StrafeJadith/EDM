<?php

namespace app\controller;
use app\model\mainModel;

class adminCreditosController extends mainModel
{

    public function agregarCreditosControlador()
    {

        $idCredito = $_POST['ID_CR'];
        $idUsuario = $_POST['ID_US'];
        $correoUsuario = $_POST['Correo_CR'];
        $valorCredito = $_POST['Valor_CR'];


        $creditos_datos_registro = [

            [
                "campo_nombre" => "Estado_CR",
                "campo_marcador" => ":estadoCredito",
                "campo_valor" => 'Aceptado'
            ],
            [
                "campo_nombre" => "Valor_Total",
                "campo_marcador" => ":valorTotal",
                "campo_valor" => $valorCredito
            ],
            [
                "campo_nombre" => "Estado_ACT",
                "campo_marcador" => ":estadoAct",
                "campo_valor" => 1
            ]
        ];

        $condicion = [


            "condicion_campo" => "ID_CR",
            "condicion_marcador" => ":IdentificacionCredito",
            "condicion_valor" => $idCredito

        ];

        $datos = $this->ejecutarConsulta("SELECT * FROM credito WHERE ID_CR = $idCredito");

        $datos = $datos->fetch();

        if ($this->actualizarDatos("credito", $creditos_datos_registro, $condicion)) {

            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Credito Aceptado!",
                "texto" => "El credito " . $datos['Nombre_CR'] . " fue aceptado satisfactoriamente.",
                "icono" => "success"
            ];


        } else {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "No se pudo aceptar el credito.",
                "icono" => "error"
            ];


        }

        return json_encode($alerta);
    }

    public function eliminarCreditoControlador()
    {

        $idCredito = $this->limpiarCadena($_POST['idcre']);

        #Verificacion del usuario#

        $datos = $this->ejecutarConsulta("SELECT * FROM credito WHERE ID_CR = $idCredito");

        if ($datos->rowCount() <= 0) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error",
                "texto" => "El producto no existe",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();

        } else {

            $datos = $datos->fetch();

        }

        $check_creditos = $this->ejecutarConsulta("SELECT 1 FROM abono_credito WHERE ID_CR = $idCredito LIMIT 1");
        if ($check_creditos->rowCount() > 0) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "No se puede eliminar el credito porque tiene relaciones con la tabla de Abono Credito.",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        $eliminarCredito = $this->eliminarRegistro("credito", "ID_CR", $idCredito);

        if ($eliminarCredito->rowCount() == 1) {

            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Credito Eliminado!",
                "texto" => "El credito correspondiente a " . $datos['Nombre_CR'] . " fue eliminado satisfactoriamente.",
                "icono" => "success"
            ];

        } else {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El credito corresponidiente a " . $datos['Nombre_CR'] . " no se pudo eliminar del sistema.",
                "icono" => "error"
            ];

        }

        return json_encode($alerta);
    }

    public function actualizarCreditosControlador()
    {

        $valorCredito = $_POST['valorcre'];
        $idCredito = $_POST['idcre'];

        $datos = $this->ejecutarConsulta("SELECT * FROM credito WHERE ID_CR = $idCredito");

        $datos = $datos->fetch();

        if ($this->verificarDatos("[0-9]{1,15}", $valorCredito)) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El valor del credito no coincide con el formato solicitado",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        $creditos_datos_actualizar = [

            [
                "campo_nombre" => "Valor_CR",
                "campo_marcador" => ":valorTotal",
                "campo_valor" => $valorCredito
            ]
        ];

        $condicion = [

            "condicion_campo" => "ID_CR",
            "condicion_marcador" => ":IdentificacionCredito",
            "condicion_valor" => $idCredito
        ];

        if ($this->actualizarDatos("credito", $creditos_datos_actualizar, $condicion)) {

            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Credito Actualizado!",
                "texto" => "El valor del credito correspondiente a " . $datos['Nombre_CR'] . " fue actualizado satisfactoriamente.",
                "icono" => "success"
            ];


        } else {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "No se pudo actualizar el valor del credito.",
                "icono" => "error"
            ];


        }

        return json_encode($alerta);


    }
}