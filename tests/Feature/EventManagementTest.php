<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $this->get('/painel')->assertRedirect('/');
    }

    public function test_admin_can_create_an_event(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->post('/eventos', [
            'name' => 'Retiro Jovem', 'type' => 'Retiro', 'date' => '2026-09-10', 'time' => '08:00',
            'status' => 'Planejado', 'priority' => 'Alta', 'needs_publicity' => '1',
        ])->assertRedirect();

        $this->assertDatabaseHas('events', ['name' => 'Retiro Jovem', 'needs_publicity' => true]);
    }

    public function test_viewer_cannot_create_an_event(): void
    {
        $viewer = User::factory()->create(['role' => 'viewer']);

        $this->actingAs($viewer)->post('/eventos', [
            'name' => 'Evento bloqueado', 'type' => 'Outro', 'date' => '2026-09-10', 'time' => '08:00',
            'status' => 'Planejado', 'priority' => 'Baixa',
        ])->assertForbidden();

        $this->assertDatabaseCount('events', 0);
    }
}
