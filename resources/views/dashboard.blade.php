@extends('layouts.app')

@section('title', 'Painel — Central São Miguel')
@section('body-class', 'dashboard-page')

@section('content')
<div class="app-shell">
    @include('partials.sidebar')
    <button class="sidebar-backdrop" type="button" aria-label="Fechar menu"></button>

    <main class="content">
        @include('partials.topbar')

        @if(session('success'))
            <div class="flash">✓ {{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="flash error">Confira os campos e tente novamente.</div>
        @endif

        @include('partials.panels.overview')
        @include('partials.panels.calendar')
        @include('partials.panels.events')
        @include('partials.panels.publicity')
    </main>
</div>

@if(auth()->user()->isAdmin())
    @include('partials.event-modal')
@endif
@endsection
