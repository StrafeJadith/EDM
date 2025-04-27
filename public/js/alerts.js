function success(msj1, msj2) {
  Swal.fire({
    title: msj1,
    text: msj2,
    icon: "success",
  });
}

function error(msj1, msj2) {
  Swal.fire({
    title: msj1,
    text: msj2,
    icon: "error",
  });
}

function answer(msj1, msj2) {
  Swal.fire({
    title: msj1,
    text: msj2,
    icon: "question",
  });
}

function test() {
  console.log("test");
}

function viejoPaul() {
  console.log("Soy lil paulsinho");
}