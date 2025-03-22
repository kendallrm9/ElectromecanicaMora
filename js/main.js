'use strict'; 

/* Animaciones */
AOS.init({
  once: true,
});

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

// Mostrar el input capacitación en la página Contáctenos
const selectServicio = document.querySelector('#servicio');
const selectCapacitacion = document.querySelector('#curso');

selectServicio.addEventListener('change', () => {
  
  (selectServicio.value == "Capacitaciones") ?
    selectCapacitacion.style.display = 'inline-block' :
    selectCapacitacion.style.display = 'none';

});




