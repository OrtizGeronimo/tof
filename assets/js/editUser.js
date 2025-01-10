const form = document.querySelector("#form-checkout");
    if(document.querySelector("#newPassword").value == "" && document.querySelector("#renewPassword").value == ""){
      form.addEventListener("submit",()=>{
        if(!passwordValid()){
          document.querySelector("#newPassword").style.backgroundColor = "pink";
          document.querySelector("#renewPassword").style.backgroundColor = "pink";
          alertSwal('error','Las contraseñas ingresadas no son iguales');
        }
      })
    }

    document.querySelector("#btn_crearCuenta").addEventListener('click',() => {

    let isCamposLlenos = true;

    for (let i = 0; i < form.elements.length; i++) {
      let element = form.elements[i];
      if (element.value === '' && element.hasAttribute('required')) {
        isCamposLlenos = false;
        break;
      }
    }
    if(!isCamposLlenos){
      alertSwal('error',"Complete los campos del formulario");
    }else if(!passwordValid()){
      document.querySelector("#newPassword").style.backgroundColor = "pink";
      document.querySelector("#renewPassword").style.backgroundColor = "pink";
      alertSwal('error','Las contraseñas ingresadas no son iguales');
    }else{
      let dataForm = new FormData(form);
      //console.table(Array.from(dataForm.entries()));
      $.ajax({
        type: "POST",
        url: "./controller/editUser.php",
        data: dataForm,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(result) {
          console.log(result);
          if(result.status === 'success'){
            Swal.fire({
                icon: 'success',
                text: 'Se actualizó el perfil correctamente.',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.replace('./editUser.php?idUsuario=' + result.idUsuario);
            });
          }else{     
            console.log(result);                   
            alertSwal('error', result.message);
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr);
          console.log(status);
          console.log(error);
          alertSwal('error',`${status} : ${error}`);
          // Realiza acciones adicionales en caso de error
        }
      });
    }
    }); 