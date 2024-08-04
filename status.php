<?php
error_reporting(E_ALL & ~E_WARNING);
include('config.php');
$url = 'https://api.mcsrvstat.us/3/'.$ip; // Reemplaza con la URL real de la API

// Realizar la solicitud GET a la API
$response = file_get_contents($url);

// Verificar si la solicitud fue exitosa
if ($response === FALSE) {
    die('Error al realizar la solicitud a la API');
}

// Decodificar la respuesta JSON
$data = json_decode($response, true);
$online = $data["debug"]["ping"];
$version = $data["version"];
$players_connected = $data["players"]["online"];
$players_max = $data["players"]["max"];
?>

<?php if($online){?>
    <div id="status" class="w-full text-2xl font-bold text-center">
        <p class="w-full text-green-500">🟢 Online</p>
        <p>Version: <?php echo $version; ?></p>
        <p>Players: <?php echo $players_connected,"/",$players_max; ?></p>
        <form action="stop_server.php" method="post" class="w-full mt-10">
            <button type="submit" class="w-full py-3 px-5 text-xl rounded-2xl font-bold bg-red-500">Detener Servidor</button>
        </form>
    </div>
<?php }else{ ?>
    <div id="status" class="w-full text-red-500 flex justify-center text-2xl font-bold">
        <p>🔴 Offline</p>
    </div>
<?php } ?>