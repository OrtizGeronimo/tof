
function validacionInicioSesionYusuario(){
    var user = document.getElementById("username").value;
    var pass = document.getElementById("password").value;

    if(user=="" || user==null){
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Complete el campo usuario!',
            showCancelButton: true,
            cancelButtonText: '<i class="fa fa-thumbs-up"></i> Entendido!',
            showConfirmButton: false

        });
        $('#username').focus();
        return false;
    }

    else if(pass=="" || pass==null){
        Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: 'Complete el campo contraseña!',
            showCancelButton: true,
            cancelButtonText: '<i class="fa fa-thumbs-up"></i> Entendido!',
            showConfirmButton: false
        });
        $('#password').focus();
        return false;
    }
    
    else{
        $.ajax({
            url:"./validacionLogin.php",
            type: "POST",
            datatype: "json",
            data: {"user":user, "pass":pass},
            success: function(data){
                console.log(data);
                if(data == "null" || data == null){
                    Swal.fire({
                        icon: 'error',
                        title: 'Datos incorrectos',
                        text: 'Usuario o contraseña incorrectos.',
                        showCancelButton: true,
                        cancelButtonText: '<i class="fa fa-thumbs-up"></i> Aceptar',
                        showConfirmButton: false
                    });
                }else{
                    console.log(data)
                    Swal.fire({
                        icon: 'success',
                        title: 'Bienvenido!',
                        text: 'Redirigiendo a la página principal...',
                        showCancelButton: false,
                        timer: 2000,
                        showConfirmButton: false
                    }).then((result) => {
                        
                        window.location.href = "index.php";
                        
                    });
                }
            }
        });
    }
}