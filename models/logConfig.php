<?php
// Definir la ruta del archivo de log
$logFile = 'C:/xampp/htdocs/Todo Oficio/logs.txt';

// Función para escribir en el log
if (!function_exists('writeLog')) {
    function writeLog($message) {
        global $logFile;
        // Abrir el archivo en modo de escritura (añadir al final)
        if ($file = fopen($logFile, 'a')) {
            // Formatear el mensaje con la fecha y hora
            $logMessage = date('Y-m-d H:i:s') . " - " . $message . "\n";
            // Escribir el mensaje en el archivo
            fwrite($file, $logMessage);
            // Cerrar el archivo
            fclose($file);
        } else {
            echo "No se pudo abrir el archivo de logs.";
        }
    }
}
?>