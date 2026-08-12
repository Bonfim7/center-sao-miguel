<article class="event-card">
    <div class="event-date"><strong>{{ $event->date->format('d') }}</strong><span>{{ mb_strtoupper($event->date->locale('pt_BR')->translatedFormat('M')) }}</span></div>
    <div class="event-card-body"><div class="event-top"><span class="status status-{{ strtolower($event->status) }}">{{ $event->status }}</span><span class="priority">{{ $event->priority }}</span></div><h3>{{ $event->name }}</h3><p>{{ substr($event->time, 0, 5) }} · {{ $event->place ?: 'Local a definir' }}</p><small>{{ $event->group ?: $event->type }}</small></div>
</article>
