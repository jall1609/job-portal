<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
use App\Models\Candidat;
use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_my_job_vacancy()
    {
        $user = Company::latest()->first()->user;
        $token = JWTAuth::fromUser($user);

        $response = $this->getJson('/api/company/job-vacancy/', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201);
    }
}
