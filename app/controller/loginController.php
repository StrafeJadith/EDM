<?php

    namespace app\controller;
    use app\model\mainModel;

    class loginController extends mainModel{

        # Controlador iniciar sesion #

        public function iniciarSesionControlador(){

            #Almacenando datos#
            $usuario=$this->limpiarCadena($_POST['correo']);
            $contraseña=$this->limpiarCadena($_POST['contraseña']);


            if($usuario == "" || $contraseña == ""){

                echo "
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Ocurrio un error inesperado',
                            text: 'No has llenado todos los campos',
                            confirmButtonText: 'Aceptar'
                        });
                    </script>
                ";
            }else{

                #Verificacion de los usuarios#

                $check_usuario = $this->ejecutarConsulta("SELECT * FROM usuarios WHERE correo_US = '$usuario'");

                    if($check_usuario->rowCount()==1){

                        $check_usuario=$check_usuario->fetch();

                        if($check_usuario['Correo_US'] == $usuario && password_verify($contraseña,$check_usuario['Contrasena_US'])){

                            $_SESSION['id']=$check_usuario['ID_US'];
                            $_SESSION['nombre']=$check_usuario['Nombre_US'];
                            $_SESSION['correo']=$check_usuario['Correo_US'];

                            if(headers_sent()){

                                echo "
                                    <script>
                                        window.location.href='".APP_URL."adminDashboard/';    
                                    </script>";
                            }else{

                                header("Location: ".APP_URL."adminDashboard/");
                            }
                        }else{

                            echo "
                                <script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Ocurrio un error inesperado',
                                        text: 'Usuario o clave incorrecta.',
                                        confirmButtonText: 'Aceptar'
                                    });
                                </script>
                            ";
                        }

                    }else{

                        echo "
                            <script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Ocurrio un error inesperado',
                                    text: 'Usuario o clave incorrecta.',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>
                        ";

                    }
            }
        }

        # Controlador para cerrar iniciar sesion #

        public function cerrarSesionControlador(){

            
            
            session_destroy();

            if(headers_sent()){

                echo "<script> window.location.href='".APP_URL."indexInicio/';</script>";

            }else{

                header("Location: ".APP_URL."indexInicio/");
                
            }
        }

    }