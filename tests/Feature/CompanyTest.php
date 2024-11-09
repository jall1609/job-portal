<?php

namespace Tests\Feature;

use App\Models\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_my_job_vacancy()
    {
        $user = Company::latest()->first()->user;
        $this->actingAs($user);
        $response = $this->postJson('/api/company/job-vacancy/');

        $response->assertStatus(201);
    }
}
