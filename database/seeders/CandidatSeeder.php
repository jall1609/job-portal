<?php

namespace Database\Seeders;

use App\Models\Candidat;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class CandidatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Candidat::factory(25)->create();
        $roles_candidat = Role::findOrCreate('candidat');
        $data_model_roles = [];
        for ($i=26; $i <= 50; $i++) { 
            $data_model_roles[] = [
                'role_id' => $roles_candidat->id,
                'model_type' => \App\Models\User::class,
                'model_id' => $i
            ];
        };
        DB::table('model_has_roles')->insert($data_model_roles);
    }
}
