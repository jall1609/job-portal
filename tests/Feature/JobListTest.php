<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\AuthController;
use App\Models\Candidat;
use App\Models\JobVacancy;
use App\Models\User;
use Database\Seeders\CandidatSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class JobListTest extends TestCase
{
    

    public function testAllJob()
    {
        $response = $this->get('/api' . '/' .'job-list/');

        $response->assertStatus(201);
    }

    public function testDetailJobList()
    {
        $jobVacancy = JobVacancy::latest()->first();
        $response = $this->get('/api' . '/' .'job-list/'. $jobVacancy->slug);

        $response->assertStatus(201);
    }

    public function testApplyJob()
    {
        $data = [
            'cover_letter' => 'Hallo saya ingin apply',
            'resume_link' => 'https://asd.com',
        ];

        $user = Candidat::latest()->first()->user;
        $this->actingAs($user);
        $jobVacancy = JobVacancy::latest()->first();
        $response = $this->postJson('/api/job-list/'.$jobVacancy->slug .'/apply', $data);

        $response->assertStatus(201);
    }
}
