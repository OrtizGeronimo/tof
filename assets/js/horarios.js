const template = document.getElementById("template");
const containerLunes = document.getElementById("containerLunes");
const btnAñadirHorariosLunes = document.getElementById("btnAñadirHorariosLunes");
var contadorLunes = 0;

btnAñadirHorariosLunes.addEventListener("click", function(){

    if (contadorLunes < 2) {
        const CloneTemplate = template.content.cloneNode(true);
        CloneTemplate.getElementById("selectHorarios").id = "selectHorariosLunes" + contadorLunes;
        CloneTemplate.getElementById("btnBorrarHorario").id = "lu" + contadorLunes;
        CloneTemplate.getElementById("desde").name = "desde" + contadorLunes + "Lunes";
        CloneTemplate.getElementById("hasta").name = "hasta" + contadorLunes + "Lunes";     
        CloneTemplate.getElementById("desde").id = "desde" + contadorLunes + "Lunes";
        CloneTemplate.getElementById("hasta").id = "hasta" + contadorLunes + "Lunes";      
        containerLunes.appendChild(CloneTemplate);
        contadorLunes++;
    }  

    if (contadorLunes == 2) {
        btnAñadirHorariosLunes.style.display = "none"
    }

});

function mostrarLunes() {
    btnAñadirHorariosLunes.style.display = 'block';
    document.getElementById("gridRadios1Lunes").checked = true;
    document.getElementById("gridRadios2Lunes").checked = false;
    document.getElementById("gridRadios3Lunes").checked = false;
    document.getElementById("gridRadios4Lunes").checked = false;
};

function ocultarLunes(myid) {
    btnAñadirHorariosLunes.style.display = 'none';

    for (var i = 0; i < contadorLunes; i++) {
        document.getElementById("selectHorariosLunes" + i).remove();
    }

    contadorLunes = 0;

    document.getElementById("gridRadios1Lunes").checked = false;
    document.getElementById(myid).checked = true;

    if (myid == "gridRadios2Lunes") {
        document.getElementById("gridRadios3Lunes").checked = false;
        document.getElementById("gridRadios4Lunes").checked = false;
    } else {
        if (myid == "gridRadios3Lunes") {
            document.getElementById("gridRadios2Lunes").checked = false;
            document.getElementById("gridRadios4Lunes").checked = false;
        } else {
            document.getElementById("gridRadios2Lunes").checked = false;
            document.getElementById("gridRadios3Lunes").checked = false;            
        }
    }
    
};

const containerMartes = document.getElementById("containerMartes");
const btnAñadirHorariosMartes = document.getElementById("btnAñadirHorariosMartes");
var contadorMartes = 0;

btnAñadirHorariosMartes.addEventListener("click", function(){

    if (contadorMartes < 2) {
        const CloneTemplate = template.content.cloneNode(true);
        CloneTemplate.getElementById("selectHorarios").id = "selectHorariosMartes" + contadorMartes;
        CloneTemplate.getElementById("btnBorrarHorario").id = "ma" + contadorMartes;
        CloneTemplate.getElementById("desde").name = "desde" + contadorMartes + "Martes";
        CloneTemplate.getElementById("hasta").name = "hasta" + contadorMartes + "Martes";     
        CloneTemplate.getElementById("desde").id = "desde" + contadorMartes + "Martes";
        CloneTemplate.getElementById("hasta").id = "hasta" + contadorMartes + "Martes";   
        containerMartes.appendChild(CloneTemplate);
        contadorMartes++;
    }  

    if (contadorMartes == 2) {
        btnAñadirHorariosMartes.style.display = "none"
    }
});

function mostrarMartes() {
    btnAñadirHorariosMartes.style.display = 'block';

    document.getElementById("gridRadios1Martes").checked = true;
    document.getElementById("gridRadios2Martes").checked = false;
    document.getElementById("gridRadios3Martes").checked = false;
    document.getElementById("gridRadios4Martes").checked = false;
};

