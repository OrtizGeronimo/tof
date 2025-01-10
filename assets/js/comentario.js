const btnAñadirComentario = document.getElementById("btnAñadirComentario");
const starRating = document.querySelector('.reply-form .star-rating');
let currentRating = 0;

// Star rating functionality
starRating.addEventListener('click', (e) => {
  if (e.target.matches('i')) {
    const rating = parseInt(e.target.getAttribute('data-rating'));
    currentRating = rating;
    updateStars(rating);
    console.log("currentRating", currentRating);
  }
});

function updateStars(rating) {
  const stars = starRating.querySelectorAll('i');
  stars.forEach((star) => {
    const starRating = parseInt(star.getAttribute('data-rating'));
    if (starRating <= rating) {
      star.classList.remove('far');
      star.classList.add('fas');
    } else {
      star.classList.remove('fas');
      star.classList.add('far');
    }
  });
}

btnAñadirComentario.addEventListener("click", () => {
  
  var name = document.getElementById("name").value; 
  var email = document.getElementById("email").value; 
  var comment = document.getElementById("comment").value; 
  var servicio = document.querySelector("#idServicio").value; 

  if (!name) {
    Swal.fire({
      title: 'Debe indicar el nombre',
      icon: 'warning',
      confirmButtonText: 'OK'
    });
    return;
  }

  if (!email) {
    Swal.fire({
      title: 'Debe indicar el email',
      icon: 'warning',
      confirmButtonText: 'OK'
    });
    return;
  }

  if (!comment) {
    Swal.fire({
      title: 'Debe indicar el comentario',
      icon: 'warning',
      confirmButtonText: 'OK'
    });
    return;
  }

  if (currentRating === 0) {
    Swal.fire({
      title: 'Debe indicar la calificación',
      icon: 'warning',
      confirmButtonText: 'OK'
    });
    return;
  }

  $.ajax({
    url: "controller/userComentario.php",
    type: "post",
    dataType: 'html',
    data: {'name':name, 'email':email, 'comment':comment, 'servicio':servicio, 'rating': currentRating},
    success: function (response) {
        $(".contenedorComentarios").html(response);
    }
  });

  document.getElementById("name").value = ""; 
  document.getElementById("email").value = ""; 
  document.getElementById("comment").value = ""; 
  currentRating = 0;
  updateStars(0);
  Swal.fire({
    title: 'Tu comentario fue publicado, gracias!',
    icon: 'success',
    confirmButtonText: 'OK'
  }).then(() => {
    location.reload();
  });
});

document.addEventListener('DOMContentLoaded', function() {
  const commentTextarea = document.getElementById('comment');
  const charCountDisplay = document.getElementById('charCount');
  const maxLength = 240;

  function updateCharCount() {
    const remainingChars = maxLength - commentTextarea.value.length;
    charCountDisplay.textContent = `${remainingChars} caracteres restantes`;
    
    if (remainingChars <= 20) {
      charCountDisplay.classList.add('char-count-warning');
    } else {
      charCountDisplay.classList.remove('char-count-warning');
    }
  }

  commentTextarea.addEventListener('input', updateCharCount);
  updateCharCount(); // Initial call to set the correct count on page load
});

document.addEventListener('DOMContentLoaded', function() {
  const toggleButton = document.getElementById('toggleComments');
  const hiddenComments = document.querySelectorAll('.hidden-comment');

  if (toggleButton) {
      toggleButton.addEventListener('click', function() {
          hiddenComments.forEach(comment => {
              if (comment.classList.contains('hidden-comment')) {
                  comment.style.display = 'none';
                  setTimeout(() => {
                      comment.classList.remove('hidden-comment');
                      comment.style.display = '';
                  }, 10);
              } else {
                  comment.classList.add('hidden-comment');
              }
          });

          if (toggleButton.textContent === 'Ver más') {
              toggleButton.textContent = 'Ver menos';
          } else {
              toggleButton.textContent = 'Ver más';
          }
      });
  }
});