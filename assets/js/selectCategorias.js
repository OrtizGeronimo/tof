document.addEventListener("DOMContentLoaded", () => {

    function categoriasSeleccionadas(event) {
        let selectCategorias = document.querySelector("#categoria");
        let categoriasSeleccionadasLabel = document.querySelector("#categorias-seleccionadas");

        let opcionesSeleccionadas = [...selectCategorias.options].filter(option => option.selected);
        let categoriasSeleccionadasCount = opcionesSeleccionadas.length;
        console.log(event.target.value);

        if (categoriasSeleccionadasCount > limiteCategorias) {
            Swal.fire({
                title: 'Desea cambiar su plan?',
                text: 'No puede seleccionar más categorías porque alcanzó el límite de su plan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#F2C94C',
                cancelButtonColor: '#F2C94C',
                cancelButtonText: 'Mantener plan',                
                confirmButtonText: 'Cambiar Plan',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "./../editUser.php";
                } else if (result.isDismissed) {
                    let optionModificado = document.getElementById(`categoria_option_${event.target.value}`);
            
                    optionModificado.selected = false;
                    categoriasSeleccionadasCount--; // Reducir el contador ya que la última selección no cuenta
                }
            });
        }

        let categoriasSeleccionadasTexto = "Categorías Seleccionadas: ";
        opcionesSeleccionadas = [...selectCategorias.options].filter(option => option.selected);

        opcionesSeleccionadas.forEach(cat => {
            categoriasSeleccionadasTexto += `${cat.innerHTML}, `;
        });

        categoriasSeleccionadasLabel.innerHTML = categoriasSeleccionadasTexto;

        // gestion de iconos
    [...selectCategorias.options].forEach(option => {
        if (option.selected) {
            option.classList.add('checked');
        } else {
            option.classList.remove('checked');
        }
    });
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