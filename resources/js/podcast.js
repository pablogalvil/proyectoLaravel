// Importar Howler.js
import { Howl, Howler } from 'howler';

// Escuchar el evento click en los botones de reproducción
document.querySelectorAll('.play-podcast').forEach(function(button) {
    button.addEventListener('click', function() {
        const podcastId = this.getAttribute('data-podcast-id');
        console.log('ID del podcast:', podcastId); // Asegurarte de que el ID del podcast es correcto

        // Obtener la URL del audio del episodio desde la ruta
        fetch(`/episodios/${podcastId}`)
            .then(response => response.json())
            .then(data => {
                console.log('URL del audio:', data.audio_url); // Verificar si la URL del audio es correcta

                if (data.audio_url) {
                    // Reproducir el podcast usando Howler.js
                    const podcastPlayer = new Howl({
                        src: [data.audio_url],
                        html5: true,  // Para cargar el audio de manera más eficiente en dispositivos móviles
                        onplay: function() {
                            console.log('Reproducción iniciada');
                        },
                        onend: function() {
                            console.log('Reproducción terminada');
                        }
                    });

                    // Iniciar la reproducción
                    podcastPlayer.play();
                } else {
                    console.error("No se pudo obtener la URL del audio.");
                }
            })
            .catch(error => console.error('Error al obtener el audio:', error));
    });
});
