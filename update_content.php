<?php
    $logFile = '../logs/latest.log'; // Cambia esta ruta a la ubicación correcta

    // Verificar si el archivo de registro existe
    if (!file_exists($logFile)) {
        die('El archivo de registro no se encontró.');
    }

    // Leer el contenido del archivo de registro
    $logContent = file_get_contents($logFile);
    $logContent = str_replace("\n", "<br>", $logContent);

    // Devolver el contenido
    echo $logContent;
?>