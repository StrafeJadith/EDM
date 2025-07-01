

const formularios_ajax = document.querySelectorAll(".FormularioAjax");

formularios_ajax.forEach(formularios => {

    
    formularios.addEventListener("submit",function(e){
        e.preventDefault();

        Swal.fire({
            title: 'Estas seguro?',
            text: "Quieres realizar la accion solicitada",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, realizar.',
            cancelButtonText: 'No, cancelar.'
            }).then((result) => {
                if (result.isConfirmed) {
                    

                    let data = new FormData(this);

                    let method = this.getAttribute("method");
                    let action = this.getAttribute("action");

                    let encabezados = new Headers();

                    let config={
                        method: method,
                        headers: encabezados,
                        mode: 'cors',
                        cache: 'no-cache',
                        body: data
                    };

                    fetch(action,config)
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {

                        console.log(respuesta.creditos);

                        // if (respuesta.error) {
                        //     Swal.fire({
                        //         icon: 'error',
                        //         title: 'Error',
                        //         text: respuesta.error
                        //     });
                        //     $('#usuario_nombre').val(''); // Limpia los campos en caso de error
                        //     $('#otroInput').val('');  // Limpia otros campos
                        //     // ... limpia otros campos ...
                        if(respuesta.usuarios){
                            // Asigna los valores del JSON a los inputs por sus IDs
                            console.log(respuesta.creditos);
                            document.getElementById('ID_US').value = respuesta.usuarios.ID_US;
                            document.getElementById('Nombre_US').value = respuesta.usuarios.Nombre_US;
                            document.getElementById('Correo_US').value = respuesta.usuarios.Correo_US;
                            document.getElementById('Telefono_US').value = respuesta.usuarios.Telefono_US;
                            document.getElementById('Direccion_US').value = respuesta.usuarios.Direccion_US;
                            document.getElementById('Valor_Total').value = respuesta.credito.Valor_Total;
                            document.getElementById('Valor_CR').value = respuesta.credito.Valor_CR;
                            document.getElementById('MontoSuma').value = respuesta.abono.MontoSuma;
                        }
                        else if(respuesta.creditos){

                            console.log(respuesta.creditos);

                            const tabla = document.getElementById("tablaCreditos").querySelector("tbody");

                            // Limpia la tabla si ya tenía datos
                            tabla.innerHTML = "";

                            respuesta.creditos.forEach(credito => {

                                // Crea una fila con los datos
                                const fila = `
                                    <tr>
                                        <td>${credito.ID_CR}</td>
                                        <td>${credito.ID_US}</td>
                                        <td>${credito.Nombre_CR}</td>
                                        <td>${credito.Correo_CR}</td>
                                        <td>${credito.Telefono_CR}</td>
                                        <td>${credito.Estado_CR}</td>
                                        <td>${credito.Fecha_CR}</td>
                                        <td>${credito.Valor_CR}</td>
                                    </tr>
                                `;

                                // Inserta la fila
                                tabla.innerHTML += fila;
                            });
                            
                        }
                        else{

                            return alertas_ajax(respuesta);
                            
                        }

                        
                    });
                }
        });

    });
});




function alertas_ajax(alerta){

    if(alerta.tipo=="simple"){

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        });
        
    }else if(alerta.tipo=="recargar"){

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                location.reload();
            }
        });

    }else if(alerta.tipo=="limpiar"){

        Swal.fire({
            icon: alerta.icono,
            title: alerta.titulo,
            text: alerta.texto,
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if(result.isConfirmed){
                document.querySelector(".FormularioAjax").reset();
            }
        });

    }else if(alerta.tipo=="redireccionar"){

        window.location.href=alerta.url;
    }
}


/*Boton cerrar sesion */

let botonSalir = document.getElementById("botonExit");

botonSalir.addEventListener("click", function(e){

    e.preventDefault();

    Swal.fire({
        title: '¿Quieres cerrar la sesion?',
        text: "La sesion actual se cerrara y saldras del sistema",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, salir.',
        cancelButtonText: 'No, cancelar.'
        }).then((result) => {
            if (result.isConfirmed) {

                let url = this.getAttribute("href");
                window.location.href=url;
            }
    });


});
