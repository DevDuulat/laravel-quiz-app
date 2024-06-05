<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        // Create dummy blog data
        foreach (range(1, 10) as $index) {
            Blog::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'publication_date' => $faker->date(),
                'cover' => 'blog-thumbnail' . rand(1, 3) . '.jpg', // Assuming you have 3 blog thumbnail images named blog-thumbnail1.jpg, blog-thumbnail2.jpg, and blog-thumbnail3.jpg
                'content' => $faker->text,
                'user_id' => 1, // Replace with the actual user_id
            ]);
        }
    }
}
