
const passwordValid = () =>{
  const newPassword   = document.querySelector("#newPassword").value;
  const renewPassword = document.querySelector("#renewPassword").value;

  return newPassword === renewPassword;
}

const inputIsNotNull = (selector) =>{
    const inputText = document.querySelectorAll(`${selector} input[type=text]`);
    const inputPassword = document.querySelectorAll(`${selector} input[type=password]`);
    const inputs = [...inputText, ...inputPassword];
    let inputIsNotNull = true;
    inputs.forEach(input => {
        
        if(input.value === null || input.value === ""){
            inputIsNotNull = false;
        }
    });
    
    return inputIsNotNull;
}

const validationInputsRegister = () => {
    
    const form = document.querySelector("#registerUser");
    
    document.querySelector("#btn_crearCuenta").addEventListener('click',() => {

      let isCamposLlenos = true;

      for (let i = 0; i < form.elements.length; i++) {
        let element = form.elements[i];
        if (element.value === '') {
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
  
        $.ajax({
          type: "POST",
          url: "./controller/registerUser.php",
          data: dataForm,
          processData: false,
          contentType: false,
          success: function(result) {
            if(result === '1'){
              alertSwal('success',result);
              location.replace('./admin/newService.php');
            }else{
              alertSwal('error',result);
            }
          },
          error: function(xhr, status, error) {
            alertSwal('error',`${status} : ${error}`);
            // Realiza acciones adicionales en caso de error
          }
        });
      }
    });
}

const usuarioExiste = () => {
    let email = document.querySelector('#email');
    if(email.value == "" ){
        email.style.backgroundColor = "pink";
        alertSwal('error','Debe ingresar un email para recuperar la contraseña');
    }else{
        email.style.backgroundColor = null;
        alertSwal('success','Aguarde un momento.....');
        $.ajax({
          type: "POST",
          url: "./controller/recuperarContrasenia.php",
          data: {"email" : email.value},
          success: function (result){
            if(result === 'Se envio un correo para recuperar la contraseña. Por favor revise su casilla de mensajes.'){
              alertSwal('success',result);
              setTimeout(() =>{
                location.replace('./index.php');
              },5000);
              
            }else{
              alertSwal('error',result);
            }
            
          },
          error: function (result){
            console.log("Error");
            console.log(result);
          }
        })
    }

}

const reestablecerContraseña = () => {
  let forgot_password = document.querySelector("#forgotpassword").value;
  let newPassword = document.querySelector("#newPassword")
  let renewPassword = document.querySelector("#renewPassword")

  if(!passwordValid()){
    newPassword.style.backgroundColor = "pink";
    renewPassword.style.backgroundColor = "pink";
    alertSwal('error','Las contraseñas ingresadas no son iguales');
    return false;
  }else{
    $.ajax({
      type: "POST",
      url: "./controller/reestablecerCotrasenia.php",
      data: {
        "forgotPassword" : forgot_password,
        "newPassword" : newPassword.value
      },
      success: function (result){
        if(result === 'Se reestablecio la contraseña correctamente'){
          alertSwal('success',result);
          setTimeout(() =>{
            location.replace('./login.php');
          },5000);
        }else{
          console.log(result);
          alertSwal('error',result);
        }
      },
      error: function (result){
        console.log("Error");
        console.log(result);
      }
    })
  }
}