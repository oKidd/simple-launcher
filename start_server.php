<?php
include('config.php');
// Ruta al archivo .jar del servidor de Minecraft

// Comando para iniciar el servidor
if($console){
    $startCommand = 'java -Xmx'.$ram.' -Xms'.$ram.' -jar ' . escapeshellarg($serverJar);
}else{
    $startCommand = 'java -Xmx'.$ram.' -Xms'.$ram.' -jar ' . escapeshellarg($serverJar) . ' nogui';
}

// Comando completo para ejecutar el servidor en segundo plano
$fullCommand = 'start "" /B ' . $startCommand . ' > NUL 2>&1';

chdir("..");
// Ejecutar el comando sin esperar a que termine
popen($fullCommand, 'r');

function isPortOpen($host, $timeout = 5) {
    $host = '127.0.0.1'; // Cambia esto por la IP del servidor si es diferente
    $port = 25565;

    // Intentar abrir una conexión al puerto
    $connection = @fsockopen($host, $port, $errno, $errstr, 0.1);

    // Verificar si la conexión fue exitosa
    if ($connection) {
        fclose($connection);
        return true;
    }else{
        return false;
    }
}

$startTime = time();

while (!isPortOpen($ip)) {
    if ((time() - $startTime) >= 60) {
        die('Hubo un error, intentalo nuevamente...');
    }
    usleep(100); // Esperar 500 ms antes de reintentar
}

// Redirige a la página principal
header('location: /');
?>