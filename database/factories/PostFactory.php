<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str; // Import the Str class for generating slugs
use Faker\Generator as Faker; // Import the Faker class

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = app(Faker::class); // Create an instance of the Faker class

        return [
            "cat_id" => 1,
            "user_id" => 1,
            "subcat_id" => 1,
            "title" => $faker->jobTitle(),
            "slug" => Str::slug($faker->words(3, true)), // Generate a slug
            "image" => $faker->image(),
            "description" => $faker->paragraph(1),
            "status" => 0
        ];
    }
}
