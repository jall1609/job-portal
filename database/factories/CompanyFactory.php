<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->unique()->company();
        return [
            'company_name' => $name,
            'user_id' => User::factory(),
            'slug' => Str::slug($name),
            'city_name' => fake()->city(),
            'headline' => fake()->text(1000),
            'employees_amount' => getRandomFromArray(['1-10', '11-50', '51-100', '100-300', '300-1000', '> 1000']),
        ];
    }
}
