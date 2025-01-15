
const provincia = document.getElementById("provincia");

function getProvincia(){
  try {
    let optionProvincia = document.getElementById("provincia").value; 
    let FK_idDepartamento = (document.getElementById("FK_idDepartamento"))?document.getElementById("FK_idDepartamento").value  : '';
    let dataString = `value=${optionProvincia}`;
    (FK_idDepartamento!=null)? dataString += `&idDepartamento=${FK_idDepartamento}` : '';
    $.ajax({
      url: "../controller/optionDepartamento.php",
      type: "post",
      dataType: 'html',
      data: dataString,
      success: function (responseText) {
          $(".departamento").html(responseText);
      }
      
    });  
  } catch (error) {
    console.log("empty departamento");
  }
  
}


provincia.addEventListener("change", () => {
  getProvincia();     
});
  