<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Categories;
use App\Models\tags;
use App\Models\posts;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // Membuat User
       User::factory(3)->create();

       // Membuat Categories
       Categories::factory(5)->create();

       // Membuat Tags
       Tags::factory(10)->create();

       // Membuat Posts dan Menambahkan Tags ke Post
       Posts::factory(20)->create()->each(function ($post) {
           // Menambahkan 1 hingga 5 tag secara acak ke setiap post
           $tags = Tags::inRandomOrder()->take(rand(1, 5))->pluck('id');
           $post->tags()->attach($tags);
        });
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
