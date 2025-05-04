<?php

    namespace app\controller;
    use app\model\mainModel;

    class userController extends mainModel{

        # Controlador para registrar un usuario #

        public function registrarUsuarioControlador(){

            # Almacenando datos #
            $cedula=$this->limpiarCadena($_POST['usuario_cedula']);
            $nombre=$this->limpiarCadena($_POST['usuario_nombre']);
            $correo=$this->limpiarCadena($_POST['usuario_email']);
            $telefono=$this->limpiarCadena($_POST['usuario_telefono']);
            $direccion=$this->limpiarCadena($_POST['usuario_direccion']);
            $contraseña=$this->limpiarCadena($_POST['usuario_clave']);
            $contraseña2=$this->limpiarCadena($_POST['usuario_clave1']);
            $TipoUser = 3;

            # Verificar datos obligatorios #

            if($cedula == "" || $nombre == "" || $correo == "" || $telefono == "" || $contraseña == "" || $contraseña2 == ""){

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
                    "campo_valor"=>$TipoUser
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


        public function listarUsuariosControlador($pagina,$registros,$url,$busqueda){

            $pagina=$this->limpiarCadena($pagina);
            $registros=$this->limpiarCadena($registros);

            $url=$this->limpiarCadena($url);
            $url=APP_URL.$url."/";

            $busqueda=$this->limpiarCadena($busqueda);
            $tabla="";

            $pagina= (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
            $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0 ;


            if(isset($busqueda) && $busqueda!=""){

                $consulta_datos = "SELECT * FROM usuarios WHERE ((ID_US!='".$_SESSION['id']."' AND ID_US!='1') AND (Nombre_US LIKE '%$busqueda%' OR Correo_US LIKE '%$busqueda%')) ORDER BY Nombre_US ASC LIMIT $inicio,$registros";

                $consulta_total = "SELECT COUNT(ID_US) FROM usuarios WHERE ((ID_US!='".$_SESSION['id']."' AND ID_US!='1') AND (Nombre_US LIKE '%$busqueda%' OR Correo_US LIKE '%$busqueda%'))";

            }else{

                $consulta_datos = "SELECT * FROM usuarios WHERE ID_US!='".$_SESSION['id']."' AND ID_US!='1' ORDER BY Nombre_US ASC LIMIT $inicio,$registros";

                $consulta_total = "SELECT COUNT(ID_US) FROM usuarios WHERE ID_US!='".$_SESSION['id']."' AND ID_US!='1' ";


            }


            $datos = $this->ejecutarConsulta($consulta_datos);
            $datos = $datos->fetchAll();

            $total = $this->ejecutarConsulta($consulta_total);
            $total = (int) $total->fetchColumn();

            $numeroPaginas = ceil($total/$registros);

            $tabla.='
                <div id="tablaUsers">

                    <div id="Reportes">
                        <a href="<?= APP_URL; ?>app/view/content/Admin/adminReportesUsuarios-view.php" class="btn" id="generarReportesUs"><strong>Generar reportes de usuarios</strong></a>
                    </div>

                    <br>
                    <table id="Cl">
                        <tr>
                            <td><strong>IDENTIFICACION</strong></td>
                            <td><strong>NOMBRE</strong></td>
                            <td><strong>CORREO</strong></td>
                            <td><strong>DIRECCION</strong></td>
                            <td><strong>TELEFONO</strong></td>
                            <td><strong>EDITAR</strong></td>
                            <td><strong>ELIMINAR</strong></td>       
                        </tr>                  
                        <tbody>
            ';

            if($total >= 1 && $pagina <= $numeroPaginas){

                $contador=$inicio + 1;
                $pag_inicio=$inicio+1;
                foreach($datos as $rows){
                    $tabla.='
                        <tr>
                            <td>'.$rows['ID_US'].'</td>
                            <td>'.$rows["Nombre_US"].'</td>
                            <td>'.$rows["Correo_US"].'</td>
                            <td>'.$rows["Direccion_US"].'</td>
                            <td>'.$rows["Telefono_US"].'</td>

                            <td>
                                <button id="editarUs" class="editarProd" data-bs-toggle="modal" data-bs-target="#ModalEditUs<?php echo $rowusu["ID_US"]; ?>">
                                    <img src="'.APP_URL.'"public/img/Administrador/Editar.png" alt="Editar" id="editarImg">
                                </button>
                            </td>

                            <td>
                                <button id="deleteUs" data-bs-toggle="modal" data-bs-target="#ModalDeleteUs<?php echo $rowusu["ID_US"]; ?>">
                                    <img src="'.APP_URL.'"public/img/Administrador/Eliminar.png" alt="Eliminar" id="deleteImg">
                                </button>
                            </td>
                        /tr>
                    ';
                    $contador++;
                }
                $pag_final = $contador - 1;
            }else{ 
                if($total>1){
                    $tabla.=' 
                        <tr class="has-text-centered">
                            <td colspan="7">
                                <a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
                                    Haga clic acá para recargar el listado
                                </a>
                            </td>
                        </tr>
                        ';
                }else{

                    $tabla.='
                    <tr class="has-text-centered" >
                        <td colspan="7">
                            No hay registros en el sistema
                        </td>
                    </tr>
                    ';

                }

            }

            $tabla.='</tbody></table></div>';

            if($total>=1 && $pagina<=$numeroPaginas){

                $tabla.='<p class="has-text-right">Mostrando usuarios <strong>1</strong> al <strong>7</strong> de un <strong>total de 7</strong></p>';
                
            }
        }

        # Controlador para eliminar un usuario #

        public function eliminarUsuarioControlador(){

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

        #Actualizar el usuario#
        public function actualizarUsuarioControlador(){


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

            
            // $check_usuario = $this->ejecutarConsulta("SELECT Nombre_US FROM usuarios WHERE Nombre_US = '$nombre'");
            //     if($check_usuario->rowCount()>0){
            //         $alerta=[
            //             "tipo"=>"simple",
            //             "titulo"=>"Ocurrio un error inesperado",
            //             "texto"=>"El usuario ingresado ya existe",
            //             "icono"=>"error"
            //             ];
        
            //             return json_encode($alerta);
            //             exit();
            //         }
            
                    $usuario_datos_act = [
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


                    if($this->actualizarDatos("usuarios",$usuario_datos_act,$condicion)){

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

        public function solicitarCreditoControlador(){
            
            $montoCredito = $this->limpiarCadena($_POST['montoCredito']);
            $cedula = $this->limpiarCadena($_POST['cedulaUsuarioCr']);
            $nombre = $this->limpiarCadena($_POST['nombreUsuarioCr']);
            $telefono = $this->limpiarCadena($_POST['telefonoUsuarioCr']);
            $direccion = $this->limpiarCadena($_POST['direccionUsuarioCr']);
            $estado = "En espera";
            $fecha_credito = date("Y-m-d H:i:s"); // Obtener la fecha y hora actual en formato MySQL
            $numeroCredito = 1;

            if($montoCredito == ""){

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

            if($this->verificarDatos("[0-9]{1,20}",$montoCredito)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La cedula no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            $check_Creditos = $this->ejecutarConsulta("SELECT * FROM credito WHERE ID_US = $cedula AND Estado_ACT = 1");
                    if($check_Creditos->rowCount()>0){
                        $alerta=[
                            "tipo"=>"simple",
                            "titulo"=>"Ocurrio un error inesperado",
                            "texto"=>"El usuario ya tiene un credito en el sistema",
                            "icono"=>"error"
                        ];
        
                        return json_encode($alerta);
                        exit();
                    }
        
            $sql = $this->ejecutarConsulta("SELECT Correo_US FROM usuarios WHERE ID_US = $cedula");
            $resultSql = $sql->fetch();
            $correo = $resultSql['Correo_US'];


            $usuario_datos_creditos = [
                [
                    "campo_nombre"=>"Nombre_CR",
                    "campo_marcador"=>":nombreCredito",
                    "campo_valor"=>$nombre
                ],
                [
                    "campo_nombre"=>"Correo_CR",
                    "campo_marcador"=>":correoCredito",
                    "campo_valor"=>$correo
                ],
                [
                    "campo_nombre"=>"Telefono_CR",
                    "campo_marcador"=>":telefonoCredito",
                    "campo_valor"=>$telefono
                ],
                [
                    "campo_nombre"=>"Direccion_CR",
                    "campo_marcador"=>":direccionCredito",
                    "campo_valor"=>$direccion
                ],
                [
                    "campo_nombre"=>"Estado_CR",
                    "campo_marcador"=>":estadoCredito",
                    "campo_valor"=>$estado
                ],
                [
                    "campo_nombre"=>"Fecha_CR",
                    "campo_marcador"=>":fechaCredito",
                    "campo_valor"=>$fecha_credito
                ],
                [
                    "campo_nombre"=>"Valor_CR",
                    "campo_marcador"=>":valorCredito",
                    "campo_valor"=>$montoCredito
                ],
                [
                    "campo_nombre"=>"ID_US",
                    "campo_marcador"=>":cedulaUsuario",
                    "campo_valor"=>$cedula
                ]
            ];

            $registrar_credito_usuario = $this->guardarDatos("credito",$usuario_datos_creditos);

            if($registrar_credito_usuario->rowCount()==1){

                $alerta=[
                    "tipo"=>"limpiar",
                    "titulo"=>"Credito Solicitado!",
                    "texto"=>"El credito del usuario ".$nombre." fue solicitado satisfactoriamente.",
                    "icono"=>"success"
                ];

                
            }else{

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"No se pudo socilitar el credito.",
                    "icono"=>"error"
                ];

                
            }
            
            return json_encode($alerta);
        }

        public function actualizarPerfilUsuario(){

            $cedula=$this->limpiarCadena($_POST['ID_US']);
            $nombre=$this->limpiarCadena($_POST['Nombre_US']);
            $correo=$this->limpiarCadena($_POST['Correo_US']);
            $direccion=$this->limpiarCadena($_POST['Direccion_US']);
            $telefono=$this->limpiarCadena($_POST['Telefono_US']);
            $contrasena=$this->limpiarCadena($_POST['Contrasena_US']);
            $contrasena2=$this->limpiarCadena($_POST['Contrasena_US2']);

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

            if($this->verificarDatos("[a-zA-Z0-9]{5,100}",$contrasena) || $this->verificarDatos("[a-zA-Z0-9]{5,100}",$contrasena2)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La contraseña no coincide con el formato solicitado",
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

            #Verificando clave #

            if($contrasena!=$contrasena2){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"Las contraseñas no coinciden.",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();

            }else{

                $contrasenaEncriptada = password_hash($contrasena,PASSWORD_BCRYPT,["cost"=>10]);

            }

            $usuario_datos_actualizacion = [

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
                    "campo_marcador"=>":contrasenaUsuario",
                    "campo_valor"=>$contrasenaEncriptada
                ]
            ];

            $condicion = [
                
                        "condicion_campo"=>"ID_US",
                        "condicion_marcador"=>":ID",
                        "condicion_valor"=>$cedula
                
            ];

            if($this->actualizarDatos("usuarios",$usuario_datos_actualizacion,$condicion)){

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