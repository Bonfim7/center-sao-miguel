<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(Request $request): View
    {
        $events = Event::orderBy('date')->orderBy('time')->get();
        $today = now()->startOfDay();

        return view('dashboard', [
            'events' => $events,
            'upcoming' => $events->filter(fn ($event) => $event->date->gte($today))->take(6),
            'total' => $events->count(),
            'confirmed' => $events->where('status', 'Confirmado')->count(),
            'nextSevenDays' => $events->filter(fn ($event) => $event->date->between($today, $today->copy()->addDays(7)))->count(),
            'highPriority' => $events->where('priority', 'Alta')->count(),
            'calendarEvents' => $events->map(fn ($event) => [
                'id' => $event->id, 'name' => $event->name, 'date' => $event->date->format('Y-m-d'),
                'time' => substr($event->time, 0, 5), 'status' => $event->status,
            ])->values(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorizeAdmin($request);
        Event::create($this->validated($request));

        return back()->with('success', 'Evento criado com sucesso.');
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $this->authorizeAdmin($request);
        $event->update($this->validated($request));

        return back()->with('success', 'Evento atualizado.');
    }

    public function destroy(Request $request, Event $event): RedirectResponse
    {
        $this->authorizeAdmin($request);
        $event->delete();

        return back()->with('success', 'Evento excluído.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'], 'type' => ['required', 'string', 'max:60'],
            'date' => ['required', 'date'], 'time' => ['required', 'date_format:H:i'],
            'place' => ['nullable', 'string', 'max:150'], 'responsible' => ['nullable', 'string', 'max:100'],
            'group' => ['nullable', 'string', 'max:100'], 'status' => ['required', 'in:Planejado,Confirmado,Realizado,Cancelado'],
            'priority' => ['required', 'in:Alta,Média,Baixa'], 'needs_publicity' => ['nullable', 'boolean'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]) + ['needs_publicity' => $request->boolean('needs_publicity')];
    }

    private function authorizeAdmin(Request $request): void
    {
        abort_unless($request->user()?->isAdmin(), 403);
    }
}
