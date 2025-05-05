<?php

    namespace app\controller; //los namespaces se utilizan para organizar y gestionar identificadores.
    use app\model\viewsModel;

    class viewsController extends viewsModel{

        public function obtenerViewsController($vista){

            if($vista!=""){

                $respuesta = $this->obtenerViewsModel($vista); //Aqui se obtiene el valor de la vista previamente realizado en el model.

            }else{

                $respuesta = "inicio"; //Si la variable del parametro no trae nada el valor por defecto es inicio

            }

            return $respuesta;

        }
    }