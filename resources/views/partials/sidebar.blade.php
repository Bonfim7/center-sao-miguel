<aside class="sidebar">
    <div class="brand brand-light">
        <span class="brand-mark">SM</span>
        <span>Central São Miguel<small>Gestão pastoral</small></span>
    </div>

    <nav class="side-nav">
        <button class="nav-link active" data-tab="overview"><span>⌂</span> Visão geral</button>
        <button class="nav-link" data-tab="calendar"><span>□</span> Calendário</button>
        <button class="nav-link" data-tab="events"><span>◫</span> Todos os eventos</button>
        <button class="nav-link" data-tab="publicity"><span>◇</span> Divulgação</button>
    </nav>

    <div class="sidebar-bottom">
        <div class="user-card">
            <span class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            <span>
                <strong>{{ auth()->user()->name }}</strong>
                <small>{{ auth()->user()->isAdmin() ? 'Administrador' : 'Visualização' }}</small>
            </span>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="logout" type="submit">Sair da conta</button>
        </form>
    </div>
</aside>
