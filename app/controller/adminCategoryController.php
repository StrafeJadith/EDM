<?php

    namespace app\controller;
    use app\model\mainModel;

    class adminCategoryController extends mainModel{

        public function agregarCategoriaControlador(){

            $idCategoria = $_POST['idcat'];
            $nombreCategoria = $_POST['categoriaN'];

            if($idCategoria == "" || $nombreCategoria == ""){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"No has llenado todos los campos que son obligatorios",
                    "icono"=>"error"
                ];

                
                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("[0-9]{1,15}",$idCategoria)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La identificacion no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("^[A-Za-z]+([A-Za-z]+)*$",$nombreCategoria)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"El nombre de la categoria no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            $check_categoria = $this->ejecutarConsulta("SELECT * FROM categoria_producto WHERE ID_CAT = $idCategoria OR Nombre_CAT = '$nombreCategoria'");
                if($check_categoria->rowCount()>0){
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"No se puede agregar una categoria con la misma identificacion o el mismo nombre",
                        "icono"=>"error"
                    ];

                    return json_encode($alerta);
                    exit();
                }

            $categoria_datos_registro = [

                [
                    "campo_nombre"=>"ID_CAT",
                    "campo_marcador"=>":Identificacion",
                    "campo_valor"=>$idCategoria
                ],
                [
                    "campo_nombre"=>"Nombre_CAT",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=>$nombreCategoria
                ]

            ];

            $registrar_categoria = $this->guardarDatos("categoria_producto",$categoria_datos_registro);

            if($registrar_categoria->rowCount()==1){

                $alerta=[
                    "tipo"=>"limpiar",
                    "titulo"=>"Categoria Registrado!",
                    "texto"=>"La categoria ".$nombreCategoria." fue registrado satisfactoriamente.",
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

        # Controlador para eliminar una categoria #

        public function eliminarCategoriaControlador(){

            $idCategoria = $this->limpiarCadena($_POST['idcat']);

            #Verificacion del usuario#

            $datos=$this->ejecutarConsulta("SELECT * FROM categoria_producto WHERE ID_CAT = $idCategoria");

            if($datos->rowCount()<=0){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"La categoria no existe",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();

            }else{

                $datos=$datos->fetch();

            }

            $eliminarCategoria = $this->eliminarRegistro("categoria_producto","ID_CAT",$idCategoria);

            if($eliminarCategoria->rowCount()==1){

                $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"Categoria Eliminado!",
                    "texto"=>"La categoria ".$datos['Nombre_CAT']." fue eliminada satisfactoriamente.",
                    "icono"=>"success"
                ];

            }else{

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La categoria ".$datos['Nombre_CAT']." no se pudo eliminar del sistema.",
                    "icono"=>"error"
                ];

            }

            return json_encode($alerta);
        
        }

        public function actualizarCategoriaControlador(){


            # Almacenando datos #
            $idCategoria=$this->limpiarCadena($_POST['idcat']);
            $nombreCategoria=$this->limpiarCadena($_POST['nombrecat']);

            $datos=$this->ejecutarConsulta("SELECT * FROM categoria_producto WHERE ID_CAT = $idCategoria");

            $datos = $datos->fetch();

            # Verificar datos obligatorios #

            if($nombreCategoria == ""){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error",
                    "texto"=>"No has llenado todos los campos que son obligatorios",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            if($this->verificarDatos("^[A-Za-z]+( [A-Za-z]+)*$",$nombreCategoria)){

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"La categoria no coincide con el formato solicitado",
                    "icono"=>"error"
                ];

                return json_encode($alerta);
                exit();
            }

            

            $categoria_datos_actualizar= [

                [
                    "campo_nombre"=>"ID_CAT",
                    "campo_marcador"=>":Identificacion",
                    "campo_valor"=>$idCategoria
                ],
                [
                    "campo_nombre"=>"Nombre_CAT",
                    "campo_marcador"=>":Nombre",
                    "campo_valor"=>$nombreCategoria
                ]

            ];

            $condicion = [
                
                "condicion_campo"=>"ID_CAT",
                "condicion_marcador"=>":Identificacion",
                "condicion_valor"=>$idCategoria
        
            ];


            $check_categoria = $this->ejecutarConsulta("SELECT Nombre_CAT FROM categoria_producto WHERE Nombre_CAT = '$nombreCategoria'");
                if($check_categoria->rowCount()>0){
                    $alerta=[
                        "tipo"=>"simple",
                        "titulo"=>"Ocurrio un error inesperado",
                        "texto"=>"No se puede agregar una categoria con la misma identificacion o el mismo nombre",
                        "icono"=>"error"
                    ];

                    return json_encode($alerta);
                    exit();
                }

            

            if($this->actualizarDatos("categoria_producto",$categoria_datos_actualizar,$condicion)){

                $alerta=[
                    "tipo"=>"recargar",
                    "titulo"=>"Categoria Actualizada!",
                    "texto"=>"La categoria ".$datos['Nombre_CAT']." fue actualizado satisfactoriamente.",
                    "icono"=>"success"
                ];

                
            }else{

                $alerta=[
                    "tipo"=>"simple",
                    "titulo"=>"Ocurrio un error inesperado",
                    "texto"=>"No se pudo actualizar la categoria.",
                    "icono"=>"error"
                ];

                
            }

            return json_encode($alerta);

        }
            

    }