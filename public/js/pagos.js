/* menu animaciones flechas */
let listElements = document.querySelectorAll(".lista_button--click");

listElements.forEach((listElement) => {
  listElement.addEventListener("click", () => {
    listElement.classList.toggle("flecha");

    let height = 0;
    let menu = listElement.nextElementSibling;
    if (menu.clientHeight == "0") {
      height = menu.scrollHeight;
    }
    menu.style.height = height + "px";
  });
});
