<?php

use App\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        
        for ($i=0; $i < 100; $i++) { 

            $post = new Post();

            $post->title = $faker->words(7, true);
            $post->slug = Str::slug( $post->title );
            $post->content = $faker->paragraphs(10, true);
            $post->published_at = $faker->randomElement( [ null, $faker->dateTime() ] );

            $post->save();
            
        }

    }
}
