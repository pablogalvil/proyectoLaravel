// Importar Howler.js
import { Howl, Howler } from 'howler';

// Escuchar el evento click en los botones de reproducción
document.querySelectorAll('.play-podcast').forEach(function(button) {
    button.addEventListener('click', function() {
        // Obtiene el ID del podcast asociado al botón. Este ID está almacenado en el atributo data-podcast-id del botón
        const podcastId = this.getAttribute('data-podcast-id');
        // Muestra la URL del audio en la consola para asegurarse de que se obtuvo correctamente.
        console.log('ID del podcast:', podcastId);

        // Obtiene la URL del audio del episodio desde la ruta
        fetch(`/episodios/${podcastId}`)
            .then(response => response.json())
            .then(data => {
                // Verifica si la URL del audio es correcta
                console.log('URL del audio:', data.audio_url); 

                if (data.audio_url) {
                    // Reproduce el podcast usando Howler.js
                    const podcastPlayer = new Howl({
                        src: [data.audio_url],
                        // Para cargar el audio de manera más eficiente en dispositivos móviles
                        html5: true,  
                        // Funciones de callback 
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
