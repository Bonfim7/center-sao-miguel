<header class="topbar">
    <button class="menu-toggle" aria-label="Abrir menu">☰</button>
    <div>
        <span class="eyebrow red">Central São Miguel</span>
        <h1>Olá, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
    </div>
    @if(auth()->user()->isAdmin())
        <button class="button primary" data-open-modal>+ Novo evento</button>
    @endif
</header>
