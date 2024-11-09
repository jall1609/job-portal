<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CandidatTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_my_application()
    {
        $response = $this->get('/api/candidat/my-application');

        $response->assertStatus(201);
    }
}
