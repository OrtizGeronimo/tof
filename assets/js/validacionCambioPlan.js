/*document.getElementById('plan').addEventListener('change', function () {
    var selectedPlan = this.value;
    var btnCrearCuenta = document.getElementById('btn_crearCuenta');
    var btnSubmit = document.getElementById('form-checkout__submit');
    var paymentForm = document.getElementById('payment-form');

    if (selectedPlan === 'basico' || selectedPlan === 'pro') {
        paymentForm.classList.remove('hidden');  // Mostrar formulario de pago

        // Ocultar botón "Crear una cuenta" y mostrar "Pagar"
        btnCrearCuenta.classList.add('d-none');
        btnSubmit.classList.remove('d-none');
    } else {
        paymentForm.classList.add('hidden');  // Ocultar formulario de pago

        // Mostrar botón "Crear una cuenta" y ocultar "Pagar"
        btnCrearCuenta.classList.remove('d-none');
        btnSubmit.classList.add('d-none');
    }
});

// Ocultar botón "Pagar" y formulario al cargar la página
window.onload = function () {
    document.getElementById('btn_crearCuenta').classList.remove('d-none');
    document.getElementById('form-checkout__submit').classList.add('d-none');
    document.getElementById('payment-form').classList.add('hidden');
};
*/

document.addEventListener("DOMContentLoaded", function() {
const planSelect = document.getElementById("plan");
const paymentForm = document.getElementById("payment-form");
const btnCrearCuenta = document.getElementById('btn_crearCuenta');
const btnSubmit = document.getElementById('form-checkout__submit');

// Ocultar el formulario al inicio
paymentForm.style.display = "none";
btnSubmit.style.display = "none";

// Función para mostrar/ocultar el formulario basado en el plan seleccionado
planSelect.addEventListener("change", function() {
    if (planSelect.value === "gratis") {
    paymentForm.style.display = "none";
    btnSubmit.style.display = "none";
    btnCrearCuenta.style.display = "block";
    } else {
    paymentForm.style.display = "block";
    btnSubmit.style.display = "block";
    btnCrearCuenta.style.display = "none";
    }
});
});