<?php

namespace Tests\Feature;

use App\Models\Candidat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class CandidatTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_my_application()
    {
        $user = Candidat::latest()->first()->user;
        $token = JWTAuth::fromUser($user);

        $response = $this->getJson('/api/candidat/my-application/', [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(201);
    }
}
