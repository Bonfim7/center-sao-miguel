<?php

namespace Tests\Feature;

use App\Models\Event;
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

    public function test_authenticated_user_can_load_calendar_data(): void
    {
        $viewer = User::factory()->create(['role' => 'viewer']);
        Event::create([
            'name' => 'Missa da Família', 'type' => 'Missa', 'date' => '2026-10-04', 'time' => '19:00',
            'status' => 'Confirmado', 'priority' => 'Média',
        ]);

        $this->actingAs($viewer)->getJson('/calendario/eventos')
            ->assertOk()
            ->assertJsonFragment(['name' => 'Missa da Família', 'date' => '2026-10-04']);
    }

    public function test_only_admin_can_load_event_edit_data(): void
    {
        $event = Event::create([
            'name' => 'Formação', 'type' => 'Formação', 'date' => '2026-10-08', 'time' => '20:00',
            'status' => 'Planejado', 'priority' => 'Baixa',
        ]);
        $viewer = User::factory()->create(['role' => 'viewer']);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($viewer)->getJson("/eventos/{$event->id}")->assertForbidden();
        $this->actingAs($admin)->getJson("/eventos/{$event->id}")->assertOk()->assertJsonFragment(['name' => 'Formação']);
    }
}
