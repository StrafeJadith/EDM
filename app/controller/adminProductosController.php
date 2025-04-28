<?php

    namespace app\controller;
    use app\model\mainModel;
    use PDO;

    class adminProductosController extends mainModel{

        public function agregarProductosControlador(){

        $idPro = $_POST["ID_PRO"];
        $nombrePro = $_POST["Nombre_PRO"];
        $descripcionPro = $_POST["Descripcion_PRO"];
        $valorUnitarioPro = $_POST["Valor_Unitario"];
        $cantidadTotalPro = $_POST["Cantidad_Total"];
        $cantidadExistentePro = $_POST["Cantidad_Existente"];
        $fechaEntradaPro = $_POST["Fecha_Entrada"];
        $fechaExpedicionPro = $_POST["Fecha_Expedicion"];
        $categoriaPro = $_POST['Categoria_PRO'];

        if($idPro == "" || $nombrePro == "" || $descripcionPro == "" || $valorUnitarioPro == "" || $cantidadTotalPro == "" || $cantidadExistentePro == "" || $fechaEntradaPro == "" || $fechaExpedicionPro == ""){

            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrio un error",
                "texto"=>"No has llenado todos los campos que son obligatorios",
                "icono"=>"error"
            ];

            
            return json_encode($alerta);
            exit();
        }

        if($this->verificarDatos("[0-9]{1,15}",$idPro)){

            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrio un error inesperado",
                "texto"=>"La identificacion del producto no coincide con el formato solicitado",
                "icono"=>"error"
            ];

            return json_encode($alerta);
            exit();
        }

        if($this->verificarDatos("^[A-Za-z]+( [A-Za-z]+)*$",$nombrePro)){

            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrio un error inesperado",
                "texto"=>"El nombre del producto no coincide con el formato solicitado",
                "icono"=>"error"
            ];

            return json_encode($alerta);
            exit();
        }

        if($this->verificarDatos("^[A-Za-z]+( [A-Za-z]+)*$",$descripcionPro)){

            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrio un error inesperado",
                "texto"=>"La descripcion del producto no coincide con el formato solicitado",
                "icono"=>"error"
            ];

            return json_encode($alerta);
            exit();
        }

        if($this->verificarDatos("[0-9]{1,15}",$valorUnitarioPro)){

            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrio un error inesperado",
                "texto"=>"El valor unitario del producto no coincide con el formato solicitado",
                "icono"=>"error"
            ];

            return json_encode($alerta);
            exit();
        }

        if($this->verificarDatos("[0-9]{1,15}",$cantidadTotalPro)){

            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrio un error inesperado",
                "texto"=>"La cantidad total del producto no coincide con el formato solicitado",
                "icono"=>"error"
            ];

            return json_encode($alerta);
            exit();
        }

        if($this->verificarDatos("[0-9]{1,15}",$cantidadExistentePro)){

            $alerta=[
                "tipo"=>"simple",
                "titulo"=>"Ocurrio un error inesperado",
                "texto"=>"La cantidad existente del producto no coincide con el formato solicitado",
                "icono"=>"error"
            ];

            return json_encode($alerta);
            exit();
        }

        $check_productos = $this->ejecutarConsulta("SELECT * FROM productos WHERE ID_PRO = $idPro");
            if($check_productos->rowCount()>0){
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"No se puede agregar un producto con la misma identificacion o el mismo nombre",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            $traerNombreCat = $this->ejecutarConsulta("SELECT Nombre_CAT FROM categoria_producto WHERE ID_CAT = $categoriaPro");
            $nombreCa = $traerNombreCat->fetch();
            $Nombre_CAT = $nombreCa['Nombre_CAT'];
        


            $imagen = $_FILES["imagen"]["tmp_name"];
            $nombreImagen = $_FILES["imagen"]["name"];
            $tipoImagen = strtolower(pathinfo($nombreImagen,PATHINFO_EXTENSION));
            $sizeImagen = $_FILES["imagen"]["size"];
            $directorio = realpath(__DIR__ . '/../../public/img/Administrador/Productos/') . '/';
            $urlPublica = 'public/img/Administrador/Productos/';
            

            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true); // Si no existe, lo creamos
            }

            //nombre de la imagen
            $nombreFinal = $idPro . "." . $tipoImagen;

            //Ruta final para mover
            $rutaFisica = $directorio . $nombreFinal;

            //Ruta final para guardar en base de datos
            $rutaBD = $urlPublica . $nombreFinal;

            if (move_uploaded_file($imagen, $rutaFisica)) {
                
                $imagenRuta = $rutaBD; // Ruta completa de la imagen para almacenar en la base de datos

            } else {
                
                $imagenRuta = '';
            }

        

            $productos_datos_registro = [

                [
                    "campo_nombre"=>"ID_PRO",
                    "campo_marcador"=>":Identificacion",
                    "campo_valor"=>$idPro
                ],
                [
                    "campo_nombre"=>"Nombre_PRO",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=>$nombrePro
                ],
                [
                    "campo_nombre"=>"Descripcion_PRO",
                    "campo_marcador"=>":Descripcion",
                    "campo_valor"=>$descripcionPro
                ],
                [
                    "campo_nombre"=>"Categoria_PRO",
                    "campo_marcador"=>":Categoria",
                    "campo_valor"=>$Nombre_CAT
                ],
                [
                    "campo_nombre"=>"Valor_Unitario",
                    "campo_marcador"=>":valorUnitario",
                    "campo_valor"=>$valorUnitarioPro
                ],
                [
                    "campo_nombre"=>"Cantidad_Total",
                    "campo_marcador"=>":cantidadTotal",
                    "campo_valor"=>$cantidadTotalPro
                ],
                [
                    "campo_nombre"=>"Cantidad_Existente",
                    "campo_marcador"=>":cantidadExistente",
                    "campo_valor"=>$cantidadExistentePro
                ],
                [
                    "campo_nombre"=>"Fecha_Entrada",
                    "campo_marcador"=>":fechaEntrada",
                    "campo_valor"=>$fechaEntradaPro
                ],
                [
                    "campo_nombre"=>"Fecha_Expedicion",
                    "campo_marcador"=>":fechaExpedicion",
                    "campo_valor"=>$fechaExpedicionPro
                ],
                [
                    "campo_nombre"=>"ID_US",
                    "campo_marcador"=>":identificacionUs",
                    "campo_valor"=>11223344
                ],
                [
                    "campo_nombre"=>"ID_CAT",
                    "campo_marcador"=>":identificacionCat",
                    "campo_valor"=>$categoriaPro
                ],
                [
                    "campo_nombre"=>"Img",
                    "campo_marcador"=>":Imagen",
                    "campo_valor"=>$imagenRuta
                ]

            ];

            $registrar_productos = $this->guardarDatos("productos",$productos_datos_registro);

            if($registrar_productos->rowCount()==1){

                $alerta=[
                    "tipo"=>"limpiar",
                    "titulo"=>"Producto Registrado!",
                    "texto"=>"El producto ".$nombrePro." fue registrado satisfactoriamente.",
                    "icono"=>"success"
                ];

                
            }else{

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"No se pudo registrar el producto.",
                    "icono"=>"error"
                ];

                
            }
            
            return json_encode($alerta);

        }

        # Controlador para eliminar un producto #

        public function eliminarProductoControlador(){

            $idPro = $this->limpiarCadena($_POST['ID_PRO']);

            #Verificacion del usuario#

            $datos=$this->ejecutarConsulta("SELECT * FROM productos WHERE ID_PRO = $idPro");

            if($datos->rowCount()<=0){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"El producto no existe",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();

            }else{

                $datos=$datos->fetch();

            }

            $eliminarProducto = $this->eliminarRegistro("productos","ID_PRO",$idPro);

            if($eliminarProducto->rowCount()==1){

                $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"Producto Eliminado!",
                    "texto"=>"El producto ".$datos['Nombre_PRO']." fue eliminado satisfactoriamente.",
                    "icono"=>"success"
                ];

            }else{

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"El producto ".$datos['Nombre_PRO']." no se pudo eliminar del sistema.",
                    "icono"=>"error"
                ];

            }

            return json_encode($alerta);
        
        }

        public function actualizarProductosControlador(){

            # Almacenando datos #
            $idPro=$this->limpiarCadena($_POST['ID_PRO']);
            $nombrePro = $_POST["Nombre_PRO"];
            $descripcionPro = $_POST["Descripcion_PRO"];
            $valorUnitarioPro = $_POST["Valor_Unitario"];
            $cantidadTotalPro = $_POST["Cantidad_Total"];
            $cantidadExistentePro = $_POST["Cantidad_Existente"];
            $fechaEntradaPro = $_POST["Fecha_Entrada"];
            $fechaExpedicionPro = $_POST["Fecha_Expedicion"];
            $categoriaPro = $_POST['Categoria_PRO'];
            

            $datos=$this->ejecutarConsulta("SELECT * FROM productos WHERE ID_PRO = $idPro");

            $datos = $datos->fetch();

            if($idPro == "" || $nombrePro == "" || $descripcionPro == "" || $valorUnitarioPro == "" || $cantidadTotalPro == "" || $cantidadExistentePro == "" || $fechaEntradaPro == "" || $fechaExpedicionPro == ""){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"No has llenado todos los campos que son obligatorios",
                    "icono"=>"error"
                ];
    
                
                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("[0-9]{1,15}",$idPro)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La identificacion del producto no coincide con el formato solicitado",
                    "icono"=>"error"
                ];
    
                return json_encode($alerta);
                exit();
            }
    
            if($this->verificarDatos("^[A-Za-z]+( [A-Za-z]+)*$",$nombrePro)){
    
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"El nombre del producto no coincide con el formato solicitado",
                    "icono"=>"error"
                ];
    
                return json_encode($alerta);
                exit();
            }
    
            if($this->verificarDatos("^[A-Za-z]+( [A-Za-z]+)*$",$descripcionPro)){
    
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La descripcion del producto no coincide con el formato solicitado",
                    "icono"=>"error"
                ];
    
                return json_encode($alerta);
                exit();
            }
    
            if($this->verificarDatos("[0-9]{1,15}",$valorUnitarioPro)){
    
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"El valor unitario del producto no coincide con el formato solicitado",
                    "icono"=>"error"
                ];
    
                return json_encode($alerta);
                exit();
            }
    
            if($this->verificarDatos("[0-9]{1,15}",$cantidadTotalPro)){
    
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La cantidad total del producto no coincide con el formato solicitado",
                    "icono"=>"error"
                ];
    
                return json_encode($alerta);
                exit();
            }
    
            if($this->verificarDatos("[0-9]{1,15}",$cantidadExistentePro)){
    
                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La cantidad existente del producto no coincide con el formato solicitado",
                    "icono"=>"error"
                ];
    
                return json_encode($alerta);
                exit();
            }

            $traerNombreCategoria = $this->ejecutarConsulta("SELECT Nombre_CAT FROM categoria_producto WHERE ID_CAT = $categoriaPro");
            $nombreCat = $traerNombreCategoria->fetch();
            

            if($nombreCat){

                $Nombre_CATEGORIA = $nombreCat['Nombre_CAT'];

            }
            else{

                $alerta=[

                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"No has llenado todos los campos requeridos",
                        "icono"=>"error"
                ];
                return json_encode($alerta);
                exit();

            }

            $productos_datos_actualizar= [

                
                [
                    "campo_nombre"=>"Nombre_PRO",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=>$nombrePro
                ],
                [
                    "campo_nombre"=>"Descripcion_PRO",
                    "campo_marcador"=>":Descripcion",
                    "campo_valor"=>$descripcionPro
                ],
                [
                    "campo_nombre"=>"Categoria_PRO",
                    "campo_marcador"=>":Categoria",
                    "campo_valor"=>$Nombre_CATEGORIA
                ],
                [
                    "campo_nombre"=>"Valor_Unitario",
                    "campo_marcador"=>":valorUnitario",
                    "campo_valor"=>$valorUnitarioPro
                ],
                [
                    "campo_nombre"=>"Cantidad_Total",
                    "campo_marcador"=>":cantidadTotal",
                    "campo_valor"=>$cantidadTotalPro
                ],
                [
                    "campo_nombre"=>"Cantidad_Existente",
                    "campo_marcador"=>":cantidadExistente",
                    "campo_valor"=>$cantidadExistentePro
                ],
                [
                    "campo_nombre"=>"Fecha_Entrada",
                    "campo_marcador"=>":fechaEntrada",
                    "campo_valor"=>$fechaEntradaPro
                ],
                [
                    "campo_nombre"=>"Fecha_Expedicion",
                    "campo_marcador"=>":fechaExpedicion",
                    "campo_valor"=>$fechaExpedicionPro
                ]

            ];

            $condicion = [
                
                "condicion_campo"=>"ID_PRO",
                "condicion_marcador"=>":Identificacion",
                "condicion_valor"=>$idPro
        
            ];

            if($this->actualizarDatos("productos",$productos_datos_actualizar,$condicion)){

                $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"Producto Actualizado!",
                    "texto"=>"El producto ".$datos['Nombre_PRO']." fue actualizado satisfactoriamente.",
                    "icono"=>"success"
                ];

                
            }else{

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"No se pudo actualizar el producto.",
                    "icono"=>"error"
                ];

                
            }

            return json_encode($alerta);

        }
    }