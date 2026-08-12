@extends('layouts.app')
@section('title', 'Painel — Central São Miguel')
@section('body-class', 'dashboard-page')
@section('content')
<div class="app-shell">
    <aside class="sidebar">
        <div class="brand brand-light"><span class="brand-mark">SM</span><span>Central São Miguel<small>Gestão pastoral</small></span></div>
        <nav class="side-nav">
            <button class="nav-link active" data-tab="overview"><span>⌂</span> Visão geral</button>
            <button class="nav-link" data-tab="calendar"><span>□</span> Calendário</button>
            <button class="nav-link" data-tab="events"><span>◫</span> Todos os eventos</button>
            <button class="nav-link" data-tab="publicity"><span>◇</span> Divulgação</button>
        </nav>
        <div class="sidebar-bottom">
            <div class="user-card"><span class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span><span><strong>{{ auth()->user()->name }}</strong><small>{{ auth()->user()->isAdmin() ? 'Administrador' : 'Visualização' }}</small></span></div>
            <form method="POST" action="{{ route('logout') }}">@csrf<button class="logout" type="submit">Sair da conta</button></form>
        </div>
    </aside>
    <main class="content">
        <header class="topbar">
            <button class="menu-toggle" aria-label="Abrir menu">☰</button>
            <div><span class="eyebrow red">Central São Miguel</span><h1>Olá, {{ explode(' ', auth()->user()->name)[0] }}!</h1></div>
            @if(auth()->user()->isAdmin())<button class="button primary" data-open-modal>+ Novo evento</button>@endif
        </header>

        @if(session('success'))<div class="flash">✓ {{ session('success') }}</div>@endif
        @if($errors->any())<div class="flash error">Confira os campos e tente novamente.</div>@endif

        <section class="tab-panel active" id="overview">
            <div class="welcome-card"><div><span class="eyebrow">Agenda pastoral</span><h2>Vamos construir<br>algo bonito juntos.</h2><p>Acompanhe os encontros e mantenha toda a comunidade em sintonia.</p></div><div class="orb"><span>✦</span></div></div>
            <div class="metrics">
                <article class="metric-card"><span class="metric-icon wine">◫</span><div><strong>{{ $total }}</strong><small>Total de eventos</small></div></article>
                <article class="metric-card"><span class="metric-icon green">✓</span><div><strong>{{ $confirmed }}</strong><small>Confirmados</small></div></article>
                <article class="metric-card"><span class="metric-icon gold">↗</span><div><strong>{{ $nextSevenDays }}</strong><small>Próximos 7 dias</small></div></article>
                <article class="metric-card"><span class="metric-icon blue">!</span><div><strong>{{ $highPriority }}</strong><small>Alta prioridade</small></div></article>
            </div>
            <div class="section-heading"><div><span class="eyebrow red">Por vir</span><h2>Próximos encontros</h2></div><button class="text-button" data-go="events">Ver agenda completa →</button></div>
            <div class="event-grid">
                @forelse($upcoming as $event) @include('partials.event-card', ['event' => $event])
                @empty <div class="empty">Nenhum evento futuro. Que tal criar o primeiro?</div> @endforelse
            </div>
        </section>

        <section class="tab-panel" id="calendar">
            <div class="page-title"><span class="eyebrow red">Organize-se</span><h2>Calendário pastoral</h2></div>
            <div class="calendar-card"><div class="calendar-header"><button id="prevMonth">←</button><h3 id="calendarTitle"></h3><button id="nextMonth">→</button></div><div class="calendar-grid" id="calendarGrid"></div></div>
        </section>

        <section class="tab-panel" id="events">
            <div class="page-title"><span class="eyebrow red">Agenda completa</span><h2>Todos os eventos</h2></div>
            <div class="list-toolbar"><input id="eventSearch" type="search" placeholder="Pesquisar por evento, grupo ou local..."><span>{{ $events->count() }} eventos</span></div>
            <div class="event-list" id="eventList">
                @forelse($events as $event) @include('partials.event-row', ['event' => $event]) @empty <div class="empty">Nenhum evento cadastrado.</div> @endforelse
            </div>
        </section>

        <section class="tab-panel" id="publicity">
            <div class="page-title"><span class="eyebrow red">Comunicação</span><h2>Fila de divulgação</h2><p>Eventos que precisam chegar até a comunidade.</p></div>
            <div class="event-list">@forelse($events->where('needs_publicity', true) as $event) @include('partials.event-row', ['event' => $event]) @empty <div class="empty">Tudo em dia por aqui.</div> @endforelse</div>
        </section>
    </main>
</div>

@if(auth()->user()->isAdmin())
<dialog id="eventModal" class="modal">
    <form method="POST" action="{{ route('events.store') }}" class="event-form" id="eventForm">@csrf<input type="hidden" name="_method" id="formMethod" value="POST">
        <div class="modal-head"><div><span class="eyebrow red">Agenda pastoral</span><h2 id="modalTitle">Novo evento</h2></div><button type="button" class="modal-close">×</button></div>
        <div class="form-grid">
            <label class="span-2">Nome do evento<input name="name" required></label>
            <label>Data<input name="date" type="date" required></label><label>Horário<input name="time" type="time" required></label>
            <label>Tipo<select name="type">@foreach(['Missa','Encontro','Formação','Retiro','Acampamento','Evento','Reunião','Outro'] as $type)<option>{{ $type }}</option>@endforeach</select></label>
            <label>Prioridade<select name="priority"><option>Baixa</option><option selected>Média</option><option>Alta</option></select></label>
            <label>Local<input name="place"></label><label>Responsável<input name="responsible"></label>
            <label>Grupo / Movimento<input name="group"></label><label>Status<select name="status"><option>Planejado</option><option>Confirmado</option><option>Realizado</option><option>Cancelado</option></select></label>
            <label class="span-2">Observações<textarea name="notes" rows="3"></textarea></label>
            <label class="check span-2"><input type="checkbox" name="needs_publicity" value="1"> Precisa de divulgação</label>
        </div>
        <div class="modal-actions"><button type="button" class="button ghost modal-close">Cancelar</button><button class="button primary" type="submit">Salvar evento</button></div>
    </form>
</dialog>
@endif
<script>window.calendarEvents = @json($calendarEvents); window.eventUpdateBase = @json(url('/eventos'));</script>
@endsection
