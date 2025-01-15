function setHorarios (horarios){
    try {
        
        let franjaHoraria = 0;
        horarios.forEach(hora => {
            const hora_desde = hora.hora_desde.split(":");
            const containerHorarios = document.getElementById(`container${hora.dia}`);
            // document.querySelector(`#idHorario${hora.dia}`).value = hora.idServicio_horario
            //Si no lo parsea es xq el campo no trae una hora
            if(!parseInt(hora_desde[0])){ 
                (hora.hora_desde != "--")
                    ? document.querySelector(`[name="horarios[${hora.dia}]"][value="${hora.hora_desde}"]`).checked = true
                    : '';
                const inputIdHorario = document.createElement("input");
                inputIdHorario.setAttribute("type","hidden");
                inputIdHorario.setAttribute("id",`idHorario${hora.dia}`);
                inputIdHorario.setAttribute("name",`idHorario${hora.dia}`);
                inputIdHorario.setAttribute("value",`${hora.idServicio_horario}`);
                containerHorarios.appendChild(inputIdHorario);
            }else{
                const template = document.getElementById("template");
                
                const DIA_ID = {
                    Lunes:'lu',
                    Martes:'ma',
                    Miercoles:'mi',
                    Jueves:'ju',
                    Viernes:'vi',
                    Sabado:'sa',
                    Domingo:'do'
                }
                
                
                const inputIdHorario = document.createElement("input");
                inputIdHorario.setAttribute("type","hidden");
                inputIdHorario.setAttribute("name",`idHorario${franjaHoraria+hora.dia}`);
                inputIdHorario.setAttribute("value",`${hora.idServicio_horario}`);
                containerHorarios.appendChild(inputIdHorario);
    
                const CloneTemplate = template.content.cloneNode(true);
                CloneTemplate.getElementById("selectHorarios").id = "selectHorariosLunes" + franjaHoraria;
                CloneTemplate.getElementById("btnBorrarHorario").id = `${DIA_ID[hora.dia]? DIA_ID[hora.dia] : ''}${franjaHoraria}`
                CloneTemplate.getElementById("desde").name = `desde${franjaHoraria+hora.dia}`;
                CloneTemplate.getElementById("desde").id   = `desde${franjaHoraria+hora.dia}`;
                CloneTemplate.querySelector(`#desde${franjaHoraria+hora.dia} option[value="${hora.hora_desde}"]`).selected = true;
                CloneTemplate.getElementById("hasta").name = `hasta${franjaHoraria+hora.dia}`;
                CloneTemplate.getElementById("hasta").id   = `hasta${franjaHoraria+hora.dia}`;
                CloneTemplate.querySelector(`#hasta${franjaHoraria+hora.dia} option[value="${hora.hora_hasta}"]`).selected = true;
                containerHorarios.appendChild(CloneTemplate);
                franjaHoraria++;
                 
            
                if (franjaHoraria == 2) {
                    document.getElementById(`btnAñadirHorarios${hora.dia}`).style.display = "none";
                }
            }
        });
    } catch (error) {
        console.log(error);
    }
}