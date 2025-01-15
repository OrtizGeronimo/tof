const templateGaleriaImg = document.getElementById("templateGaleriaImg");
const containerImg = document.getElementById("containerImg");
const btnSubirImgLogo = document.getElementById("btnSubirImgLogo");
const btnSubirImgBanner = document.getElementById("btnSubirImgBanner");
const imgLogo = document.getElementById("imgLogo");
const imgBanner = document.getElementById("imgBanner");
//const containerInputImgGaleria = document.getElementById("containerInputImgGaleria");
const templateInputImgGaleria = document.getElementById("templateInputImgGaleria");
const btnSubirImgGaleria = document.getElementById("btnSubirImgGaleria");
const imgPreviewContainer = document.getElementById("imgPreviewContainer");
const showMoreBtn = document.getElementById("showMoreBtn");
var contadorImgGaleria = 0;

/*try {
  const CloneTemplateInputImgGaleria = templateInputImgGaleria.content.cloneNode(true);
  CloneTemplateInputImgGaleria.getElementById("btnSubirImg").name = "btnSubirImg" + contadorImgGaleria;
  CloneTemplateInputImgGaleria.getElementById("btnSubirImg").id = "btnSubirImg" + contadorImgGaleria;
  //containerInputImgGaleria.appendChild(CloneTemplateInputImgGaleria);
  
  pGaleria.style.display = "none";
  
} catch (error) {
  console.log(`try catch error: ${error}`)
}*/

function inputSubirImg (myid) {
  try {
    const btnSubirImg = document.getElementById(myid);
  
    btnSubirImg.addEventListener("change", () => {
  
      if (contadorImgGaleria < 2) {
        const CloneTemplate = templateGaleriaImg.content.cloneNode(true);
        const archivos = btnSubirImg.files;
  
        if (!archivos || !archivos.length) {
            CloneTemplate.getElementById("imagenPrevisualizacion").src = "";
          return;
        }
  
        const primerArchivo = archivos[0];
        const objectURL = URL.createObjectURL(primerArchivo);
  
        CloneTemplate.getElementById("imagenPrevisualizacion").src = objectURL;
        CloneTemplate.getElementById("contImagenPrevisualizacion").id = "contImagenPrevisualizacion" + contadorImgGaleria;
        CloneTemplate.getElementById("imagenPrevisualizacion").id = "imagenPrevisualizacion" + contadorImgGaleria;
        CloneTemplate.getElementById("btnImagenPrevisualizacion").id = contadorImgGaleria;
        containerImg.appendChild(CloneTemplate);
        contadorImgGaleria++;
  
        btnSubirImg.style.display = "none";
  
        const CloneTemplateInputImgGaleria = templateInputImgGaleria.content.cloneNode(true);
        CloneTemplateInputImgGaleria.getElementById("btnSubirImg").name = "btnSubirImg" + contadorImgGaleria;
        CloneTemplateInputImgGaleria.getElementById("btnSubirImg").id = "btnSubirImg" + contadorImgGaleria;
        //containerInputImgGaleria.appendChild(CloneTemplateInputImgGaleria);
        
      } 
      
      if (contadorImgGaleria == 2) {
  
        const pGaleria = document.getElementById("pGaleria");
        pGaleria.style.display = "flex";
        document.getElementById("btnSubirImg2").style.display = "none";
      }
      
    });
  } catch (error) {
    console.log(`try catch error: ${error}`)
  }

}

try {
  btnSubirImgLogo.addEventListener("change", () => {
  
      const archivos = btnSubirImgLogo.files;
  
      if (!archivos || !archivos.length) {
          imgLogo.src = "";
        return;
      }
  
      const primerArchivo = archivos[0];
      const objectURL = URL.createObjectURL(primerArchivo);
  
      imgLogo.src = objectURL;
  
  });
  
} catch (error) {
  console.log(`try catch error: ${error}`)
}

try {
  btnSubirImgBanner.addEventListener("change", () => {
  
      const archivos = btnSubirImgBanner.files;
  
      if (!archivos || !archivos.length) {
          imgBanner.src = "";
        return;
      }
  
      const primerArchivo = archivos[0];
      const objectURL = URL.createObjectURL(primerArchivo);
  
      imgBanner.src = objectURL;
  
  });
} catch (error) {
  console.log(`try catch error: ${error}`)
}