function ocultarMartes(myid) {
    btnAñadirHorariosMartes.style.display = 'none';

    for (var i = 0; i < contadorMartes; i++) {
        document.getElementById("selectHorariosMartes" + i).remove();
    }

    contadorMartes = 0;

    document.getElementById("gridRadios1Martes").checked = false;
    document.getElementById(myid).checked = true;

    if (myid == "gridRadios2Martes") {
        document.getElementById("gridRadios3Martes").checked = false;
        document.getElementById("gridRadios4Martes").checked = false;
    } else {
        if (myid == "gridRadios3Martes") {
            document.getElementById("gridRadios2Martes").checked = false;
            document.getElementById("gridRadios4Martes").checked = false;
        } else {
            document.getElementById("gridRadios2Martes").checked = false;
            document.getElementById("gridRadios3Martes").checked = false;            
        }
    }
};

const containerMiercoles = document.getElementById("containerMiercoles");
const btnAñadirHorariosMiercoles = document.getElementById("btnAñadirHorariosMiercoles");
var contadorMiercoles = 0;

btnAñadirHorariosMiercoles.addEventListener("click", function(){
    
    if (contadorMiercoles < 2) {
        const CloneTemplate = template.content.cloneNode(true);
        CloneTemplate.getElementById("selectHorarios").id = "selectHorariosMiercoles" + contadorMiercoles;
        CloneTemplate.getElementById("btnBorrarHorario").id = "mi" + contadorMiercoles;
        CloneTemplate.getElementById("desde").name = "desde" + contadorMiercoles + "Miercoles";
        CloneTemplate.getElementById("hasta").name = "hasta" + contadorMiercoles + "Miercoles";     
        CloneTemplate.getElementById("desde").id = "desde" + contadorMiercoles + "Miercoles";
        CloneTemplate.getElementById("hasta").id = "hasta" + contadorMiercoles + "Miercoles";   
        containerMiercoles.appendChild(CloneTemplate);
        contadorMiercoles++;
    }  

    if (contadorMiercoles == 2) {
        btnAñadirHorariosMiercoles.style.display = "none"
    }
});

function mostrarMiercoles() {
    btnAñadirHorariosMiercoles.style.display = 'block';

    document.getElementById("gridRadios1Miercoles").checked = true;
    document.getElementById("gridRadios2Miercoles").checked = false;
    document.getElementById("gridRadios3Miercoles").checked = false;
    document.getElementById("gridRadios4Miercoles").checked = false;
};

function ocultarMiercoles(myid) {
    btnAñadirHorariosMiercoles.style.display = 'none';

    for (var i = 0; i < contadorMiercoles; i++) {
        document.getElementById("selectHorariosMiercoles" + i).remove();
    }

    contadorMiercoles = 0;

    document.getElementById("gridRadios1Miercoles").checked = false;
    document.getElementById(myid).checked = true;

    if (myid == "gridRadios2Miercoles") {
        document.getElementById("gridRadios3Miercoles").checked = false;
        document.getElementById("gridRadios4Miercoles").checked = false;
    } else {
        if (myid == "gridRadios3Miercoles") {
            document.getElementById("gridRadios2Miercoles").checked = false;
            document.getElementById("gridRadios4Miercoles").checked = false;
        } else {
            document.getElementById("gridRadios2Miercoles").checked = false;
            document.getElementById("gridRadios3Miercoles").checked = false;            
        }
    }
};

const containerJueves = document.getElementById("containerJueves");
const btnAñadirHorariosJueves = document.getElementById("btnAñadirHorariosJueves");
var contadorJueves = 0;

btnAñadirHorariosJueves.addEventListener("click", function(){
    
    if (contadorJueves < 2) {
        const CloneTemplate = template.content.cloneNode(true);
        CloneTemplate.getElementById("selectHorarios").id = "selectHorariosJueves" + contadorJueves;
        CloneTemplate.getElementById("btnBorrarHorario").id = "ju" + contadorJueves;
        CloneTemplate.getElementById("desde").name = "desde" + contadorJueves + "Jueves";
        CloneTemplate.getElementById("hasta").name = "hasta" + contadorJueves + "Jueves";     
        CloneTemplate.getElementById("desde").id = "desde" + contadorJueves + "Jueves";
        CloneTemplate.getElementById("hasta").id = "hasta" + contadorJueves + "Jueves";   
        containerJueves.appendChild(CloneTemplate);
        contadorJueves++;
    }  

    if (contadorJueves == 2) {
        btnAñadirHorariosJueves.style.display = "none"
    }
});

