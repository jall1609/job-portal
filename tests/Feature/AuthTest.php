<?php

namespace Tests\Feature;

use App\Models\Candidat;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthTest extends TestCase
{

    public function test_register_company(): void
    {
        $roles_company = Role::findOrCreate('company');
        $data = [
            "email" => "ptpelasdasit1aasdadaasasasddasdsd11@gmail.com",
            "password" => "12345",
            "company_name" => "PT Pelita Harapan Bangsa Keren Sekali",
            "city_name" => "Jogja",
            "headline" => "lorem ipsum dolor sit amet",
            "employees_amount" => "1-10"
        ];

        $response = $this->postJson('/api/auth/register-company', $data);

        $response->assertStatus(201);
    }

    public function test_register_candidat(): void
    {
        $roles_company = Role::findOrCreate('candidat');
        $data = [
            "email" =>"dimasqsdaasdsdasdasaa@gmail.com",
            "password" => "12345",
            "name" => "Dimas Wardana",
            "city_name" => "Jogja",
            "profile_headline" => "lorem ipsum dolor sit amet",
            "gender" => "male",
            "date_of_birth" => "2010-04-03",
            "phone" => "0895401514556",
            "skill" => "laravel"
        ];
        
        $response = $this->postJson('/api/auth/register-candidat', $data);

        $response->assertStatus(201);
    }

    public function test_login_candidat(): void
    {
        $data = [
            "email" => "dimasqsdaasdsdasdasaa@gmail.com",
            "password" => "12345",
        ];

        $response = $this->postJson('/api/auth/login', $data);

        $response->assertStatus(201);
    }

    public function test_login_company(): void
    {
        $data = [
            "email" => "ptpelasdasit1aasdadaasasasddasdsd11@gmail.com",
            "password" => "12345",
        ];

        $response = $this->postJson('/api/auth/login', $data);

        $response->assertStatus(201);
    }
}
