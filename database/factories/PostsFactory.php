<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
     protected $model = \app\Models\Posts::class;

    public function definition(): array
    {
        return [
            //

            'title' => $this->faker->sentence,
            'slug' => $this->faker->slug,
            'content' => $this->faker->paragraphs(3, true),
            'user_id' => \App\Models\User::factory(), // Membuat user baru untuk setiap post
            'category_id' => \App\Models\Categories::factory(), // Membuat category baru untuk setiap post
            'thumbnail' => $this->faker->imageUrl(),
            'published_at' => now(),
            'status' => 'published', // atau bisa diubah menjadi 'draft' atau lainnya
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->text,

        ];
    }
}