function mostrarJueves() {
    btnAñadirHorariosJueves.style.display = 'block';

    document.getElementById("gridRadios1Jueves").checked = true;
    document.getElementById("gridRadios2Jueves").checked = false;
    document.getElementById("gridRadios3Jueves").checked = false;
    document.getElementById("gridRadios4Jueves").checked = false;
};

function ocultarJueves(myid) {
    btnAñadirHorariosJueves.style.display = 'none';

    for (var i = 0; i < contadorJueves; i++) {
        document.getElementById("selectHorariosJueves" + i).remove();
    }

    contadorJueves = 0;

    document.getElementById("gridRadios1Jueves").checked = false;
    document.getElementById(myid).checked = true;

    if (myid == "gridRadios2Jueves") {
        document.getElementById("gridRadios3Jueves").checked = false;
        document.getElementById("gridRadios4Jueves").checked = false;
    } else {
        if (myid == "gridRadios3Jueves") {
            document.getElementById("gridRadios2Jueves").checked = false;
            document.getElementById("gridRadios4Jueves").checked = false;
        } else {
            document.getElementById("gridRadios2Jueves").checked = false;
            document.getElementById("gridRadios3Jueves").checked = false;            
        }
    }
};

const containerViernes = document.getElementById("containerViernes");
const btnAñadirHorariosViernes = document.getElementById("btnAñadirHorariosViernes");
var contadorViernes = 0;

btnAñadirHorariosViernes.addEventListener("click", function(){
    
    if (contadorViernes < 2) {
        const CloneTemplate = template.content.cloneNode(true);
        CloneTemplate.getElementById("selectHorarios").id = "selectHorariosViernes" + contadorViernes;
        CloneTemplate.getElementById("btnBorrarHorario").id = "vi" + contadorViernes;
        CloneTemplate.getElementById("desde").name = "desde" + contadorViernes + "Viernes";
        CloneTemplate.getElementById("hasta").name = "hasta" + contadorViernes + "Viernes";     
        CloneTemplate.getElementById("desde").id = "desde" + contadorViernes + "Viernes";
        CloneTemplate.getElementById("hasta").id = "hasta" + contadorViernes + "Viernes";   
        containerViernes.appendChild(CloneTemplate);
        contadorViernes++;
    } 

    if (contadorViernes == 2) {
        btnAñadirHorariosViernes.style.display = "none"
    }
    
});

function mostrarViernes() {
    btnAñadirHorariosViernes.style.display = 'block';

    document.getElementById("gridRadios1Viernes").checked = true;
    document.getElementById("gridRadios2Viernes").checked = false;
    document.getElementById("gridRadios3Viernes").checked = false;
    document.getElementById("gridRadios4Viernes").checked = false;
};

function ocultarViernes(myid) {
    btnAñadirHorariosViernes.style.display = 'none';

    for (var i = 0; i < contadorViernes; i++) {
        document.getElementById("selectHorariosViernes" + i).remove();
    }

    contadorViernes = 0;

    document.getElementById("gridRadios1Viernes").checked = false;
    document.getElementById(myid).checked = true;

    if (myid == "gridRadios2Viernes") {
        document.getElementById("gridRadios3Viernes").checked = false;
        document.getElementById("gridRadios4Viernes").checked = false;
    } else {
        if (myid == "gridRadios3Viernes") {
            document.getElementById("gridRadios2Viernes").checked = false;
            document.getElementById("gridRadios4Viernes").checked = false;
        } else {
            document.getElementById("gridRadios2Viernes").checked = false;
            document.getElementById("gridRadios3Viernes").checked = false;            
        }
    }
};

const containerSabado = document.getElementById("containerSabado");
const btnAñadirHorariosSabado = document.getElementById("btnAñadirHorariosSabado");
var contadorSabado = 0;

