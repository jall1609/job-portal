<?php

namespace Database\Seeders;

use App\Models\Candidat;
use App\Models\Company;
use App\Models\JobVacancy;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(50)->create();
        $this->call([CompanySeeder::class, CandidatSeeder::class]);
        JobVacancy::factory(50)->create();
    }
}
