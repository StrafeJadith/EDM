<?php

    // echo __DIR__;
    //Obtiene el nombre de las clases que estamos utilizando en el sistema.
    spl_autoload_register(function($clase){//El valor del parametro pasado en la funcion se lo da directamente Php, esto lo hace automaticamente cuando detecta que se quiere cargar una clase automaticamente.

        $archivo = __DIR__."/".$clase.".php"; //Mediante __DIR__ se obtiene la url de el archivo en el que estamos, y se le concatenan una serie de string y variables.
        $archivo = str_replace("\\","/",$archivo); 

        if(is_file($archivo)){ //Verifica si el directorio existe, si exsite requiere la url o direccion que esta en $archivo.

            require_once $archivo;
        }

    }); 
?>