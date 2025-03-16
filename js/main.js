'use strict'; 

// Alterna la visibilidad del menú lateral y la superposición.
function toggleMenu() {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("superponer");
  sidebar.classList.toggle("show"); 
  overlay.classList.toggle("active");
}

// Desplazamiento suave hasta la parte superior de la página.
function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const overlay = document.querySelector(".superponer");
  const body = document.body;

  const observer = new MutationObserver(() => {
    // Controla el desbordamiento de la página según el estado de la superposición.
    if (overlay.classList.contains("active")) {
      body.style.overflowY = "hidden"; // Desactiva el scroll cuando está activa.
    } else {
      body.style.overflowY = "auto"; // Restaura el scroll cuando se cierra.
    }
  });

  observer.observe(overlay, { attributes: true, attributeFilter: ["class"] });
});

/* Animaciones */
AOS.init({
  once: true, 
});

/* Redirección al formulario de cursos */
const dropdown = document.querySelector("#curso");
const cursos = document.querySelectorAll(".button-54");

cursos.forEach(curso => {
  curso.addEventListener('click', () => {
    let indice = Array.from(cursos).indexOf(curso);
    dropdown.value = indice;
  });
});
