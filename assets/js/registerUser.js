const form = document.querySelector("#form-checkout");
form.addEventListener("submit",()=>{
    if(!passwordValid()){
    document.querySelector("#newPassword").style.backgroundColor = "pink";
    document.querySelector("#renewPassword").style.backgroundColor = "pink";
    alertSwal('error','Las contraseñas ingresadas no son iguales');
    }
})

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

    event.preventDefault(); // Prevenir el envío inmediato del formulario
    let email = document.getElementById('email').value;
    console.log(email);

    // Realizamos la solicitud para enviar el código
    fetch('./controller/validarMail.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `email=${email}`
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.success);
        if (data.success) {

            // Guardamos el código recibido en una variable local
            let codigoEnviado = data.codigo;

            // Mostramos el Swal para que el usuario ingrese el código
            Swal.fire({
                title: 'Verifica tu correo',
                text: 'Por favor ingresa el código que te hemos enviado.',
                input: 'text',
                showCancelButton: true,
                confirmButtonColor: '#F2C94C',
                cancelButtonColor: '#F2C94C',
                confirmButtonText: 'Verificar',
                cancelButtonText: 'Cancelar',
                preConfirm: (codigoIngresado) => {   
                    console.log(codigoIngresado + " " + codigoEnviado);                   
                    if (codigoIngresado == codigoEnviado) {
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Listo!',
                            text: 'El mail se verificó correctamente.',
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {                    
                            $.ajax({
                            type: "POST",
                            url: "./controller/registerUser.php",
                            data: dataForm,
                            processData: false,
                            contentType: false,
                            dataType: "json",
                            success: function(result) {
                                console.log(result);
                                if(result.status === 'success'){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Bienvenido!',
                                    text: 'Te suscribiste correctamente.',
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.replace('./admin/newService.php');
                                });
                                }else{
                                alertSwal('error', result.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                alertSwal('error',`${status} : ${error}`);
                                // Realiza acciones adicionales en caso de error
                            }
                            });
                        });
                    }else{
                        Swal.showValidationMessage('El código no es correcto');
                    }
                }
            });
        } else {
            Swal.fire('Error', 'Hubo un problema al enviar el código', 'error');
        }
    })
    .catch(error => {
        Swal.fire('Error', 'Ocurrió un error al enviar el código', 'error');
    });  
    }
}); 