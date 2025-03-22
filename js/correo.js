'use strict'; 

let formulario = document.querySelector('#formulario-capacitaciones');
// formulario = document.querySelector('#fomulario2');
const telefonoInput = document.getElementById('telefono');
const spinner = document.querySelector('#spinner');

// Validar número de teléfono
const validarTelefono = () => {
  let telefono = telefonoInput.value.trim();
  if (telefono.length !== 8 || isNaN(telefono)) {
      telefonoInput.classList.add('is-invalid'); // Muestra error
      return false; 
  } else {
      telefonoInput.classList.remove('is-invalid'); // Oculta error
      return true; 
  }
}

// Validar en número blur
telefonoInput.addEventListener('blur', validarTelefono);

formulario.addEventListener('submit', (e) => {
    e.preventDefault(); 
    if (validarTelefono()) { // Solo envía si el teléfono es válido
        spinner.style.display = 'inline-block';
        email();
    }
});

const Toast = Swal.mixin({
     toast: true,
     position: "center",
     showConfirmButton: false,
     timer: 3000,
     timerProgressBar: true,
     didOpen: (toast) => {
       toast.onmouseenter = Swal.stopTimer;
       toast.onmouseleave = Swal.resumeTimer;
     },
});

function mostrarNotificacion(icono, mensaje) {
     Toast.fire({
       icon: icono,
       title: mensaje,
     });
}

const email = () => {
    const datos = new FormData(formulario);
    fetch('../enviar-correo.php', {
        method: 'POST',
        body: datos
    })
    .then(res => res.json())
    .then(res => {

     if ('exito') { 
       mostrarNotificacion(
            "success",
            "¡Enviado con éxito! ✅"
       );
       formulario.reset();
     } else {
       mostrarNotificacion(
            "error",
            "Hubo un problema. Inténtalo de nuevo. ❌"
       );
     }
    })
    .catch(error => {
     console.error('Error:', error);
     mostrarNotificacion("error", "Hubo un error en la solicitud.");
     })
    .finally(() => {
          spinner.style.display = 'none';
    });
};


