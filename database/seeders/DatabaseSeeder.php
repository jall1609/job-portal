<?php

namespace Database\Seeders;

use App\Models\Candidat;
use App\Models\Company;
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
        User::factory(50)->create();
        Candidat::factory(25)->create();
        Company::factory(25)->create();
    }
}
