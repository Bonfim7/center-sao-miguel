<section class="tab-panel" id="events">
    <div class="page-title"><span class="eyebrow red">Agenda completa</span><h2>Todos os eventos</h2></div>
    <div class="list-toolbar"><input id="eventSearch" type="search" placeholder="Pesquisar por evento, grupo ou local..."><span>{{ $events->count() }} eventos</span></div>
    <div class="event-list" id="eventList">
        @forelse($events as $event)
            @include('partials.event-row', ['event' => $event])
        @empty
            <div class="empty">Nenhum evento cadastrado.</div>
        @endforelse
    </div>
</section>
