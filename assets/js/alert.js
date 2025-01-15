function alertSwal(icon,message){
    Swal.fire({
        icon: icon,
        title: message,
        showConfirmButton: false,
        timer: 5000
    })
}

function deleteSwal(message,url){
    Swal.fire({
        title: message,
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if(result.isConfirmed)
            window.location.href = url;
      })
}