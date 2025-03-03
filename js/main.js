function toggleMenu() {
  const sidebar = document.getElementById("sidebar");
  const overlay = document.getElementById("superponer");
  sidebar.classList.toggle("show");
  overlay.classList.toggle("active");
}
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
    if (overlay.classList.contains("active")) {
      body.style.overflowY = "hidden";
    } else {
      body.style.overflowY = "auto"; // Restaura el scroll cuando se cierra
    }
  });

  observer.observe(overlay, { attributes: true, attributeFilter: ["class"] });
});

AOS.init({
  once: true,
});
