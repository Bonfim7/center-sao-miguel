<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(['email' => 'admin@centralsaomiguel.com.br'], [
            'name' => 'Administrador', 'password' => Hash::make('1234'), 'role' => 'admin',
        ]);
        User::updateOrCreate(['email' => 'visitante@centralsaomiguel.com.br'], [
            'name' => 'Visitante', 'password' => Hash::make('0000'), 'role' => 'viewer',
        ]);

        Event::firstOrCreate(['name' => 'Grupo de Jovens', 'date' => '2026-08-15'], [
            'type' => 'Encontro', 'time' => '20:00', 'place' => 'Salão Paroquial', 'responsible' => 'Maria',
            'group' => 'Grupo de Jovens', 'status' => 'Confirmado', 'priority' => 'Alta', 'needs_publicity' => true,
            'notes' => 'Levar materiais para a dinâmica.',
        ]);
        Event::firstOrCreate(['name' => 'Missa Dominical', 'date' => '2026-08-23'], [
            'type' => 'Missa', 'time' => '10:00', 'place' => 'Igreja Matriz', 'responsible' => 'João',
            'group' => 'Liturgia', 'status' => 'Planejado', 'priority' => 'Média', 'needs_publicity' => true,
        ]);
    }
}
