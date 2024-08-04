<script src="https://cdn.tailwindcss.com"></script>
<style>
    .log-content {
        white-space: pre-wrap; /* Mantener los saltos de línea */
        padding: 20px;
        overflow-y: auto;
        overflow-x: hidden; /* Habilitar el scroll vertical */
        height: 100%; /* Ajustar altura según sea necesario */
    }
</style>
<div class='log-content' id='logContent'>
    Cargando...
</div>

<script>
    let isFirstLoad = true; // Variable para verificar si es la primera carga
    let lastScrollHeight = 0; // Variable para almacenar la altura del scroll anterior

    function updateContent() {
        const logContent = document.getElementById('logContent');
        const previousScrollHeight = logContent.scrollHeight; // Altura antes de la actualización

        fetch('update_content.php')
            .then(response => response.text())
            .then(data => {
                logContent.style.color = "white";
                logContent.style.textDecoration = "none";
                logContent.innerHTML = data;

                if (isFirstLoad) {
                    logContent.scrollTop = logContent.scrollHeight; // Desplazar al final solo en la primera carga
                    isFirstLoad = false;
                } else {
                    const newScrollHeight = logContent.scrollHeight;
                    if (newScrollHeight > previousScrollHeight) {
                        logContent.scrollTop += newScrollHeight - previousScrollHeight; // Mantener al usuario en la misma posición relativa
                    }
                }

                lastScrollHeight = logContent.scrollHeight; // Actualizar la altura anterior
            })
            .catch(error => console.error('Error:', error));
    }

    // Cargar contenido inicial
    updateContent();

    // Actualizar contenido cada 5 segundos
    setInterval(updateContent, 100); // 5000 milisegundos = 5 segundos
</script>