btnAñadirHorariosSabado.addEventListener("click", function(){
        
    if (contadorSabado < 2) {
        const CloneTemplate = template.content.cloneNode(true);
        CloneTemplate.getElementById("selectHorarios").id = "selectHorariosSabado" + contadorSabado;
        CloneTemplate.getElementById("btnBorrarHorario").id = "sa" + contadorSabado;
        CloneTemplate.getElementById("desde").name = "desde" + contadorSabado + "Sabado";
        CloneTemplate.getElementById("hasta").name = "hasta" + contadorSabado + "Sabado";     
        CloneTemplate.getElementById("desde").id = "desde" + contadorSabado + "Sabado";
        CloneTemplate.getElementById("hasta").id = "hasta" + contadorSabado + "Sabado";   
        containerSabado.appendChild(CloneTemplate);
        contadorSabado++;
    } 

    if (contadorSabado == 2) {
        btnAñadirHorariosSabado.style.display = "none"
    }
});

function mostrarSabado() {
    btnAñadirHorariosSabado.style.display = 'block';

    document.getElementById("gridRadios1Sabado").checked = true;
    document.getElementById("gridRadios2Sabado").checked = false;
    document.getElementById("gridRadios3Sabado").checked = false;
    document.getElementById("gridRadios4Sabado").checked = false;
};

function ocultarSabado(myid) {
    btnAñadirHorariosSabado.style.display = 'none';

    for (var i = 0; i < contadorSabado; i++) {
        document.getElementById("selectHorariosSabado" + i).remove();
    }

    contadorSabado = 0;

    document.getElementById("gridRadios1Sabado").checked = false;
    document.getElementById(myid).checked = true;

    if (myid == "gridRadios2Sabado") {
        document.getElementById("gridRadios3Sabado").checked = false;
        document.getElementById("gridRadios4Sabado").checked = false;
    } else {
        if (myid == "gridRadios3Sabado") {
            document.getElementById("gridRadios2Sabado").checked = false;
            document.getElementById("gridRadios4Sabado").checked = false;
        } else {
            document.getElementById("gridRadios2Sabado").checked = false;
            document.getElementById("gridRadios3Sabado").checked = false;            
        }
    }
};

const containerDomingo = document.getElementById("containerDomingo");
const btnAñadirHorariosDomingo = document.getElementById("btnAñadirHorariosDomingo");
var contadorDomingo = 0;

btnAñadirHorariosDomingo.addEventListener("click", function(){
    
    if (contadorDomingo < 2) {
        const CloneTemplate = template.content.cloneNode(true);
        CloneTemplate.getElementById("selectHorarios").id = "selectHorariosDomingo" + contadorDomingo;
        CloneTemplate.getElementById("btnBorrarHorario").id = "do" + contadorDomingo;
        CloneTemplate.getElementById("desde").name = "desde" + contadorDomingo + "Domingo";
        CloneTemplate.getElementById("hasta").name = "hasta" + contadorDomingo + "Domingo";     
        CloneTemplate.getElementById("desde").id = "desde" + contadorDomingo + "Domingo";
        CloneTemplate.getElementById("hasta").id = "hasta" + contadorDomingo + "Domingo";   
        containerDomingo.appendChild(CloneTemplate);
        contadorDomingo++;
    } 

    if (contadorDomingo == 2) {
        btnAñadirHorariosDomingo.style.display = "none"
    }
});

function mostrarDomingo() {
    btnAñadirHorariosDomingo.style.display = 'block';

    document.getElementById("gridRadios1Domingo").checked = true;
    document.getElementById("gridRadios2Domingo").checked = false;
    document.getElementById("gridRadios3Domingo").checked = false;
    document.getElementById("gridRadios4Domingo").checked = false;
};

function ocultarDomingo(myid) {
    btnAñadirHorariosDomingo.style.display = 'none';

    for (var i = 0; i < contadorDomingo; i++) {
        document.getElementById("selectHorariosDomingo" + i).remove();
    }

    contadorDomingo = 0;

    document.getElementById("gridRadios1Domingo").checked = false;
    document.getElementById(myid).checked = true;

    if (myid == "gridRadios2Domingo") {
        document.getElementById("gridRadios3Domingo").checked = false;
        document.getElementById("gridRadios4Domingo").checked = false;
    } else {
        if (myid == "gridRadios3Domingo") {
            document.getElementById("gridRadios2Domingo").checked = false;
            document.getElementById("gridRadios4Domingo").checked = false;
        } else {
            document.getElementById("gridRadios2Domingo").checked = false;
            document.getElementById("gridRadios3Domingo").checked = false;            
        }
    }
};

