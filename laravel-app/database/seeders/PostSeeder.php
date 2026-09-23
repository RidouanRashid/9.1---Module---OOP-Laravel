<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Vult de posts-tabel met dummy content, gebaseerd op de
     * "Laravel From Scratch Blog" HTML/CSS-template uit opdracht 1.
     */
    public function run(): void
    {
        $body = <<<'TEXT'
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.

        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.

        Magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.

        Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?
        TEXT;

        $posts = [
            [
                'title' => 'This is a big title and it will look great on two or even three lines. Wooohoo!',
                'image' => 'illustration-1.png',
                'tags' => 'Techniques,Updates',
                'excerpt' => 'Another year. Another update. We\'re refreshing the popular Laravel series with new content.',
            ],
            [
                'title' => 'Routing in Laravel: van URL naar controller',
                'image' => 'illustration-2.png',
                'tags' => 'Techniques',
                'excerpt' => 'Hoe Laravel een binnenkomend request via routes/web.php naar de juiste controller stuurt.',
            ],
            [
                'title' => 'Blade templates: HTML hergebruiken zonder gedoe',
                'image' => 'illustration-3.png',
                'tags' => 'Techniques,Updates',
                'excerpt' => 'Met @extends, @section en components voorkom je dat je dezelfde HTML overal kopieert.',
            ],
            [
                'title' => 'Eloquent models en migrations uitgelegd',
                'image' => 'illustration-4.png',
                'tags' => 'Updates',
                'excerpt' => 'Hoe een migration een databasetabel aanmaakt en een model je daarmee laat praten.',
            ],
            [
                'title' => 'Artisan: de command line tool van Laravel',
                'image' => 'illustration-5.png',
                'tags' => 'Techniques',
                'excerpt' => 'Met php artisan genereer je models, controllers en migrations in één commando.',
            ],
        ];

        foreach ($posts as $post) {
            Post::create([
                'title' => $post['title'],
                'slug' => Str::slug($post['title']),
                'image' => $post['image'],
                'tags' => $post['tags'],
                'excerpt' => $post['excerpt'],
                'body' => $body,
            ]);
        }
    }
}
