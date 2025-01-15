<?php
  session_start();
  include_once('./config/conexion.php');
  include_once('./models/servicio.php');
  require('./models/categoria.php');
  require('./models/provincia.php');
  require('./models/tag.php');
  
  $categorias = Categoria :: getCategoria();
  $provincia  = Provincia :: getProvincia();
  $tags       = Tag       :: getTags();
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require("./assets/php/head.php");?>
  <link href="./assets/css/services.css" rel="stylesheet">
</head>

<body>
  <?php require("./assets/php/header.php");?>
  <!-- End Header -->

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
      <div class="page-header d-flex align-items-center" style="background-image: url('');">
        <div class="container position-relative">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-6 text-center">
              <h2>Servicios</h2>
              <p>Encontra los mejores profesionales cerca</p>
            </div>
          </div>
        </div>
      </div>
      <nav>
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li>Servicios</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

    <!-- ======= Blog Details Section ======= -->
    <section id="blog" class="blog">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">
          <!-- Search Section -->
          <div class="container mt-4">
            <div class="row justify-content-center">
              <div class="col-lg-12">
                <!-- Search Controls -->
                <div class="d-md-flex gap-4 mb-4 servicios sv-pag">
                  
                  <!-- Service Search Input -->
                  <div class="flex-grow-1 search-input" style="width: 300px;">
                    <input type="text" class="form-control" id="serviceSearch" placeholder="Buscar servicio...">
                  </div>

                    

                  <!-- Category Dropdown with Search -->
                  <div class="dropdown flex-grow-1">
                  <span class="text-muted small mb-1">Filtro</span>  
                  <button class="btn btn-outline-primary dropdown-toggle w-100" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                      Seleccionar Categoría
                    </button>
                    <div class="dropdown-menu w-100 p-3" aria-labelledby="categoryDropdown">
                      <input type="text" class="form-control mb-2" id="categorySearch" placeholder="Buscar categoría...">
                      <ul class="list-unstyled mb-0" id="categoryList">
                        <!-- Categories will be populated here -->
                      </ul>
                    </div>
                  </div>
                  <button type="button" class="btn btn-warning search-btn" onclick="filterServices(null)">Buscar</button>
                </div>

                <!-- Results Container -->
                <div class="col-lg-12">
                    <section id="servicios" class="servicios">
                      <div id="searchResults" class="row row-cols-2">
                        <!-- Service cards will be displayed here -->
                      </div>
                    </section>
                </div>
                <div id="paginacionServicio" class="pagination pt-5 ">
                  <nav class="mx-auto" aria-label="...">
                      <ul id="pagUl" class="pagination pagination-md">
                          <!-- Pagination links will be displayed here -->
                      </ul>
                  </nav>        
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Blog Details Section -->

  </main><!-- End #main --> 

  <?php require("./assets/php/footer.php")?>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/servicios.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
  <script>

let categories = [];
let global_services = [];
let selectedCategory = 'all';
let selectedCategories = new Array();
let currentPage = 1;
let totalPages = 1;
let categoryChanged = 0;


function populateCategories(cats) {
  const categoryList = document.getElementById('categoryList');
  categoryList.innerHTML = '<li><a class="dropdown-item" href="#" data-category="all">Todas las categorías</a></li>';
  cats.forEach(category => {
    const li = document.createElement('li');
    li.innerHTML = `<a class="dropdown-item" href="#" data-category="${category.idCategoria}">${category.tipo}</a>`;
    categoryList.appendChild(li);
  });

  // Add click event listeners to category items
  categoryList.querySelectorAll('.dropdown-item').forEach(item => {
    item.addEventListener('click', (e) => {
      if (categoryChanged === 1) {
       categoryChanged = 2; 
      }
      e.preventDefault();
      e.stopPropagation();

      const targetItem = e.currentTarget;
      selectedCategory = targetItem.dataset.category;
      
      //document.getElementById('categoryDropdown').textContent = e.target.textContent;
      
      
      if  (selectedCategory === 'all') {
        //selectedCategories = ["all"];
        //document.getElementById('categoryDropdown').textContent = 'Seleccionar Categoría';
        selectedCategories = [];
        document.getElementById('categoryList').querySelectorAll('.dropdown-item').forEach(item => {
          item.innerHTML = item.textContent;
        });
        filterServices();
      } else if (!selectedCategories.includes(selectedCategory)) {
        selectedCategories.push(selectedCategory);
        const icon = '<i class="bi bi-check-circle-fill"></i>';
        const icon_end = '<i class="bi bi-x-lg"></i>';
        targetItem.innerHTML = icon + targetItem.textContent + icon_end;
      } else {
        selectedCategories = selectedCategories.filter(category => category !== selectedCategory);
        targetItem.innerHTML = targetItem.textContent;
        if (selectedCategories.length === 0) {
          selectedCategory = 'all';
          //document.getElementById('categoryDropdown').textContent = 'Seleccionar Categoría';
        }
      }
      console.log("selectedCategories", selectedCategories);
      //filterServices();
    });
  });
}

function filterCategories() {
  const searchTerm = document.getElementById('categorySearch').value.toLowerCase();
  const categoryItems = document.querySelectorAll('#categoryList .dropdown-item');
  categoryItems.forEach(item => {
    const text = item.textContent.toLowerCase();
    item.style.display = text.includes(searchTerm) ? '' : 'none';
  });
}

