<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subscriber;
use App\Models\Template;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Création de 100 abonnés fictifs
        Subscriber::factory()->count(100)->create();

        // Création de 5 templates de newsletter
        Template::factory()->create([
            'title' => 'Bienvenue à la newsletter',
            'content' => '<h1>Bienvenue !</h1><p>Merci de vous être inscrit à notre newsletter.</p>'
        ]);
        Template::factory()->create([
            'title' => 'Offre spéciale',
            'content' => '<h2>Offre du mois</h2><p>Profitez de notre offre exclusive !</p>'
        ]);
        Template::factory()->create([
            'title' => 'Nouveautés',
            'content' => '<h2>Découvrez nos nouveautés</h2><p>De nouveaux produits sont disponibles.</p>'
        ]);
        Template::factory()->create([
            'title' => 'Événement à venir',
            'content' => '<h2>Participez à notre événement</h2><p>Inscrivez-vous dès maintenant !</p>'
        ]);
        Template::factory()->create([
            'title' => 'Merci pour votre fidélité',
            'content' => '<h2>Merci !</h2><p>Nous apprécions votre fidélité.</p>'
        ]);
    }
}
