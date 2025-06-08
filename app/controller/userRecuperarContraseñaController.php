<?php
    
    namespace app\controller;
    use app\model\mainModel;

    require_once __DIR__ . '/../../vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    class userRecuperarContraseñaController extends mainModel{

        public function RecuperarContrasenaControlador(){

            $correo = $this->limpiarCadena($_POST['correoElectronico']);

            // Verificar que el correo existe en la BD
            $check_usuario = $this->ejecutarConsulta("SELECT ID_US FROM usuarios WHERE Correo_US = '$correo'");
            if ($check_usuario->rowCount() <= 0) {

                $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"El correo ingresado no existe en la base de datos.",
                    "icono"=>"error"
                ];

                
                return json_encode($alerta);
                exit();
            }

            // Generar código
            $codigo = rand(100000, 999999);
            $expiracion = date("Y-m-d H:i:s", strtotime("+10 minutes"));
            // Guardar el código en la base de datos

            $sql_update = $this->ejecutarConsulta("UPDATE usuarios SET Codigo_US = '$codigo', CodigoExp_US = '$expiracion' WHERE Correo_US = '$correo'");

            if (!$sql_update) {

                $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"Error al guardar el codigo",
                    "icono"=>"error"
                ];

                
                return json_encode($alerta);
                exit();
            }

            // Enviar el correo
            $enviado = $this->enviarCorreoRecuperacion($correo, $codigo);

            if ($enviado === true) {

                $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"¡Codigo enviado!",
                    "texto"=>"Codigo enviado al correo.",
                    "icono"=>"success"
                ];

                
                return json_encode($alerta);
                exit();
            } else {

                $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"Error al enviar correo: $enviado",
                    "icono"=>"error"
                ];

                
                return json_encode($alerta);
                exit();
                
            }
        }

        private function enviarCorreoRecuperacion($correo, $codigo) {
            
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
                $mail->Subject = 'Recuperacion de contrasena';
                $mail->Body = "Tu código de recuperación es: <strong>$codigo</strong><br>Este código es válido por 10 minutos.";

                $mail->send();
                return true;
            } catch (\PHPMailer\PHPMailer\Exception $e) {
                return $mail->ErrorInfo;
            }
        }

        public function validarCodigoYActualizarContrasena(){

            $codigo = $this->limpiarCadena($_POST['Codigo']);
            $nuevaContrasena = $this->limpiarCadena($_POST['Contraseña']);
            $confirmarContrasena = $this->limpiarCadena($_POST['repetirContraseña']);

            if ($nuevaContrasena !== $confirmarContrasena) {
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado.",
                    "texto"=>"Las contraseñas no coinciden.",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("[a-zA-Z0-9]{5,100}",$nuevaContrasena) || $this->verificarDatos("[a-zA-Z0-9]{5,100}",$confirmarContrasena)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La contraseña no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            // Buscar el usuario por el código y verificar expiración
            $sql = $this->ejecutarConsulta("SELECT ID_US, CodigoExp_US FROM usuarios WHERE Codigo_US = '$codigo'");
            if ($sql->rowCount() <= 0) {
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado.",
                    "texto"=>"Codigo invalido.",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
            }

            $usuario = $sql->fetch();
            $fecha_actual = date("Y-m-d H:i:s");

            if ($usuario['CodigoExp_US'] < $fecha_actual) {
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado.",
                    "texto"=>"Codigo Expirado.",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
            }

            $hash = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

            //Actualizar la contraseña y limpiar código y expiración
            $update = $this->ejecutarConsulta("UPDATE usuarios 
                SET Contrasena_US = '$hash', Codigo_US = NULL, CodigoExp_US = NULL
                WHERE ID_US = {$usuario['ID_US']}");

            if ($update) {
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Actualizado",
                    "texto"=>"Contraseña actualizada correctamente",
                    "icono"=>"success"                   
                ];
                return json_encode($alerta);
                exit();
            } else {
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado.",
                    "texto"=>"La contraseña no se pudo actualizar.",
                    "icono"=>"error"                   
                ];
                return json_encode($alerta);
                exit();
            }
        }
}