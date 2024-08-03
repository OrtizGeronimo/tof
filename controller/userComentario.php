
<?php

if ((!empty($_POST['name'])) && (!empty($_POST['email'])) && (!empty($_POST['comment'])) && (!empty($_POST['servicio']))) {

    $nombre = $_POST['name'];
    $email = $_POST['email']; 
    $comment = $_POST['comment'];
    $servicio = $_POST['servicio'];
    $bandera = false;
    
    require('../models/comentarioServicio.php');
    $comentarios = Comentario::getComentario($servicio);        

    while($row=mysqli_fetch_array($comentarios)) {
            
        if ($email == $row['user_email']) {

            $bandera = true;
            echo "usuario repetido";
                
        }
            
    }

    if ($bandera == false) {

        if (Comentario::agregarComentario($comment,$servicio,$nombre,$email) == true) {

            $comentarios = Comentario::getComentario($servicio);        

            while($row=mysqli_fetch_array($comentarios)) {
                    
                ?><div id="comment-1" class="comment">
                    <div class="d-flex">
                        <div class="comment-img"><img src="assets/img/logos/negroFondoAmarillo.png" alt=""></div>
                        <div>
                            <h5><a><?php echo $row['user_nombre'] ?></a></h5>
                            <time datetime="2020-01-01"><?php echo $row['fec_alta'] ?></time>
                            <p><?php echo $row['comentario'] ?></p>
                        </div>
                    </div>
                </div><?php
                    
            }

        }

    }    

}

?>