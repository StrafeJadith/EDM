<?php

namespace app\controller;
use app\model\mainModel;
use PDO;

class sellerController extends mainModel
{

    public function registrarVendedorControlador()
    {

        $cedula = $this->limpiarCadena($_POST['ID_US']);
        $nombre = $this->limpiarCadena($_POST['Nombre_US']);
        $correo = $this->limpiarCadena($_POST['Correo_US']);
        $telefono = $this->limpiarCadena($_POST['Telefono_US']);
        $direccion = $this->limpiarCadena($_POST['Direccion_US']);
        $contraseña = $this->limpiarCadena($_POST['Contraseña_US']);
        $contraseña2 = $this->limpiarCadena($_POST['Contraseña_US2']);
        $tipoVend = 2;

        # Verificar datos obligatorios #

        if ($cedula == "" || $nombre == "" || $correo == "" || $telefono == "" || $contraseña == "") {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error",
                "texto" => "No has llenado todos los campos que son obligatorios",
                "icono" => "error"
            ];


            return json_encode($alerta);
            exit();
        }

        # Verificacion de formato #

        if ($this->verificarDatos("[0-9]{3,15}", $cedula)) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "La cedula no coincide con el formato solicitado",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        if ($this->verificarDatos("^[A-Za-z]+( [A-Za-z]+)*$", $nombre)) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El usuario no coincide con el formato solicitado",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        if ($this->verificarDatos("[0-9]{3,20}", $telefono)) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El telefono no coincide con el formato solicitado",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        if ($this->verificarDatos("[a-zA-Z0-9]{5,100}", $contraseña) || $this->verificarDatos("[a-zA-Z0-9]{5,100}", $contraseña2)) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "La contraseña no coincide con el formato solicitado",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        # Verificando Email #

        if ($correo != "") {
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $check_correo = $this->ejecutarConsulta("SELECT Correo_US FROM usuarios WHERE Correo_US = '$correo'");
                if ($check_correo->rowCount() > 0) {
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Ocurrio un error inesperado",
                        "texto" => "El correo ingresado ya se encuentra registrado",
                        "icono" => "error"
                    ];

                    return json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrio un error inesperado",
                    "texto" => "Ha ingresado un correo electronico no valido.",
                    "icono" => "error"
                ];

