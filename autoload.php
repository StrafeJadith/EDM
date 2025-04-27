<?php

    // echo __DIR__;
    //Obtiene el nombre de las clases que estamos utilizando en el sistema.
    spl_autoload_register(function($clase){

        $archivo = __DIR__."/".$clase.".php"; //Mediante __DIR__ se obtiene la url de el archivo en el que estamos, y se le concatenan una serie de string y variables.
        $archivo = str_replace("\\","/",$archivo); 

        if(is_file($archivo)){ //Verifica si el directorio existe, si exsite requiere la url o direccion que esta en $archivo.

            require_once $archivo;
        }

    }); 
?>