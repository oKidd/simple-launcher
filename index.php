<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-full bg-neutral-900">
    <header class="w-full">
        <nav class="w-full h-20 flex items-center bg-neutral-950 shadow-2xl">
            <div class="w-3/12 h-full flex items-center justify-center gap-x-5">
                <img class="h-3/6" src="https://img.icons8.com/?size=100&id=XfjNd4vkhBBy&format=png">
                <h1 class="text-white text-2xl font-bold">Minecraft Panel</h1>
            </div>
            <div class="w-8/12"></div>
            <div class="w-1/12 h-full flex items-center justify-center gap-x-5">
                <a href="/" class="h-3/6">
                    <img class="h-full" src="https://img.icons8.com/?size=100&id=12371&format=png">
                </a>
            </div>
        </nav>
    </header>
    <main class="w-full flex h-5/6">
        <div class="p-10 w-4/12 flex items-center">
            <div class="w-full p-10 rounded-2xl bg-neutral-950 text-white h-full flex">
                <div class="m-auto">
                    <h1 class="text-3xl font-bold text-center mb-10">External Server Status</h1>
                    <div id="status-container">
                    </div>
                </div>
            </div>
        </div>
        <div class="p-10 w-8/12 h-full">
            <div class="rounded-2xl p-10 bg-neutral-950 text-white h-full">
                <?php
                    // Dirección IP y puerto del servidor de Minecraft
                    $host = '127.0.0.1'; // Cambia esto por la IP del servidor si es diferente
                    $port = 25565;

                    // Intentar abrir una conexión al puerto
                    $connection = @fsockopen($host, $port, $errno, $errstr, 0.1);

                    // Verificar si la conexión fue exitosa
                    if ($connection) {
                        fclose($connection); // Cerrar la conexión
                        echo "<iframe id='console' class='w-full h-full overflow-y-scroll overflow-x-hidden text-white' src='/console.php' frameborder='0'></iframe>";
                    } else {?>
                        <form action="start_server.php" method="post" class="w-full h-full flex justify-center items-center">
                            <button id="iniciar" type="submit" class="w-6/12 p-3 text-2xl rounded-2xl font-bold bg-green-500">Iniciar Servidor</button>
                            <img src="https://mir-s3-cdn-cf.behance.net/project_modules/max_632/04de2e31234507.564a1d23645bf.gif" id="loadingImage" class="hidden">
                        </form>
                    <?php }
                ?>
            </div>
        </div>
    </main>
    <footer class="bg-neutral-950 text-center text-white p-2 bottom-0 fixed w-full font-bold">
        <p>Developed with 💖 By oKidd</p>
    </footer>
</body>
</html>

<script>
    function updateStatus() {
        fetch('status.php')
            .then(response => response.text())
            .then(data => {
                // Actualizar el contenido del contenedor con la nueva información
                document.getElementById('status-container').innerHTML = data;
            })
            .catch(error => console.error('Error al actualizar el estado:', error));
    }

    // Cargar el estado inicial
    updateStatus();

    // Actualizar el estado cada 1 segundo
    setInterval(updateStatus, 1000); // 1000 milisegundos = 1 segundo
</script>

<script>
    document.getElementById('iniciar').addEventListener('click', function() {
        // Reemplaza el botón con la imagen de carga
        document.getElementById('iniciar').style.display = 'none'; // Oculta el botón
        document.getElementById('loadingImage').style.display = 'block'; // Muestra la imagen de carga
    });
</script>