                return json_encode($alerta);
                exit();
            }
        }

        #Verificando clave #

        if ($contraseña != $contraseña2) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "Las contraseñas no coinciden.",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();

        } else {

            $contraseñaEncriptada = password_hash($contraseña, PASSWORD_BCRYPT, ["cost" => 10]);

        }

        #Verificando Usuario#

        $check_usuario = $this->ejecutarConsulta("SELECT ID_US FROM usuarios WHERE ID_US = $cedula");
        if ($check_usuario->rowCount() > 0) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "No se puede agregar un usuario con una identificacion existente.",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        $usuario_datos_registros = [
            [
                "campo_nombre" => "ID_US",
                "campo_marcador" => ":Cedula",
                "campo_valor" => $cedula
            ],
            [
                "campo_nombre" => "Nombre_US",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre
            ],
            [
                "campo_nombre" => "Correo_US",
                "campo_marcador" => ":Correo",
                "campo_valor" => $correo
            ],
            [
                "campo_nombre" => "Direccion_US",
                "campo_marcador" => ":Direccion",
                "campo_valor" => $direccion
            ],
            [
                "campo_nombre" => "Telefono_US",
                "campo_marcador" => ":Telefono",
                "campo_valor" => $telefono
            ],
            [
                "campo_nombre" => "Contrasena_US",
                "campo_marcador" => ":Contrasena",
                "campo_valor" => $contraseñaEncriptada
            ],
            [
                "campo_nombre" => "ID_TU",
                "campo_marcador" => ":tipoUsuario",
                "campo_valor" => $tipoVend
            ]
        ];

        $registrar_usuario = $this->guardarDatos("usuarios", $usuario_datos_registros);

        if ($registrar_usuario->rowCount() == 1) {

            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Usuario Registrado!",
                "texto" => "El usuario " . $nombre . " fue registrado satisfactoriamente.",
                "icono" => "success"
            ];


        } else {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "No se pudo registrar el usuario.",
                "icono" => "error"
            ];


        }

        return json_encode($alerta);

    }

    # Controlador para eliminar un usuario #

    public function eliminarVendedorControlador()
    {

        $ID = $this->limpiarCadena($_POST['ID_US']);

        #Verificacion del usuario#

        $datos = $this->ejecutarConsulta("SELECT * FROM usuarios WHERE ID_US = $ID");

        if ($datos->rowCount() <= 0) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error",
                "texto" => "El usuario no existe",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();

        } else {

            $datos = $datos->fetch();

        }

        $eliminarUsuario = $this->eliminarRegistro("usuarios", "ID_US", $ID);

        if ($eliminarUsuario->rowCount() == 1) {

            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Usuario Eliminado!",
                "texto" => "El usuario " . $datos['Nombre_US'] . " fue eliminado satisfactoriamente.",
                "icono" => "success"
            ];

        } else {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El usuario " . $datos['Nombre_US'] . " no se pudo eliminar del sistema.",
                "icono" => "error"
            ];

        }

        return json_encode($alerta);

    }

    public function actualizarVendedorControlador()
    {


        #Verificacion del usuario#
        # Almacenando datos #
        $cedula = $this->limpiarCadena($_POST['ID_US']);
        $nombre = $this->limpiarCadena($_POST['Nombre_US']);
        $correo = $this->limpiarCadena($_POST['Correo_US']);
        $direccion = $this->limpiarCadena($_POST['Direccion_US']);
        $telefono = $this->limpiarCadena($_POST['Telefono_US']);

        $datos = $this->ejecutarConsulta("SELECT * FROM usuarios WHERE ID_US = $cedula");

        $datos = $datos->fetch();

        # Verificar datos obligatorios #

        if ($nombre == "" || $correo == "" || $telefono == "" || $direccion == "") {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error",
                "texto" => "No has llenado todos los campos que son obligatorios",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }


        # Verificacion de formato #

        if ($this->verificarDatos("^[A-Za-z]+( [A-Za-z]+)*$", $nombre)) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El usuario no coincide con el formato solicitado",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        if ($this->verificarDatos("[0-9]{3,20}", $telefono)) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El telefono no coincide con el formato solicitado",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        if ($correo != "" && $datos['Correo_US'] != $correo) {
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $check_correo = $this->ejecutarConsulta("SELECT Correo_US FROM usuarios WHERE Correo_US = '$correo'");
                if ($check_correo->rowCount() > 0) {
                    $alerta = [
                        "tipo" => "simple",
                        "titulo" => "Ocurrio un error inesperado",
                        "texto" => "El correo ingresado ya se encuentra registrado",
                        "icono" => "error"
                    ];

                    return json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Ocurrio un error inesperado",
                    "texto" => "Ha ingresado un correo electronico no valido.",
                    "icono" => "error"
                ];

                return json_encode($alerta);
                exit();
            }
        }

        $vendedor_datos_act = [
            [
                "campo_nombre" => "Nombre_US",
                "campo_marcador" => ":Nombre",
                "campo_valor" => $nombre
            ],
            [
                "campo_nombre" => "Correo_US",
                "campo_marcador" => ":Correo",
                "campo_valor" => $correo
            ],
            [
                "campo_nombre" => "Direccion_US",
                "campo_marcador" => ":Direccion",
                "campo_valor" => $direccion
            ],
            [
                "campo_nombre" => "Telefono_US",
                "campo_marcador" => ":Telefono",
                "campo_valor" => $telefono
            ]
        ];

        $condicion = [

            "condicion_campo" => "ID_US",
            "condicion_marcador" => ":ID",
            "condicion_valor" => $cedula

        ];

        if ($this->actualizarDatos("usuarios", $vendedor_datos_act, $condicion)) {

            $alerta = [
                "tipo" => "recargar",
                "titulo" => "Usuario Actualizado!",
                "texto" => "El usuario " . $datos['Nombre_US'] . " fue actualizado satisfactoriamente.",
                "icono" => "success"
            ];


        } else {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "No se pudo actualizar el usuario.",
                "icono" => "error"
            ];


        }

        return json_encode($alerta);
    }

    public function consultarUsuarioVendedorControlador()
    {

        $cedula1 = $this->limpiarCadena($_POST['usuario_cedula']);


        if ($cedula1 == "") {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error",
                "texto" => "Digita una cedula para buscar un usuario",
                "icono" => "error"
            ];


            return json_encode($alerta);
            exit();
        }



        if ($this->verificarDatos("[0-9]{3,15}", $cedula1)) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "La cedula no coincide con el formato solicitado",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }


        // $usuario = $this->seleccionarDatos("Unico","usuarios","ID_US",$cedula1);
        $usuario = $this->ejecutarConsulta("SELECT * FROM usuarios WHERE ID_US = $cedula1");
        $datos = $usuario->fetch(PDO::FETCH_ASSOC);

        $usuario = $this->ejecutarConsulta("SELECT c.Valor_Total, c.ID_US, c.Valor_CR  FROM credito c WHERE c.ID_US = $cedula1");
        $datosCr = $usuario->fetch(PDO::FETCH_ASSOC);

        $usuario1 = $this->ejecutarConsulta("SELECT sum(ac.Monto_AC) as MontoSuma FROM abono_credito ac
                                    JOIN credito c ON c.ID_CR = ac.ID_CR
                                    WHERE ac.ID_US = $cedula1
                                    AND c.Estado_ACT = 1
                                    ");
        $datosAb = $usuario1->fetch(PDO::FETCH_ASSOC);

        if (!empty($datos) && !empty($datosCr) && !empty($datosAb)) {
            $respuesta = [

                'usuarios' => $datos,
                'credito' => $datosCr,
                'abono' => $datosAb
            ];
            return json_encode($respuesta);
        } else {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El usuario no tiene un credito activo",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

    }

    public function abonarDineroVendedorControlador()
    {

        $cedula = $this->limpiarCadena($_POST['usuario_cedula']);
        $montoAbono = $this->limpiarCadena($_POST['montoAbono']);
        $correo = $this->limpiarCadena($_POST['usuario_email']);

        # Verificar datos obligatorios #

        if ($cedula == "" || $montoAbono == "") {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error",
                "texto" => "No has llenado todos los campos que son obligatorios",
                "icono" => "error"
            ];


            return json_encode($alerta);
            exit();
        }

        if ($this->verificarDatos("[0-9]{3,15}", $cedula)) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "La cedula no coincide con el formato solicitado",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        #Consultar la tabla de creditos para realizar consultas de verificacion #

        $consultaCredito = $this->ejecutarConsulta("SELECT c.* from credito c where c.estado_ACT = 1 and c.Correo_CR = '$correo'; ");
        $resultConsultaCredito = $consultaCredito->fetch();

        if (empty($resultConsultaCredito)) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Haz saldado tu deuda.",
                "texto" => "Haz pagado por completo tu credito",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();

        } else {

            $ID_US = $resultConsultaCredito['ID_US'];
            $creditoTotal = $resultConsultaCredito['Valor_Total'];
        }




        #Consultar el monto de abono credito para posteriormente realizar una suma de toda la columna #
        $consultaMontoSuma = $this->ejecutarConsulta("SELECT sum(ac.Monto_AC) as MontoSuma FROM abono_credito ac
                        JOIN credito c ON c.ID_CR = ac.ID_CR
                        WHERE ac.ID_US = $ID_US
                        AND Estado_ACT = 1;
                        OR Estado_CR = 'Finalizado'");

        if ($consultaMontoSuma->rowCount() < 1) {
            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "Usted  no tiene un credito activo",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        $resultMontoSuma = $consultaMontoSuma->fetch();
        $montoSuma = $resultMontoSuma['MontoSuma'];


        # Verificacion de monto apto #
        $resp = ($montoAbono % 100 == 0);
        $valorLimite = $montoAbono + $montoSuma;

        # Resultado si el monto no es multiplo de 100 #
        if (!$resp) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "Solo se aceptan multiplos de 100",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        #Verificar el valor limite del abono, es importante ya que asi no se pagan abonos superiores a los abonos pedidos #
        if ($valorLimite > $creditoTotal) {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "El monto limite a pagar es: " . $creditoTotal,
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();

        }

        # Verificar estado de la cuenta #
        $estadoCr = "";
        if ($estadoCr == "En espera") {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "Su credito sigue en proceso de admision",
                "icono" => "error"
            ];

            return json_encode($alerta);
            exit();
        }

        $consultaIdCredito = $this->ejecutarConsulta("SELECT us.ID_US, c.ID_CR , c.Estado_ACT, us.Nombre_US FROM usuarios us 
                JOIN credito c ON c.ID_US = us.ID_US 
                WHERE Correo_US = '$correo'
                AND c.Estado_ACT = 1");

        $traerIdCredito = $consultaIdCredito->fetch();
        $ID_CR = $traerIdCredito['ID_CR'];
        $nombreUs = $traerIdCredito['Nombre_US'];

        $usuario_abono_credito = [

            [
                "campo_nombre" => "Monto_AC",
                "campo_marcador" => ":abonoMonto",
                "campo_valor" => $montoAbono
            ],
            [
                "campo_nombre" => "ID_US",
                "campo_marcador" => ":Cedula",
                "campo_valor" => $cedula
            ],
            [
                "campo_nombre" => "ID_CR",
                "campo_marcador" => ":idCredito",
                "campo_valor" => $ID_CR
            ],

        ];

        $registrar_abono_credito = $this->guardarDatos("abono_credito", $usuario_abono_credito);


        if ($montoAbono + $montoSuma == $creditoTotal) {

            $actualizarAValoresDeFabrica = $this->ejecutarConsulta("UPDATE credito SET Estado_ACT = 0 AND Estado_CR = 'Finalizado' WHERE Correo_CR = '$correo'");

            if ($actualizarAValoresDeFabrica) {

                $alerta = [
                    "tipo" => "simple",
                    "titulo" => "Pagado!",
                    "texto" => "Haz pagado por completo tu credito",
                    "icono" => "success"
                ];

            }
        } else if ($registrar_abono_credito->rowCount() == 1) {

            $alerta = [
                "tipo" => "limpiar",
                "titulo" => "Usuario Registrado!",
                "texto" => "El abono a nombre de " . $nombreUs . " fue registrado satisfactoriamente.",
                "icono" => "success"
            ];


        } else {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error inesperado",
                "texto" => "No se pudo registrar el abono.",
                "icono" => "error"
            ];

        }

        return json_encode($alerta);

    }

    public function consultarCreditosUsuariosVendedorControlador()
    {

        $idCredito = $this->limpiarCadena($_POST['id_credito_usuario']);

        if ($idCredito == "") {

            $alerta = [
                "tipo" => "simple",
                "titulo" => "Ocurrio un error",
                "texto" => "Digita la identificacion del para buscar un usuario",
                "icono" => "error"
            ];


            return json_encode($alerta);
            exit();

        }


        $sql = $this->ejecutarConsulta("SELECT * FROM credito WHERE ID_CR = $idCredito");
        $datos = $sql->fetch();

        if ($datos) {
            $respuesta = [
                "creditos" => [
                    "ID_CR" => $datos['ID_CR'],
                    "Nombre_CR" => $datos['Nombre_CR'],
                    "Correo_CR" => $datos['Correo_CR'],
                    "Telefono_CR" => $datos['Telefono_CR'],
                    "Direccion_CR" => $datos['Direccion_CR'],
                    "Estado_CR" => $datos['Estado_CR'],
                    "Fecha_CR" => $datos['Fecha_CR'],
                    "Valor_CR" => $datos['Valor_CR']
                ]
            ];

            return json_encode($respuesta);
            exit();
        }

    }

}