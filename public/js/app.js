document.addEventListener('DOMContentLoaded', () => {
    const panels = document.querySelectorAll('.tab-panel');
    const navLinks = document.querySelectorAll('.nav-link');
    const showTab = id => {
        panels.forEach(panel => panel.classList.toggle('active', panel.id === id));
        navLinks.forEach(link => link.classList.toggle('active', link.dataset.tab === id));
        document.querySelector('.sidebar')?.classList.remove('open');
    };
    navLinks.forEach(link => link.addEventListener('click', () => showTab(link.dataset.tab)));
    document.querySelectorAll('[data-go]').forEach(link => link.addEventListener('click', () => showTab(link.dataset.go)));
    document.querySelector('.menu-toggle')?.addEventListener('click', () => document.querySelector('.sidebar')?.classList.toggle('open'));

    const search = document.querySelector('#eventSearch');
    search?.addEventListener('input', () => document.querySelectorAll('#eventList .event-row').forEach(row => {
        row.hidden = !row.dataset.search.includes(search.value.toLocaleLowerCase('pt-BR'));
    }));

    const modal = document.querySelector('#eventModal');
    const form = document.querySelector('#eventForm');
    const resetForm = () => {
        form?.reset();
        if (!form) return;
        form.action = '/eventos'; document.querySelector('#formMethod').value = 'POST';
        document.querySelector('#modalTitle').textContent = 'Novo evento';
    };
    document.querySelector('[data-open-modal]')?.addEventListener('click', () => { resetForm(); modal.showModal(); });
    document.querySelectorAll('.modal-close').forEach(button => button.addEventListener('click', () => modal.close()));
    document.querySelectorAll('.edit-event').forEach(button => button.addEventListener('click', () => {
        const event = JSON.parse(button.dataset.event); resetForm();
        form.action = `${window.eventUpdateBase}/${event.id}`; document.querySelector('#formMethod').value = 'PUT';
        document.querySelector('#modalTitle').textContent = 'Editar evento';
        ['name','type','date','time','place','responsible','group','status','priority','notes'].forEach(key => {
            const field = form.elements[key]; if (field) field.value = event[key] ?? '';
        });
        form.elements.needs_publicity.checked = Boolean(event.needs_publicity); modal.showModal();
    }));

    if (!document.querySelector('#calendarGrid')) return;
    const events = window.calendarEvents || [];
    let cursor = new Date(); cursor.setDate(1);
    const months = ['janeiro','fevereiro','março','abril','maio','junho','julho','agosto','setembro','outubro','novembro','dezembro'];
    const renderCalendar = () => {
        const year = cursor.getFullYear(), month = cursor.getMonth();
        document.querySelector('#calendarTitle').textContent = `${months[month]} de ${year}`;
        const grid = document.querySelector('#calendarGrid');
        grid.innerHTML = ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'].map(day => `<div class="calendar-day-name">${day}</div>`).join('');
        const first = new Date(year, month, 1).getDay(), days = new Date(year, month + 1, 0).getDate();
        for (let i = 0; i < first; i++) grid.insertAdjacentHTML('beforeend', '<div class="calendar-day muted"></div>');
        for (let day = 1; day <= days; day++) {
            const date = `${year}-${String(month + 1).padStart(2,'0')}-${String(day).padStart(2,'0')}`;
            const isToday = date === new Date().toISOString().slice(0,10);
            const items = events.filter(event => event.date === date).map(event => `<span class="calendar-event" title="${event.name}">${event.time} ${event.name}</span>`).join('');
            grid.insertAdjacentHTML('beforeend', `<div class="calendar-day ${isToday ? 'today' : ''}"><strong>${day}</strong>${items}</div>`);
        }
    };
    document.querySelector('#prevMonth').addEventListener('click', () => { cursor.setMonth(cursor.getMonth() - 1); renderCalendar(); });
    document.querySelector('#nextMonth').addEventListener('click', () => { cursor.setMonth(cursor.getMonth() + 1); renderCalendar(); });
    renderCalendar();
});
