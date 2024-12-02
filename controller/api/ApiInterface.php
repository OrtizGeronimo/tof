<?php

class ApiInterface {
    public static function formulateResponse ($query){
        $response = null;
        while ($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
            $response[] = $row; 
        }
        return $response;
    
    }
}

?>