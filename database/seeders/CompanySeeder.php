<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Company::factory(25)->create();
        $roles_company = Role::findOrCreate('company');
        $data_model_roles = [];
        for ($i=1; $i <= 25; $i++) { 
            $data_model_roles[] = [
                'role_id' => $roles_company->id,
                'model_type' => \App\Models\User::class,
                'model_id' => $i
            ];
        };
        DB::table('model_has_roles')->insert($data_model_roles);
    }
}
