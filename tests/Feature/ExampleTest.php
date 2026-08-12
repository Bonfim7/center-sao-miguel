<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_theme_assets_are_served_with_the_correct_content_type(): void
    {
        $this->get('/theme/app.css')->assertOk()->assertHeader('Content-Type', 'text/css; charset=UTF-8');
        $this->get('/theme/app.js')->assertOk()->assertHeader('Content-Type', 'application/javascript; charset=UTF-8');
    }
}
