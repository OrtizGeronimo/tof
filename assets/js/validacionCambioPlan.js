document.addEventListener("DOMContentLoaded", function() {
const planSelect = document.getElementById("plan");
const paymentForm = document.getElementById("payment-form");
const rolEditor = document.getElementById("rolEditor");

let form = document.getElementById("form-checkout");
// Form type(register/edit)
let formType = form.querySelector('input[name="formType"]').value; 

const btnSubmit = document.getElementById('form-checkout__submit');
const btnSubmitGratuito = document.getElementById('btn_crearCuenta');

// Ocultar el formulario al inicio
paymentForm.style.display = "none";
btnSubmit.style.display = "none";

// Función para mostrar/ocultar el formulario basado en el plan seleccionado
planSelect.addEventListener("change", function() {
    if (planSelect.value === "gratis" && rolEditor.value.toUpperCase() != "ADMIN") {
        paymentForm.style.display = "none";        
        btnSubmit.style.display = "none";
        btnSubmitGratuito.style.display = "block";
        
    } else {
        if(rolEditor.value.toUpperCase() != "ADMIN"){
            paymentForm.style.display = "block";
            btnSubmit.style.display = "block";
            btnSubmitGratuito.style.display = "none"; 
        }               
    }
});
});