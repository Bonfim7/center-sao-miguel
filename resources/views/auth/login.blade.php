@extends('layouts.app')
@section('title', 'Entrar — Central São Miguel')
@section('body-class', 'login-page')
@section('content')
<main class="login-shell">
    <section class="login-story">
        <div class="brand brand-light"><img class="brand-logo" src="{{ asset('assets/images/brasao-paroquia-sao-miguel.png') }}" alt="Brasão da Paróquia São Miguel Arcanjo"><span>Central São Miguel<small>Quem como Deus?</small></span></div>
        <div class="story-copy">
            <span class="eyebrow">Comunidade • fé • propósito</span>
            <h1>Cada encontro,<br><em>uma missão.</em></h1>
            <p>Um só lugar para organizar a agenda, envolver a comunidade e cuidar de cada detalhe.</p>
        </div>
        <p class="verse">“Onde dois ou três estiverem reunidos em meu nome, ali estou no meio deles.”</p>
    </section>
    <section class="login-panel">
        <div class="mobile-brand brand"><img class="brand-logo" src="{{ asset('assets/images/brasao-paroquia-sao-miguel.png') }}" alt="Brasão da Paróquia São Miguel Arcanjo"><span>Central São Miguel</span></div>
        <form method="POST" action="{{ route('login.store') }}" class="login-form">
            @csrf
            <span class="eyebrow red">Área da comunidade</span>
            <h2>Que bom ter você aqui.</h2>
            <p>Acesse o painel para acompanhar os próximos eventos.</p>
            <label>E-mail<input type="email" name="email" value="{{ old('email', 'admin@centralsaomiguel.com.br') }}" required autofocus></label>
            <label>Senha<input type="password" name="password" value="1234" required></label>
            @error('email')<div class="error">{{ $message }}</div>@enderror
            <label class="check"><input type="checkbox" name="remember" value="1"> Continuar conectado</label>
            <button class="button primary wide" type="submit">Entrar no painel <span>→</span></button>
            <div class="demo-note"><strong>Acesso inicial</strong><br>Admin: admin@centralsaomiguel.com.br / 1234<br>Visitante: visitante@centralsaomiguel.com.br / 0000</div>
        </form>
    </section>
</main>
@endsection
