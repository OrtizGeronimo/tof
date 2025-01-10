
<?php
include_once('../models/servicio.php');
if ((!empty($_POST['name'])) && (!empty($_POST['email'])) && (!empty($_POST['comment'])) && (!empty($_POST['servicio']))) {

    $nombre = $_POST['name'];
    $email = $_POST['email']; 
    $comment = $_POST['comment'];
    $servicio = $_POST['servicio'];
    $puntaje = $_POST['rating'];
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

        if (Comentario::agregarComentario($comment,$servicio,$nombre,$email, $puntaje) == true) {
            Servicio::calcularPuntaje($servicio);
            $comentarios = Comentario::getComentario($servicio);        

            while($row=mysqli_fetch_array($comentarios)) {
                    
                ?>
                <div id="comment-<?php echo $row['id']; ?>" class="comment">
                    <div class="d-flex">
                        <div class="comment-img"><img src="assets/img/logos/negroFondoAmarillo.png" alt=""></div>
                        <div>
                            <h5><a><?php echo $row['user_nombre'] ?></a></h5>
                            <time datetime="<?php echo $row['fec_alta'] ?>"><?php echo $row['fec_alta'] ?></time>
                            <div class="star-rating">
                                <?php
                                for($i = 1; $i <= (5 -  $row['puntaje']); $i++) {
                                    echo '<i class="far fa-star" aria-hidden="true"></i>';
                                }
                                for($i = 1; $i <= $row['puntaje']; $i++) {
                                    echo '<i class="fas fa-star" aria-hidden="true"></i>';
                                }
                                ?>
                            </div>
                            <p><?php echo $row['comentario'] ?></p>
                        </div>
                    </div>
                </div>
                <?php
                    
            }

        }

    }    

}

?>