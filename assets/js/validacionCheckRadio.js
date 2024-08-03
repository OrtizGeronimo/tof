
const nombrePersona = document.getElementById("nombrePersona");
const apellidoPersona = document.getElementById("apellidoPersona");
const nombreEmpresa = document.getElementById("nombreEmpresa");
const persona = document.getElementById("persona");
const empresa = document.getElementById("empresa");

nombreEmpresa.style.display = 'none';

function mostrarEmpresa() {
    nombrePersona.style.display = 'none';
    apellidoPersona.style.display = 'none';
    nombreEmpresa.style.display = 'flex';
    persona.checked = false;
    empresa.checked = true;
};

function mostrarPersona() {
    nombrePersona.style.display = 'flex';
    apellidoPersona.style.display = 'flex';
    nombreEmpresa.style.display = 'none';
    persona.checked = true;
    empresa.checked = false;
};