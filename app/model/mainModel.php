<?php

    namespace app\model;
    use \PDO; //PDO es una funcion predefinida de Php.

    if(file_exists(__DIR__."/../../config/server.php")){ //Se verifica si la url pasada como parametro en realidad es un archivo.

        require_once __DIR__."/../../config/server.php";//Si es un archivo la requiere en este archivo.

    }

    class mainModel{

        private $server=DB_SERVER;
        private $db=DB_NAME;
        private $user=DB_USER;
        private $pass=DB_PASS;

        protected function conectar(){

            $conexion = new PDO("mysql:host=".$this->server.";dbname=".$this->db , $this->user, $this->pass); //Se realiza la conexion a la base de datos.
            $conexion->exec("SET CHARACTER SET utf8");//Permite que a la base de datos puedan ingresar caracteres con el utf8
            return $conexion;
        }

        public function ejecutarConsulta($consulta){ //Esta es una funcion preparada para realizar consultas.

            $sql = $this->conectar()->prepare($consulta); //Aqui se accede al metodo conectar previamente creado y se utiliza la funcion o metodo prepare de PDO, para preparar una consulta (la consulta a preparar es el valor como parametro).
            $sql->execute(); //Se ejecuta la consulta.
            return $sql;

        }

        public function limpiarCadena($cadena){ //Esta funcion nos ayudara a prevenir inyecciones SQL.

            //Se crea un array con palabras que posiblemente puedan ser usadas para hacer inyeccion SQL a nuestra base de datos y obtener datos importantes.
            $palabras = ["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::"];


            $cadena = trim($cadena);//trim es una funcion utilizada para eliminar caracteres especiales de una cadena.
            $cadena = stripslashes($cadena);//stripslashes es una funcion que elimina las barras

            foreach($palabras as $palabra){//foreach se utiliza para recorrer un array

                $cadena = str_ireplace($palabra, "", $cadena);//str_ireplace es utilizado para reemplazar, siendo el primer parametro el valor buscado a reemplazar, el segundo valor el reemplazo, y el tercer valor el sujeto al cual van a reemplazar.

            }

            $cadena = trim($cadena);
            $cadena = stripslashes($cadena);

            return $cadena;

        }

        protected function verificarDatos($filtro,$cadena){//Esta funcion es para verificar los patterns o expresiones regulares que se obtienen del formulario.

            if(preg_match("/^".$filtro."$/", $cadena)){ //preg_match - Realiza una comparación con una expresión regular.

                return false;

            }else{

                return true;

            }
        }

        protected function guardarDatos($tabla,$datos){//Funcion para insertar datos en la base de datos.

            /*Todo este proceso se resume a reemplazar la variable $query para ir llenandola poco a poco mediante reemplazos con bucles.*/
            $query = "INSERT INTO $tabla (";

            $C = 0;

            foreach($datos as $clave){
                if($C>=1){$query.=",";}
                $query.=$clave["campo_nombre"];//Campo nombre es un valor que se le manda mediante el parametro $datos de la funcion guardarDatos.
                $C++;
            }

            $query.=") VALUES (";

            $C = 0;

            foreach($datos as $clave){
                if($C>=1){$query.=",";}
                $query.=$clave["campo_marcador"];
                $C++;
            }

            $query.=")"; 
            
            $sql = $this->conectar()->prepare($query); //Se prepara la consulta

            foreach($datos as $clave){

                $sql->bindParam($clave["campo_marcador"],$clave["campo_valor"]);//bindParam Vincula un parámetro al nombre de variable especificado, en este caso tiene por ejemplo el marcador :nombre y el campo_valor tiene el valor real que se quiere insertar por ejemplo "Jadith"
            }

            $sql->execute();

            return $sql;    
        }


        public function seleccionarDatos($tipo,$tabla,$campo,$id){ //Esta funcion es utilizada para seleccionar datos de la base de datos.

            $tipo = $this->limpiarCadena($tipo);//Aqui se utiliza el metodo limpiarCadena para prevenir que se tengan cadenas raras y puedan afectar nuestra seguridad.
            $tabla = $this->limpiarCadena($tabla);
            $campo = $this->limpiarCadena($campo);
            $id = $this->limpiarCadena($id);

            if($tipo == "Unico"){

                //Toda esta funcion consulta todos los valores de una tabla.
                $sql = $this->conectar()->prepare("SELECT * FROM $tabla WHERE $campo=:ID");
                $sql->bindParam(":ID",$id);

            }
            elseif($tipo == "Normal"){

                //Toda esta funcion consulta solo un valor de una tabla.
                $sql = $this->conectar()->prepare("SELECT $campo FROM $tabla");
            }

            $sql->execute();

            return $sql;
        }


        protected function actualizarDatos($tabla,$datos,$condicion){ //Esta funcion es utilizada para actualizar los datos de una base de datos.

            //Aqui es casi lo mismo que en el metodo de guardar datos, reemplazar una variable ($query) para ir formando la consulta.
            $query = "UPDATE $tabla SET ";

            $C = 0;

            foreach($datos as $clave){
                if($C>=1){$query.=",";}
                $query.=$clave["campo_nombre"]."=".$clave["campo_marcador"];
                $C++;
            }

            $query.=" WHERE ".$condicion["condicion_campo"]."=".$condicion["condicion_marcador"];

            $sql = $this->conectar()->prepare($query);
            
            foreach($datos as $clave){

                $sql->bindParam($clave["campo_marcador"],$clave["campo_valor"]);
            }

            $sql->bindParam($condicion["condicion_marcador"],$condicion["condicion_valor"]);

            $sql->execute();

            return $sql; 
        }

        protected function eliminarRegistro($tabla,$campo,$id){ //Esta funcion es utilizada para eliminar un registor de la base de datos.

            $sql = $this->conectar()->prepare("DELETE FROM $tabla WHERE $campo=:id");

            $sql->bindParam(":id",$id);

            $sql->execute();

            return $sql; 

        }

        protected function paginadorTablas($pagina,$numeroPaginas,$url,$botones){

            $tabla = '<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

            if($pagina <= 1){

                $tabla.='

                <a class="pagination-previous is-disabled" disabled >Anterior</a>
                    <ul class="pagination-list">

                ';
            }else{

                $tabla.='

                <a class="pagination-previous" href="'.$url.($pagina - 1).'/">Anterior</a>
                    <ul class="pagination-list">
                        <li><a class="pagination-link" href="'.$url.'1/">1</a></li>
                        <li><span class="pagination-ellipsis">&hellip;</span></li>

                ';
            }

            $ci=0;
            for($i=$pagina; $i<=$numeroPaginas; $i++){

                if($ci>=$botones){

                    break;

                }

                if($pagina==$i){

                    $tabla.='<li><a class="pagination-link is-current" href="'.$url.$i.'/">'.$i.'</a></li>';
                }else{

                    $tabla.='<li><a class="pagination-link" href="'.$url.$i.'/">'.$i.'</a></li>';
                }

                $ci++;
            }

            if($pagina==$numeroPaginas){

                $tabla.='
                    </ul>
                        <a class="pagination-next is-disabled" disabled >Siguiente</a>
                ';

            }else{

                $tabla.='

                        <li><span class="pagination-ellipsis">&hellip;</span></li>
                        <li><a class="pagination-link" href="'.$url.$numeroPaginas.'/">'.$numeroPaginas.'</a></li>
                    </ul>
                        <a class="pagination-next" href="'.$url.($pagina + 1).'/">Siguiente</a>
                ';

            }

            $tabla.='</nav>';

            return $tabla;

        }

        public function contarRegistros($tabla){ //Esta funcion es usada para contar los registros de una base de datos.

            $sql = $this->conectar()->prepare("SELECT COUNT(*) as numus FROM $tabla");
            $sql->execute();
            $row = $sql->fetchAll(PDO::FETCH_ASSOC); //fetchAll nos trae todas las filas de una tabla. y PDO::FETCH_ASSOC te devuelve un array asociativo.
            foreach($row as $rows){

                $VariableIterador = $rows['numus'];
            }
            
            
            return $VariableIterador;

        }
    }