document.addEventListener("DOMContentLoaded", function() {
  const imgPreviewContainer = document.getElementById("imgPreviewContainer");

  
  //console.log("userRole", userRole);
  const maxImagesAllowed = userRole == 6 ? 1 : (userRole == 4 ? 3 : 'Infinity');

  let i = 0;
  let dt = new DataTransfer();

  imgPreviewContainer.addEventListener("click", function(e) {
    if (e.target.classList.contains("remove-img")) {
      const imgWrapper = e.target.closest(".img-wrapper");
      console.log("removing imgWrapper", imgWrapper);

      const fileIndex = e.target.getAttribute('data-file-index');
      console.log("File Index:", fileIndex);
      dt = removeFileFromInput(fileIndex);
      if (dt.files.length === 0) {
        i = 0;
      }
      //dt.files = dtRemoved.files;
      imgWrapper.remove(); // Removes the image wrapper div from the DOM
    }
  });

 
  try {
    btnSubirImgGaleria.addEventListener("change", () => {
      
      const archivos = btnSubirImgGaleria.files;

      //const newFilesArray = Array.from(btnSubirImgGaleria.files);

      //files = files === null ? newFilesArray : files.concat(newFilesArray);

      const existingImagesCount = imgPreviewContainer.querySelectorAll('.img-wrapper').length;
      //imgPreviewContainer.innerHTML = '';
      
      if (!archivos || !archivos.length) {
        return;
      }
      const totalImages = existingImagesCount + archivos.length;
      if (totalImages > maxImagesAllowed) {

        Swal.fire({
          title: 'Desea cambiar su plan?',
          text: `Solo puedes subir ${maxImagesAllowed} `+ (maxImagesAllowed === 1 ? 'imagen' : 'imagenes con su plan actual.'),
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
              btnSubirImgGaleria.value = ""; // Clear the file input
              return;
            }
        });
        
        btnSubirImgGaleria.value = ""; // Clear the file input
          return;
      }
      
      console.log("data transfer object antes de subir los archivos ", Array.from(dt.files));

      for (const archivo of archivos) {
        
        const objectURL = URL.createObjectURL(archivo);
        console.log("creando imgElement");
        const imgElement = document.createElement("img");
        imgElement.src = objectURL;
        imgElement.classList.add("img-fluid");
        imgElement.style.margin = "10px";
        imgElement.style.maxWidth = "200px"; 
        
        const divElement = document.createElement("div");
        divElement.classList.add("img-wrapper");
        divElement.style.position = "relative";
        divElement.style.display = "inline-block";
        divElement.style.margin = "10px";
  
        const removeImgSpan = document.createElement("span");
        removeImgSpan.classList.add("remove-img");
        removeImgSpan.style.position = "absolute";
        removeImgSpan.style.top = "-1px";
        removeImgSpan.style.right = "-1px";
        removeImgSpan.style.cursor = "pointer";
        removeImgSpan.style.fontSize = "18px";
        removeImgSpan.style.color = "red";
        console.log('Setting data-file-index:', i, 'for file:', archivo.name);
  
        removeImgSpan.setAttribute('data-file-index', i);
        removeImgSpan.innerHTML = "&times;";
        
  
  
        /*const hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "existingImgGaleria[]";
        hiddenInput.value = "<?= $img['img']; ?>";
  
        divElement.appendChild(hiddenInput);
  */
        divElement.appendChild(removeImgSpan);
        divElement.appendChild(imgElement);
  
        imgPreviewContainer.appendChild(divElement);
        i++;

        dt.items.add(archivo);
        

      }
  
      btnSubirImgGaleria.files = dt.files;
      console.log("btnSubirImgGaleria.files after adding: ", Array.from(btnSubirImgGaleria.files));
    });
  
    } catch (error) {
    console.log(`try catch error: ${error}`)
  }

});

function removeFileFromInput(index) {
  const dtRemoved = new DataTransfer();

  // Add all files except the one at the given index
  [...btnSubirImgGaleria.files].forEach((file, i) => {
    if (i !== parseInt(index)) {
      dtRemoved.items.add(file);
    }
  });

  // Update the file input with the new file list
  btnSubirImgGaleria.files = dtRemoved.files;

  console.log("btnSubirImgGaleria.files after removing: ", Array.from(btnSubirImgGaleria.files));

  return dtRemoved;
}


function BorrarImagenPrevisualizacion (myid) {

  document.getElementById("imagenPrevisualizacion" + myid).remove();
  document.getElementById(myid).remove();
  document.getElementById("contImagenPrevisualizacion" + myid).remove();
  document.getElementById("btnSubirImg" + myid).remove();

  var number = parseInt(myid);
  number++;

  for (var i = 0; i <= contadorImgGaleria; i++) {

      if (document.getElementById("imagenPrevisualizacion" + number)) {
          document.getElementById("imagenPrevisualizacion" + number).id = "imagenPrevisualizacion" + (number-1);
          document.getElementById(number).id = (number-1);
          document.getElementById("contImagenPrevisualizacion" + number).id = "contImagenPrevisualizacion" + (number-1);
         
          document.getElementById("btnSubirImg" + number).name = "btnSubirImg" + (number-1);
          document.getElementById("btnSubirImg" + number).id = "btnSubirImg" + (number-1);
          number++;
      } else {
          document.getElementById("btnSubirImg" + number).name = "btnSubirImg" + (number-1);
          document.getElementById("btnSubirImg" + number).id = "btnSubirImg" + (number-1);
          break;
      }
  }

  contadorImgGaleria--;

  if (contadorImgGaleria == 1) {

    const pGaleria = document.getElementById("pGaleria");
    pGaleria.style.display = "none";
    document.getElementById("btnSubirImg1").style.display = "flex";

  }

}