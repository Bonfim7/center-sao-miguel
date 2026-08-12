<section class="tab-panel active" id="overview">
    <div class="welcome-card">
        <div><span class="eyebrow">Agenda pastoral</span><h2>Vamos construir<br>algo bonito juntos.</h2><p>Acompanhe os encontros e mantenha toda a comunidade em sintonia.</p></div>
        <div class="orb"><img src="{{ asset('assets/images/brasao-paroquia-sao-miguel.png') }}" alt="Brasão da Paróquia São Miguel Arcanjo"></div>
    </div>
    <div class="metrics">
        <article class="metric-card"><span class="metric-icon wine">◫</span><div><strong>{{ $total }}</strong><small>Total de eventos</small></div></article>
        <article class="metric-card"><span class="metric-icon green">✓</span><div><strong>{{ $confirmed }}</strong><small>Confirmados</small></div></article>
        <article class="metric-card"><span class="metric-icon gold">↗</span><div><strong>{{ $nextSevenDays }}</strong><small>Próximos 7 dias</small></div></article>
        <article class="metric-card"><span class="metric-icon blue">!</span><div><strong>{{ $highPriority }}</strong><small>Alta prioridade</small></div></article>
    </div>
    <div class="section-heading"><div><span class="eyebrow red">Por vir</span><h2>Próximos encontros</h2></div><button class="text-button" data-go="events">Ver agenda completa →</button></div>
    <div class="event-grid">
        @forelse($upcoming as $event)
            @include('partials.event-card', ['event' => $event])
        @empty
            <div class="empty">Nenhum evento futuro. Que tal criar o primeiro?</div>
        @endforelse
    </div>
</section>
