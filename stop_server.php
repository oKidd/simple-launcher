<?php
// Ruta al directorio del servidor de Minecraft
$stopCommand = 'taskkill /F /IM java.exe';

// Envía el comando para detener el servidor
exec($stopCommand);

// Redirige a la página principal o muestra un mensaje
header('Location: /'); // Redirige a la página principal
?>