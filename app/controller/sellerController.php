<?php

    namespace app\controller;
    use app\model\mainModel;

    class sellerController extends mainModel{

        public function registrarVendedorControlador(){
    
            $cedula=$this->limpiarCadena($_POST['ID_US']);
            $nombre=$this->limpiarCadena($_POST['Nombre_US']);
            $correo=$this->limpiarCadena($_POST['Correo_US']);
            $telefono=$this->limpiarCadena($_POST['Telefono_US']);
            $direccion=$this->limpiarCadena($_POST['Direccion_US']);
            $contraseña=$this->limpiarCadena($_POST['Contraseña_US']);
            $contraseña2=$this->limpiarCadena($_POST['Contraseña_US2']);
            $tipoVend = 2;

            # Verificar datos obligatorios #

            if($cedula == "" || $nombre == "" || $correo == "" || $telefono == "" || $contraseña == ""){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"No has llenado todos los campos que son obligatorios",
                    "icono"=>"error"
                ];

                
                return json_encode($alerta);
                exit();
            }

            # Verificacion de formato #

            if($this->verificarDatos("[0-9]{3,15}",$cedula)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La cedula no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("^[A-Za-z]+( [A-Za-z]+)*$",$nombre)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"El usuario no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("[0-9]{3,20}",$telefono)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"El telefono no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("[a-zA-Z0-9]{5,100}",$contraseña) || $this->verificarDatos("[a-zA-Z0-9]{5,100}",$contraseña2)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La contraseña no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            # Verificando Email #

            if($correo!=""){
                if(filter_var($correo,FILTER_VALIDATE_EMAIL)){
                    $check_correo = $this->ejecutarConsulta("SELECT Correo_US FROM usuarios WHERE Correo_US = '$correo'");
                    if($check_correo->rowCount()>0){
                        $alerta=[
                            "tipo"=>"simple",
                            "titulo"=>"Ocurrio un error inesperado",
                            "texto"=>"El correo ingresado ya se encuentra registrado",
                            "icono"=>"error"
                        ];
        
                        return json_encode($alerta);
                        exit();
                    }
                }else{
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"Ha ingresado un correo electronico no valido.",
                        "icono"=>"error"
                    ];

                    return json_encode($alerta);
                    exit();
                }
            }

            #Verificando clave #

            if($contraseña!=$contraseña2){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"Las contraseñas no coinciden.",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();

            }else{

                $contraseñaEncriptada = password_hash($contraseña,PASSWORD_BCRYPT,["cost"=>10]);

            }

            #Verificando Usuario#

            $check_usuario = $this->ejecutarConsulta("SELECT Nombre_US FROM usuarios WHERE Nombre_US = '$nombre'");
                    if($check_usuario->rowCount()>0){
                        $alerta=[
                            "tipo"=>"simple",
                            "titulo"=>"Ocurrio un error inesperado",
                            "texto"=>"El usuario ingresado ya existe",
                            "icono"=>"error"
                        ];
        
                        return json_encode($alerta);
                        exit();
                    }

            $usuario_datos_registros = [
                [
                    "campo_nombre"=>"ID_US",
                    "campo_marcador"=>":Cedula",
                    "campo_valor"=>$cedula
                ],
                [
                    "campo_nombre"=>"Nombre_US",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=>$nombre
                ],
                [
                    "campo_nombre"=>"Correo_US",
                    "campo_marcador"=>":Correo",
                    "campo_valor"=>$correo
                ],
                [
                    "campo_nombre"=>"Direccion_US",
                    "campo_marcador"=>":Direccion",
                    "campo_valor"=>$direccion
                ],
                [
                    "campo_nombre"=>"Telefono_US",
                    "campo_marcador"=>":Telefono",
                    "campo_valor"=>$telefono
                ],
                [
                    "campo_nombre"=>"Contrasena_US",
                    "campo_marcador"=>":Contrasena",
                    "campo_valor"=>$contraseñaEncriptada
                ],
                [
                    "campo_nombre"=>"ID_TU",
                    "campo_marcador"=>":tipoUsuario",
                    "campo_valor"=>$tipoVend
                ]
            ];

            $registrar_usuario = $this->guardarDatos("usuarios",$usuario_datos_registros);

            if($registrar_usuario->rowCount()==1){

                $alerta=[
                    "tipo"=>"limpiar",
                    "titulo"=>"Usuario Registrado!",
                    "texto"=>"El usuario ".$nombre." fue registrado satisfactoriamente.",
                    "icono"=>"success"
                ];

                
            }else{

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"No se pudo registrar el usuario.",
                    "icono"=>"error"
                ];

                
            }
            
            return json_encode($alerta);
            
        }

        # Controlador para eliminar un usuario #

        public function eliminarVendedorControlador(){

            $ID = $this->limpiarCadena($_POST['ID_US']);

            #Verificacion del usuario#

            $datos=$this->ejecutarConsulta("SELECT * FROM usuarios WHERE ID_US = $ID");

            if($datos->rowCount()<=0){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"El usuario no existe",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();

            }else{

                $datos=$datos->fetch();

            }

            $eliminarUsuario = $this->eliminarRegistro("usuarios","ID_US",$ID);

            if($eliminarUsuario->rowCount()==1){

                $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"Usuario Eliminado!",
                    "texto"=>"El usuario ".$datos['Nombre_US']." fue eliminado satisfactoriamente.",
                    "icono"=>"success"
                ];

            }else{

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"El usuario ".$datos['Nombre_US']." no se pudo eliminar del sistema.",
                    "icono"=>"error"
                ];

            }

            return json_encode($alerta);
        
        }

        public function actualizarVendedorControlador(){


            #Verificacion del usuario#
            # Almacenando datos #
            $cedula=$this->limpiarCadena($_POST['ID_US']);
            $nombre=$this->limpiarCadena($_POST['Nombre_US']);
            $correo=$this->limpiarCadena($_POST['Correo_US']);
            $direccion=$this->limpiarCadena($_POST['Direccion_US']);
            $telefono=$this->limpiarCadena($_POST['Telefono_US']);
            
            $datos=$this->ejecutarConsulta("SELECT * FROM usuarios WHERE ID_US = $cedula");

            $datos = $datos->fetch();

            # Verificar datos obligatorios #

            if($nombre == "" || $correo == "" || $telefono == "" || $direccion == ""){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"No has llenado todos los campos que son obligatorios",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }


            # Verificacion de formato #

            if($this->verificarDatos("^[A-Za-z]+( [A-Za-z]+)*$",$nombre)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"El usuario no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("[0-9]{3,20}",$telefono)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"El telefono no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            if($correo!="" && $datos['Correo_US']!=$correo){
                if(filter_var($correo,FILTER_VALIDATE_EMAIL)){
                    $check_correo = $this->ejecutarConsulta("SELECT Correo_US FROM usuarios WHERE Correo_US = '$correo'");
                    if($check_correo->rowCount()>0){
                        $alerta=[
                            "tipo"=>"simple",
                            "titulo"=>"Ocurrio un error inesperado",
                            "texto"=>"El correo ingresado ya se encuentra registrado",
                            "icono"=>"error"
                        ];
        
                        return json_encode($alerta);
                        exit();
                    }
                }else{
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"Ha ingresado un correo electronico no valido.",
                        "icono"=>"error"
                    ];

                    return json_encode($alerta);
                    exit();
                }
            }

            $vendedor_datos_act = [
                [
                    "campo_nombre"=>"Nombre_US",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=>$nombre
                ],
                [
                    "campo_nombre"=>"Correo_US",
                    "campo_marcador"=>":Correo",
                    "campo_valor"=>$correo
                ],
                [
                    "campo_nombre"=>"Direccion_US",
                    "campo_marcador"=>":Direccion",
                    "campo_valor"=>$direccion
                ],
                [
                    "campo_nombre"=>"Telefono_US",
                    "campo_marcador"=>":Telefono",
                    "campo_valor"=>$telefono
                ]
            ];

            $condicion = [
                
                        "condicion_campo"=>"ID_US",
                        "condicion_marcador"=>":ID",
                        "condicion_valor"=>$cedula
                
            ];

            if($this->actualizarDatos("usuarios",$vendedor_datos_act,$condicion)){

                $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"Usuario Actualizado!",
                    "texto"=>"El usuario ".$datos['Nombre_US']." fue actualizado satisfactoriamente.",
                    "icono"=>"success"
                ];

                
            }else{

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"No se pudo actualizar el usuario.",
                    "icono"=>"error"
                ];

                
            }

            return json_encode($alerta);
        }
    }