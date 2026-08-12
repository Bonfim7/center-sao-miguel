<section class="tab-panel" id="publicity">
    <div class="page-title"><span class="eyebrow red">Comunicação</span><h2>Fila de divulgação</h2><p>Eventos que precisam chegar até a comunidade.</p></div>
    <div class="event-list">
        @forelse($events->where('needs_publicity', true) as $event)
            @include('partials.event-row', ['event' => $event])
        @empty
            <div class="empty">Tudo em dia por aqui.</div>
        @endforelse
    </div>
</section>
