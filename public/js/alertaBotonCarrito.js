/* Alerta para cuando quiere agregar un producto al carrito desde el inicio */


let botonAgregarCarrito = document.querySelectorAll(".botonCarritoAlert");

    botonAgregarCarrito.forEach(function(boton){

        boton.addEventListener("click", function(e){

            e.preventDefault();


            Swal.fire({
                title: '¡No ha iniciado sesion!',
                text: "Para agregar un producto al carrito debe iniciar sesion.",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, iniciar sesion.',
                cancelButtonText: 'No, cancelar.'
                }).then((result) => {
                    if (result.isConfirmed) {

                        let url = this.getAttribute("href");
                        window.location.href=url;
                    }
            });

            // Swal.fire({
            //     icon: "error",
            //     title: "Ocurrio un error",
            //     text: "Para agregar un producto al carrito debe iniciar sesion."
            // });
    })
});