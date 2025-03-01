<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\PodcastGenero;
use App\Models\PodcastLista;
use App\Models\PodcastLocutor;
use App\Models\PodcastInvitado;
use App\Models\Locutor;
use App\Models\Equipo;
use App\Models\Podcast;
use App\Models\Genero;
use App\Models\Lista;
use App\Models\Invitado;
use App\Models\LocutorEquipo;
use App\Models\Comentario;
use App\Models\Episodio;
use App\Models\Usuario;


class CreacionDatosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuarios, equipos, géneros, invitados, listas y podcasts 
        Usuario::factory(10)->create();
        Equipo::factory(5)->create();
        Genero::factory(5)->create();
        Invitado::factory(10)->create();
        Lista::factory(10)->create();
        Podcast::factory(15)->create();
        Locutor::factory(10)->create();
        Episodio::factory(20)->create();

        // Relacionar Comentarios con Usuarios y Podcasts 
        Comentario::factory(20)->create()->each(function ($comentario) {
            $usuario = Usuario::inRandomOrder()->first();
            $podcast = Podcast::inRandomOrder()->first();
            $comentario->usuario_id = $usuario->id;
            $comentario->podcast_id = $podcast->id;
            $comentario->save();
        });


        // Relacionar Locutores con Equipos 
        foreach (range(1, 15) as $i) {
            LocutorEquipo::create([
                'locutor_id' => Locutor::inRandomOrder()->first()->id,
                'equipo_id' => Equipo::inRandomOrder()->first()->id,
            ]);
        }
        // Relacionar Podcasts con Géneros 
        foreach (range(1, 15) as $i) {
            PodcastGenero::create([
                'podcast_id' => Podcast::inRandomOrder()->first()->id,
                'genero_id' => Genero::inRandomOrder()->first()->id,
            ]);
        }

        // Relacionar Podcasts con Listas (Tabla Intermedia) 
        foreach (range(1, 15) as $i) {
            PodcastLista::create([
                'podcast_id' => Podcast::inRandomOrder()->first()->id,
                'lista_id' => Lista::inRandomOrder()->first()->id,
            ]);
        }
        // Relacionar Podcasts con Locutores (Tabla Intermedia) 
        foreach (range(1, 15) as $i) {
            PodcastLocutor::create([
                'podcast_id' => Podcast::inRandomOrder()->first()->id,
                'locutor_id' => Locutor::inRandomOrder()->first()->id,
            ]);
        }
        // Relacionar Podcasts con Invitados (Tabla Intermedia) 
        foreach (range(1, 15) as $i) {
            PodcastInvitado::create([
                'podcast_id' => Podcast::inRandomOrder()->first()->id,
                'invitado_id' => Invitado::inRandomOrder()->first()->id,
            ]);
        }
    }
}