function BorrarHorario (myid) {

    if ((myid[0] == "l") && (myid[1] == "u")) {
        document.getElementById("selectHorariosLunes" + myid[2]).remove();

        var number = parseInt(myid[2]);
        number++;

        for (var i = 0; i <= contadorLunes; i++) {

            if (document.getElementById("selectHorariosLunes" + number)) {
                document.getElementById("selectHorariosLunes" + number).id = "selectHorariosLunes" + (number-1);
                document.getElementById("lu" + number).id = "lu" + (number-1);
                document.getElementById("desde" + number + "Lunes").name = "desde" + (number-1) + "Lunes";
                document.getElementById("hasta" + number + "Lunes").name = "hasta" + (number-1) + "Lunes";  
                document.getElementById("desde" + number + "Lunes").id = "desde" + (number-1) + "Lunes";
                document.getElementById("hasta" + number + "Lunes").id = "hasta" + (number-1) + "Lunes";  
                number++;
            } else {
                break;
            }
        }

        contadorLunes--;

        if (contadorLunes == 1) {
            btnAñadirHorariosLunes.style.display = 'block';
        }
    }

    if ((myid[0] == "m") && (myid[1] == "a")) {
        document.getElementById("selectHorariosMartes" + myid[2]).remove();

        var number = parseInt(myid[2]);
        number++;

        for (var i = 0; i <= contadorMartes; i++) {

            if (document.getElementById("selectHorariosMartes" + number)) {
                document.getElementById("selectHorariosMartes" + number).id = "selectHorariosMartes" + (number-1);
                document.getElementById("ma" + number).id = "ma" + (number-1);
                document.getElementById("desde" + number + "Martes").name = "desde" + (number-1) + "Martes";
                document.getElementById("hasta" + number + "Martes").name = "hasta" + (number-1) + "Martes";  
                document.getElementById("desde" + number + "Martes").id = "desde" + (number-1) + "Martes";
                document.getElementById("hasta" + number + "Martes").id = "hasta" + (number-1) + "Martes";  
                number++;
            } else {
                break;
            }
        }

        contadorMartes--;

        if (contadorMartes == 1) {
            btnAñadirHorariosMartes.style.display = 'block';
        }
    }

    if ((myid[0] == "m") && (myid[1] == "i")) {
        document.getElementById("selectHorariosMiercoles" + myid[2]).remove();

        var number = parseInt(myid[2]);
        number++;

        for (var i = 0; i <= contadorMiercoles; i++) {

            if (document.getElementById("selectHorariosMiercoles" + number)) {
                document.getElementById("selectHorariosMiercoles" + number).id = "selectHorariosMiercoles" + (number-1);
                document.getElementById("mi" + number).id = "mi" + (number-1);
                document.getElementById("desde" + number + "Miercoles").name = "desde" + (number-1) + "Miercoles";
                document.getElementById("hasta" + number + "Miercoles").name = "hasta" + (number-1) + "Miercoles";  
                document.getElementById("desde" + number + "Miercoles").id = "desde" + (number-1) + "Miercoles";
                document.getElementById("hasta" + number + "Miercoles").id = "hasta" + (number-1) + "Miercoles";  
                number++;
            } else {
                break;
            }
        }

        contadorMiercoles--;

        if (contadorMiercoles == 1) {
            btnAñadirHorariosMiercoles.style.display = 'block';
        }
    }

    if ((myid[0] == "j") && (myid[1] == "u")) {
        document.getElementById("selectHorariosJueves" + myid[2]).remove();

        var number = parseInt(myid[2]);
        number++;

        for (var i = 0; i <= contadorJueves; i++) {

            if (document.getElementById("selectHorariosJueves" + number)) {
                document.getElementById("selectHorariosJueves" + number).id = "selectHorariosJueves" + (number-1);
                document.getElementById("ju" + number).id = "ju" + (number-1);
                document.getElementById("desde" + number + "Jueves").name = "desde" + (number-1) + "Jueves";
                document.getElementById("hasta" + number + "Jueves").name = "hasta" + (number-1) + "Jueves";  
                document.getElementById("desde" + number + "Jueves").id = "desde" + (number-1) + "Jueves";
                document.getElementById("hasta" + number + "Jueves").id = "hasta" + (number-1) + "Jueves"; 
                number++;
            } else {
                break;
            }
        }

        contadorJueves--;

        if (contadorJueves == 1) {
            btnAñadirHorariosJueves.style.display = 'block';
        }
    }

    if ((myid[0] == "v") && (myid[1] == "i")) {
        document.getElementById("selectHorariosViernes" + myid[2]).remove();

        var number = parseInt(myid[2]);
        number++;

        for (var i = 0; i <= contadorViernes; i++) {

            if (document.getElementById("selectHorariosViernes" + number)) {
                document.getElementById("selectHorariosViernes" + number).id = "selectHorariosViernes" + (number-1);
                document.getElementById("vi" + number).id = "vi" + (number-1);
                document.getElementById("desde" + number + "Viernes").name = "desde" + (number-1) + "Viernes";
                document.getElementById("hasta" + number + "Viernes").name = "hasta" + (number-1) + "Viernes";  
                document.getElementById("desde" + number + "Viernes").id = "desde" + (number-1) + "Viernes";
                document.getElementById("hasta" + number + "Viernes").id = "hasta" + (number-1) + "Viernes"; 
                number++;
            } else {
                break;
            }
        }

        contadorViernes--;

        if (contadorViernes == 1) {
            btnAñadirHorariosViernes.style.display = 'block';
        }
    }

    if ((myid[0] == "s") && (myid[1] == "a")) {
        document.getElementById("selectHorariosSabado" + myid[2]).remove();

        var number = parseInt(myid[2]);
        number++;

        for (var i = 0; i <= contadorSabado; i++) {

            if (document.getElementById("selectHorariosSabado" + number)) {
                document.getElementById("selectHorariosSabado" + number).id = "selectHorariosSabado" + (number-1);
                document.getElementById("sa" + number).id = "sa" + (number-1);
                document.getElementById("desde" + number + "Sabado").name = "desde" + (number-1) + "Sabado";
                document.getElementById("hasta" + number + "Sabado").name = "hasta" + (number-1) + "Sabado";  
                document.getElementById("desde" + number + "Sabado").id = "desde" + (number-1) + "Sabado";
                document.getElementById("hasta" + number + "Sabado").id = "hasta" + (number-1) + "Sabado"; 
                number++;
            } else {
                break;
            }
        }

        contadorSabado--;

        if (contadorSabado == 1) {
            btnAñadirHorariosSabado.style.display = 'block';
        }
    }

    if ((myid[0] == "d") && (myid[1] == "o")) {
        document.getElementById("selectHorariosDomingo" + myid[2]).remove();

        var number = parseInt(myid[2]);
        number++;

        for (var i = 0; i <= contadorDomingo; i++) {

            if (document.getElementById("selectHorariosDomingo" + number)) {
                document.getElementById("selectHorariosDomingo" + number).id = "selectHorariosDomingo" + (number-1);
                document.getElementById("do" + number).id = "do" + (number-1);
                document.getElementById("desde" + number + "Domingo").name = "desde" + (number-1) + "Domingo";
                document.getElementById("hasta" + number + "Domingo").name = "hasta" + (number-1) + "Domingo";  
                document.getElementById("desde" + number + "Domingo").id = "desde" + (number-1) + "Domingo";
                document.getElementById("hasta" + number + "Domingo").id = "hasta" + (number-1) + "Domingo"; 
                number++;
            } else {
                break;
            }
        }

        contadorDomingo--;

        if (contadorDomingo == 1) {
            btnAñadirHorariosDomingo.style.display = 'block';
        }
    }

};
