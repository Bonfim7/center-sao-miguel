<article class="event-row" data-search="{{ mb_strtolower($event->name.' '.$event->group.' '.$event->place.' '.$event->responsible) }}">
    <div class="row-date"><strong>{{ $event->date->format('d') }}</strong><span>{{ mb_strtoupper($event->date->locale('pt_BR')->translatedFormat('M')) }}</span></div>
    <div class="row-main"><h3>{{ $event->name }}</h3><p>{{ substr($event->time, 0, 5) }} · {{ $event->place ?: 'Local a definir' }} · {{ $event->group ?: $event->type }}</p></div>
    <span class="status status-{{ strtolower($event->status) }}">{{ $event->status }}</span>
    @if(auth()->user()->isAdmin())<div class="row-actions"><button class="icon-button edit-event" type="button" data-event-id="{{ $event->id }}">Editar</button><form class="delete-event-form" method="POST" action="{{ route('events.destroy', $event) }}">@csrf @method('DELETE')<button class="icon-button danger" type="submit">Excluir</button></form></div>@endif
</article>
