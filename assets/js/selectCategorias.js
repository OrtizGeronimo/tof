document.addEventListener("DOMContentLoaded", () => {

    function categoriasSeleccionadas(event) {
        let selectCategorias = document.querySelector("#categoria");
        let categoriasSeleccionadasLabel = document.querySelector("#categorias-seleccionadas");

        let opcionesSeleccionadas = [...selectCategorias.options].filter(option => option.selected);
        let categoriasSeleccionadasCount = opcionesSeleccionadas.length;
        let categoriasSeleccionadasTexto = "Categorías Seleccionadas: ";

        if (categoriasSeleccionadasCount > limiteCategorias) {
            Swal.fire({
                title: '¿Desea cambiar su plan?',
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
                    // Desselecciona categorías adicionales
                    for (let i = opcionesSeleccionadas.length - 1; i >= 0; i--) {
                        if (i >= limiteCategorias) {
                            opcionesSeleccionadas[i].selected = false;
                        }
                    }
                    // Actualiza el texto de las categorías seleccionadas
                    opcionesSeleccionadas = [...selectCategorias.options].filter(option => option.selected);
                    categoriasSeleccionadasTexto += opcionesSeleccionadas.map(option => option.innerHTML).join(', ');
                    categoriasSeleccionadasLabel.innerHTML = categoriasSeleccionadasTexto;
                }
            });
        } else {
            // Actualiza el texto de las categorías seleccionadas directamente
            categoriasSeleccionadasTexto += opcionesSeleccionadas.map(option => option.innerHTML).join(', ');
            categoriasSeleccionadasLabel.innerHTML = categoriasSeleccionadasTexto;
        }

        // Gestiona los iconos
        [...selectCategorias.options].forEach(option => {
            if (option.selected) {
                option.classList.add('checked');
            } else {
                option.classList.remove('checked');
            }
        });
    }

    document.querySelector("#categoria").addEventListener('change', (event) => {
        categoriasSeleccionadas(event);
    });
});