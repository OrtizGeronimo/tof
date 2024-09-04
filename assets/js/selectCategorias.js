document.addEventListener("DOMContentLoaded", () => {

    function categoriasSeleccionadas(event) {
        let selectCategorias = document.querySelector("#categoria");
        debugger;
        let categoriasSeleccionadasLabel = document.querySelector("#categorias-seleccionadas");

        let opcionesSeleccionadas = [...selectCategorias.options].filter(option => option.selected);
        let categoriasSeleccionadasCount = opcionesSeleccionadas.length;
        console.log(event.target.value);

        if (categoriasSeleccionadasCount > limiteCategorias) {
            alert("No puede seleccionar más categorías porque alcanzó el límite de su plan.");

            let optionModificado = document.getElementById(`categoria_option_${event.target.value}`);
            
            optionModificado.selected = false;
            categoriasSeleccionadasCount--; // Reducir el contador ya que la última selección no cuenta
        }

        let categoriasSeleccionadasTexto = "Categorías Seleccionadas: ";
        opcionesSeleccionadas = [...selectCategorias.options].filter(option => option.selected);

        opcionesSeleccionadas.forEach(cat => {
            categoriasSeleccionadasTexto += `${cat.innerHTML}, `;
        });

        categoriasSeleccionadasLabel.innerHTML = categoriasSeleccionadasTexto;
        //validarLimiteCategorias(categoriasSeleccionadasCount);
    }
/*
    function validarLimiteCategorias(categoriasSeleccionadasCount = 0) {
        let selectCategorias = document.querySelector("#categoria");
        let options = [...selectCategorias.options];

        options.forEach(cat => {
            if (categoriasSeleccionadasCount >= limiteCategorias && !cat.selected && limiteCategorias !== PHP_INT_MAX) {
                cat.disabled = true;
            } else {
                cat.disabled = false;
            }
        });
    }
*/
    document.querySelector("#categoria").addEventListener('change', (event) => {
        categoriasSeleccionadas(event);
    });
});