async function filterServices(page) {
  if (categoryChanged === 2) {
    page = 1;
  }
  const searchTerm = document.getElementById('serviceSearch').value.toLowerCase();
  /*const filteredServices = global_services.filter(service => {
    const matchesSearch = service.servicio_nombre.toLowerCase().includes(searchTerm);
    const matchesCategory = selectedCategory === "all" || service.categories.some(category => selectedCategories.some(selectedCategory => selectedCategory === category.id));
    return matchesSearch && matchesCategory;
  //});*/
  let filteredServices = null;
  await fetch('./controller/api/getFilteredServices.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      searchTerm,
      selectedCategories,
      page
    })
  }).then(response => response.json())
    .then(data => {
      filteredServices = data.servicios;
      currentPage = data.pag;
      totalPages = data.cantPaginas;
    });
    categoryChanged = 1;

    await fetch('./controller/api/getCategoriesServices.php').then(response => response.json())
    .then(categories => {
      
      filteredServices.forEach(service => {
        service.categories = categories
          .filter(category => category.FK_idServicio === service.idServicio)
          .map(category => ({ id: category.FK_idCategoria }));
        });
    });



  displayServices(filteredServices);
}

function displayServices(filteredServices) {
  const resultsContainer = document.getElementById('searchResults');
  resultsContainer.innerHTML = '';

  if (filteredServices.length === 0) {
    resultsContainer.innerHTML = `
      <div class="col-12 flex items-center justify-center h-64">
        <div class="text-center">
          <p class="text-3xl font-bold text-gray-800 mb-4">No se encontraron servicios</p>
          <p class="text-lg text-gray-600">Lo sentimos, no hay servicios que coincidan con tu búsqueda.</p>
        </div>
      </div>
    `;
    updatePagination(1, 1);
    return;
  }

  filteredServices.forEach(service => {
  let src = "";
  if(service.rol === "gratis"){
    if(service.categories.length === 0){
      src = "./assets/img/user_profile.webp";
    } else {
      src = "./assets/img/category_"+service.categories[0].id+".webp";
    }
  } else {
    src = "./archivos/user_"+service.user_login+"/"+service.servicio_imagen;
  }

  const serviceCard = `<div class="servicio-item ">
            <a href="./userProfile.php?idServicio=${service.idServicio}">
                <div class="d-flex">
                    <img src="${src}" class="servicio-img flex-shrink-0" alt="IMG_PROFILE ">
                    <div>
                        <h3>${service.servicio_nombre}</h3>
                        <h4>${service.user_nombre}</h4>
                    </div>
                </div>
            </a>
        </div>`;

    resultsContainer.innerHTML += serviceCard;
  });

  updatePagination(currentPage, totalPages);
  
}

// Event listeners
document.getElementById('categorySearch').addEventListener('input', filterCategories);
//document.getElementById('serviceSearch').addEventListener('input', filterServices);

// Initialize the search functionality when the page loads
document.addEventListener('DOMContentLoaded', async () => {
  // Fetch categories and services from your PHP backend
  await fetch('./controller/api/getCategories.php')
    .then(response => response.json())
    .then(data => {
      categories = data;
      populateCategories(categories);
    });

  let services = null;
  await fetch('./controller/api/getServices.php').then(response => response.json())
    .then(data => {
      services = data.servicios;
      currentPage = Number(data.pag);
      totalPages = Number(data.cantPaginas);
    });

  await fetch('./controller/api/getCategoriesServices.php').then(response => response.json())
    .then(categories => {
      
      services.forEach(service => {
        service.categories = categories
          .filter(category => category.FK_idServicio === service.idServicio)
          .map(category => ({ id: category.FK_idCategoria }));
        });
      global_services = services;
      displayServices(services);
    });
  

  // Prevent dropdown from closing when clicking inside
  document.getElementById('categoryDropdown').addEventListener('click', (e) => {
    e.stopPropagation();
  });
});

function updatePagination(currentPage, totalPages) {
  const paginacionServicio = document.getElementById('pagUl');
  paginacionServicio.innerHTML = '';
  
  // Always show first page
  addPageItem(1, currentPage, paginacionServicio);

  // Calculate range of pages to show
  let startPage = Math.max(2, currentPage - 2);
  let endPage = Math.min(totalPages - 1, currentPage + 2);

  // Add ellipsis after first page if needed
  if (startPage > 2) {
    addEllipsis(paginacionServicio);
  }

  // Add pages in the middle
  for (let i = startPage; i <= endPage; i++) {
    addPageItem(i, currentPage, paginacionServicio);
  }

  // Add ellipsis before last page if needed
  if (endPage < totalPages - 1) {
    addEllipsis(paginacionServicio);
  }

  // Always show last page if there is more than one page
  if (totalPages > 1) {
    addPageItem(totalPages, currentPage, paginacionServicio);
  }
}

function addPageItem(pageNumber, currentPage, container) {
  const li = document.createElement('li');
  li.className = `page-item ${currentPage === pageNumber ? 'active' : ''}`;
  li.innerHTML = `<span class="page-link" onclick="filterServices(${pageNumber})">${pageNumber}</span>`;
  container.appendChild(li);
}

function addEllipsis(container) {
  const li = document.createElement('li');
  li.className = 'page-item disabled';
  li.innerHTML = '<span class="page-link">...</span>';
  container.appendChild(li);
}
</script>

</body>

</html>