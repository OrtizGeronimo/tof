let categorias = document.querySelectorAll("#categoria-dropdown li a");
let provincias = document.querySelectorAll("#provincia-dropdown li a");
let btnCategoria = document.querySelector("#btnCategoria");
let btnProvincia = document.querySelector("#btnProvincia");
let inputCategoria = document.querySelector("#categoria-search");
let inputProvincia = document.querySelector("#provincia-search");

const seleccionar = (dropwdown,input,btnDropdown = null) =>{
    dropwdown.forEach(item => {
        item.addEventListener('click',()=>{
            input.value = item.innerHTML;
            if(btnDropdown != null)
                btnDropdown.innerHTML = item.innerHTML;
        })
    });
}

seleccionar(categorias,inputCategoria,btnCategoria);
seleccionar(provincias,inputProvincia,btnProvincia);    
