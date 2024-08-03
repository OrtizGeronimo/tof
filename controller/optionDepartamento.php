<?php  

    if (!empty($_POST['value'])) {

        require('../models/departamento.php');
        $idProvincia = $_POST['value'];
        $idDepartamento = (isset($_POST['idDepartamento']))?$_POST['idDepartamento'] : null;

        $departamentos = Departamento::getDepartamento($idProvincia);

        ?> <option value = "">Abre este menú de selección</option> <?php

        while($row=mysqli_fetch_array($departamentos)) {                         
            if($row['idDepartamento'] == $idDepartamento){
                echo '<option value="'.$row['idDepartamento'].'" selected>'.$row['Departamento'].'</option>';
            }else{
                echo '<option value="'.$row['idDepartamento'].'">'.$row['Departamento'].'</option>';
            }
        }

    } else {
        ?> <option selected>Abre este menú de selección</option> <?php
    }
                          
?>