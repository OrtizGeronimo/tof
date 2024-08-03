const templateGaleriaImg = document.getElementById("templateGaleriaImg");
const containerImg = document.getElementById("containerImg");
const btnSubirImgLogo = document.getElementById("btnSubirImgLogo");
const btnSubirImgBanner = document.getElementById("btnSubirImgBanner");
const imgLogo = document.getElementById("imgLogo");
const imgBanner = document.getElementById("imgBanner");
const containerInputImgGaleria = document.getElementById("containerInputImgGaleria");
const templateInputImgGaleria = document.getElementById("templateInputImgGaleria");
var contadorImgGaleria = 0;

try {
  const CloneTemplateInputImgGaleria = templateInputImgGaleria.content.cloneNode(true);
  CloneTemplateInputImgGaleria.getElementById("btnSubirImg").name = "btnSubirImg" + contadorImgGaleria;
  CloneTemplateInputImgGaleria.getElementById("btnSubirImg").id = "btnSubirImg" + contadorImgGaleria;
  containerInputImgGaleria.appendChild(CloneTemplateInputImgGaleria);
  
  pGaleria.style.display = "none";
  
} catch (error) {
  console.log(`try catch error: ${error}`)
}

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
        containerInputImgGaleria.appendChild(CloneTemplateInputImgGaleria);
        
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