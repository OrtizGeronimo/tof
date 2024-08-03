let categorias_item = document.querySelectorAll(".categoria-item");
let provincias_item = document.querySelectorAll(".provincia-item");
let tags_item       = document.querySelectorAll(".tag-item")

let items = Array();
items.push(categorias_item);
items.push(provincias_item);
items.push(tags_item);
console.log(items);
/**
 * Agrega la funcionalidad a la categorias del filtro
 */
const startFiltro = ()=>{
    
    items.forEach(tipoItem =>{
        tipoItem.forEach(item=>{
            item.addEventListener('click',()=>{
                addFiltro(item)
                filtrar();
            });
        });
    })

}

/**
 * Agrega o Saca un elemento en el apartado filtro
 * @param {*} item 
 */
const addFiltro = (item)=>{
    let itemsFiltro = document.querySelectorAll("ul#filtros-servicios li");
    
    let ulFiltro = document.querySelector("ul#filtros-servicios");
    
    let existFilter = false;
    
    itemsFiltro.forEach(itemFiltro => {
        if(itemFiltro === item){
            let auxTypeItem  = item.className.split("-item");//Obtengo el tipo de filtro del item
            let typeItem     = auxTypeItem[0];
            let filterType   = document.querySelector(`#${typeItem}s-servicios`);
            
            filterType.appendChild(item);
            existFilter = true;
        };
    });

    if(!existFilter)
        ulFiltro.appendChild(item);

    itemsFiltro = document.querySelectorAll("ul#filtros-servicios li");
    // console.log(itemsFiltro.length-1);
    if (itemsFiltro.length-1 > 0){
        document.querySelectorAll("ul#filtros-servicios li.filtro-item")[0].style.display = 'none';
    }else
        document.querySelectorAll("ul#filtros-servicios li.filtro-item")[0].style.display = '';

}



const filtrar = (pag = null)=>{
    //console.log("filtrar");
    let itemsFiltro = document.querySelectorAll("ul#filtros-servicios li");
    let categoria  = Array();
    let provincias = Array();
    let tags       = Array();
    


    itemsFiltro.forEach(item =>{
        let itemText = item.innerHTML.split("(");
        
        
        if (item.classList.contains("categoria-item") && item.innerHTML != "No hay filtros") 
        {
            categoria.push(`'${itemText[0].trim()}'`);     
        }
        else if(item.classList.contains("provincia-item") && item.innerHTML != "No hay filtros")
        {   
            provincias.push(`'${itemText[0].trim()}'`);
        }else if(item.classList.contains("tag-item") && item.innerHTML != "No hay filtros")
        {   
            tags.push(`'${itemText[0].trim()}'`);
        }
         
    })
        if(categoria.length == 0)
            categoria = "" 
        if(provincias.length == 0)
            provincias = ""     
        if(tags.length == 0)
            tags = "" 
    $.ajax({
        url:`./controller/serviciosPaginados.php${(pag!=null)?'?p='+pag :''}`,
        type: 'POST',
        data: {
            "categorias":categoria,
            "provincias":provincias,
            "tags":tags},
        success: function(result){
            $("#servicios").html(result);
        },
        error: function() {
            console.log("No se ha podido obtener la información");
        }
    });
}

startFiltro();