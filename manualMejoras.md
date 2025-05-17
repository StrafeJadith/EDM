# Manual de mejoras

#### Se explicara de forma simplificada como se aplican las multiples tecnologias

- Ajax
- Enrutador
- PDO

## Ajax

Ajax funciona dentro de los formularios, en lugar de cambiarlos por completo,
añade algunas propiedades, como lo son la clase y un manejo por modulos

La sintax de un formulario ajax se escribe de la siguiente manera:

```html
<form class="FormularioAjax" action="" method="post">
  <input type="hidden" name="modulo_usuario" value="registrar" />
</form>
```

se añade la clase "FormularioAjax" para especificarle que la informacion que
esta dentro del formulario se enviara a la clase formulario, esa clase esta
dentro del archivo "ajax.js" en la carpeta js, en esa carpeta se maneja una
estructura de manejo de datos recibidos de formularios y alertas para
personalizar.

### Envio de datos de los formularios

Una vez recibido, ajax puede mandar los datos que tiene a otros archivos, los
archivos para enrutar a que archivo deben de ir los datos, es en la carpeta ajax
que esta en app

![Imagen-de-carpeta](public/img/pages.png)

La estructura que manejan los archivos son por modulos, cuando es un modulo
usuario, se crea un **input hidden** para especificar que el input no se vera, y
solo servira para mandar datos ya definidos anteriormente, su sintax es:

```html
<input type="hidden" name="modulo_usuario" value="registrar" />
```

En donde en _**name**_ se usa para especificar el modulo, y el _**value**_ para
especificar que hara

```php
if(isset($_POST["modulo_usuario"])){

    $insUsuario = new userController();

    if($_POST['modulo_usuario'] == "registrar"){

        echo $insUsuario->registrarUsuarioControlador();
    }

```
