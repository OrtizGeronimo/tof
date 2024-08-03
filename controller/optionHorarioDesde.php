
<?php  

    $contadorHorariosHoras = '00';
    $contadorHorariosMinutos = '00';

    while(($contadorHorariosHoras != 23) || ($contadorHorariosMinutos != 60)) {

        if ($contadorHorariosMinutos == 60) {

            $contadorHorariosMinutos = '00';
            $contadorHorariosHoras++;

            if ($contadorHorariosHoras < 10) {
                $contadorHorariosHoras = '0' .$contadorHorariosHoras;
            }
        } 
                           
        ?> <option value="<?php echo $contadorHorariosHoras .':' .$contadorHorariosMinutos ?>"><?php echo $contadorHorariosHoras .':' .$contadorHorariosMinutos ?></option> <?php
                
        $contadorHorariosMinutos += 15;
                  
    }
                          
?>