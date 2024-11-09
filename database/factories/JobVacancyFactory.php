<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobVacancy>
 */
class JobVacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->jobTitle();
        $currentDate = Carbon::now();
        while (in_array($title, ['Belum / Tidak Bekerja', 'Pelajar / Mahasiswa'])) {
            $title = fake()->unique()->jobTitle();
        }
        $deadline = getRandomFromArray([null,  Carbon::createFromTimestamp(rand($currentDate->subMonth(4)->timestamp, $currentDate->addYear()->timestamp))->format('Y-m-d') ]);
        return [
            'title' => $title,
            'slug' => createUnixSlug($title),
            'description' => fake()->text(1500),
            'requirement' => fake()->text(1000),
            'company_id' => rand(1, 25),
            'contract_type' => getRandomFromArray(['full-time', 'contract', 'intern']),
            'salary_min' =>  rand(2000000, 30000000),
            'salary_max' =>  rand(2000000, 30000000),
            'job_type' => getRandomFromArray(['WFH', 'WFO', 'hybrid']),
            'location' => fake()->city(),
            'application_deadline' => $deadline,
            'status' => $deadline == null || $deadline < now() ? 'inactive' : 'active'
        ];
    }
}
