const openBtn = document.getElementById("openCart");
const closeBtn = document.getElementById("closeCart");
const sidebar = document.getElementById("cartSidebar");


openBtn.addEventListener("click", () => {
  sidebar.classList.add("open");
  openBtn.style.display = "none";

});


closeBtn.addEventListener("click", () => {
  sidebar.classList.remove("open");
  openBtn.style.removeProperty("display");
});

