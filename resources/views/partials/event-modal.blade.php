<dialog id="eventModal" class="modal">
    <form method="POST" action="{{ route('events.store') }}" class="event-form" id="eventForm">
        @csrf
        <input type="hidden" name="_method" id="formMethod" value="POST">
        <div class="modal-head">
            <div><span class="eyebrow red">Agenda pastoral</span><h2 id="modalTitle">Novo evento</h2></div>
            <button type="button" class="modal-close">×</button>
        </div>
        <div class="form-grid">
            <label class="span-2">Nome do evento<input name="name" required></label>
            <label>Data<input name="date" type="date" required></label>
            <label>Horário<input name="time" type="time" required></label>
            <label>Tipo<select name="type">@foreach(['Missa','Encontro','Formação','Retiro','Acampamento','Evento','Reunião','Outro'] as $type)<option>{{ $type }}</option>@endforeach</select></label>
            <label>Prioridade<select name="priority"><option>Baixa</option><option selected>Média</option><option>Alta</option></select></label>
            <label>Local<input name="place"></label>
            <label>Responsável<input name="responsible"></label>
            <label>Grupo / Movimento<input name="group"></label>
            <label>Status<select name="status"><option>Planejado</option><option>Confirmado</option><option>Realizado</option><option>Cancelado</option></select></label>
            <label class="span-2">Observações<textarea name="notes" rows="3"></textarea></label>
            <label class="check span-2"><input type="checkbox" name="needs_publicity" value="1"> Precisa de divulgação</label>
        </div>
        <div class="modal-actions">
            <button type="button" class="button ghost modal-close">Cancelar</button>
            <button class="button primary" type="submit">Salvar evento</button>
        </div>
    </form>
</dialog>
