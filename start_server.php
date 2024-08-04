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

sleep(10);

// Redirige a la página principal
header('location: /');
?>