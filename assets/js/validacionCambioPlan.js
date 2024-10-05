document.addEventListener("DOMContentLoaded", function() {
const planSelect = document.getElementById("plan");
const paymentForm = document.getElementById("payment-form");
const btnSubmit = document.getElementById('form-checkout__submit');
const btnSubmitGratuito = document.getElementById('btn_crearCuenta');

// Ocultar el formulario al inicio
paymentForm.style.display = "none";
btnSubmit.style.display = "none";

// Función para mostrar/ocultar el formulario basado en el plan seleccionado
planSelect.addEventListener("change", function() {
    if (planSelect.value === "gratis") {
    paymentForm.style.display = "none";
    btnSubmit.style.display = "none";
    btnSubmitGratuito.style.display = "block";
    } else {
    paymentForm.style.display = "block";
    btnSubmit.style.display = "block";
    btnSubmitGratuito.style.display = "none";
    }
});
});