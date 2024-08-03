// Selecciona las categorias del servicio que se traen de la base de datos
function selectCategorias(categorias){
    let categoriasSeleccionadasLabel = document.querySelector("#categorias-seleccionadas");
    categoriasSeleccionadasLabel.innerHTML = "Categorias Seleccionadas: "
    categorias.forEach(cat =>{
        document.querySelector(`#categoria option[value="${cat.id}"]`).selected = true;
        categoriasSeleccionadasLabel.innerHTML += `${cat.tipo}, `;
    });
}


function categoriasSeleccionadas (){
    let selectCategorias = document.querySelector("#categoria");
        categoriasSeleccionadasLabel = document.querySelector("#categorias-seleccionadas");
    
    selectCategorias = [...selectCategorias.options];
    console.log(selectCategorias);
    categoriasSeleccionadasLabel.innerHTML = "Categorias Seleccionadas: ";
    selectCategorias.forEach(cat =>{
        if(cat.selected){
            categoriasSeleccionadasLabel.innerHTML += `${cat.innerHTML},`;
        }
    });
}

document.addEventListener("DOMContentLoaded",()=>{
    document.querySelector("#categoria").addEventListener('click',()=>{
        categoriasSeleccionadas();
    });
});