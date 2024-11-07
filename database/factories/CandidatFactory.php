<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Candidat>
 */
class CandidatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = ['male', 'female'];
        $gender = $gender[array_rand($gender)];
        $name = fake()->name($gender);
        $username = Str::slug($name);
        return [
            'name' => $name,
            'username' => $username,
            'gender' => $gender,
            'user_id' => rand(26,50),
            'city_name' => fake()->city(),
            'date_of_birth' => fake()->date(),
            'phone' => fake()->phoneNumber(),
            'linkedin_link' => 'https://www.linkedin.com/in/'. $username,
            'profile_headline' =>  fake()->jobTitle(),
            'current_salary' =>  rand(2000000, 30000000),
            'current_salary' =>  rand(2000000, 30000000),
            'skill' =>  null,
        ];
    }
}
