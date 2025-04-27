<?php

    namespace app\controller;
    use app\model\viewsModel;

    class viewsController extends viewsModel{

        public function obtenerViewsController($vista){

            if($vista!=""){

                $respuesta = $this->obtenerViewsModel($vista);

            }else{

                $respuesta = "inicio";

            }

            return $respuesta;

        }
    }