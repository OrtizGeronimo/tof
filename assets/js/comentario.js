const btnAñadirComentario = document.getElementById("btnAñadirComentario");

btnAñadirComentario.addEventListener("click", () => {

  var name = document.getElementById("name").value; 
  var email = document.getElementById("email").value; 
  var comment = document.getElementById("comment").value; 
  var servicio = document.querySelector("#idServicio").value; 

  $.ajax({
    url: "controller/userComentario.php",
    type: "post",
    dataType: 'html',
    data: {'name':name, 'email':email, 'comment':comment, 'servicio':servicio},
    success: function (response) {
        $(".contenedorComentarios").html(response);
    }
    
  });

  document.getElementById("name").value = ""; 
  document.getElementById("email").value = ""; 
  document.getElementById("comment").value = ""; 
});
