<style>
    /* Estilos para el loader */
#loader {
margin-top: 180px;
left: 0;
top: 0;
width: 100%!important;
height: 100%!important;
background-color: white;
z-index: 9999;
display: flex;
align-items: center;
justify-content: center;
}


</style>

<script>
    // Esperar 4 segundos antes de mostrar el contenido
    window.addEventListener('load', function() {
        setTimeout(function() {
            document.getElementById('loader').style.display = 'none'; // Oculta el loader
            document.getElementById('content').style.display = 'block'; // Muestra el contenido
        }, 500); // 4000 ms = 4 segundos
    });
</script>
 <div id="loader">
    <!-- Loader visual (puede ser una imagen, un GIF o simplemente un círculo animado) -->
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script> 

<dotlottie-player src="https://lottie.host/dffcb98a-f76c-4900-ba60-8afb8a4f9e30/c0TOQwygaZ.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay></dotlottie-player>
</div>