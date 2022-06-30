<x-app-layout>
    <style>
        #calendar {
            max-width: 1100px;
            margin: 40px auto;
        }
    </style>
    <div class="card my-4">
        <div class="card-body" x-data="">
            <h2>Pointage Mensuel</h2>
            <div id='calendar'></div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'UTC',
                themeSystem: 'bootstrap5',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                weekNumbers: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: 'https://fullcalendar.io/api/demo-feeds/events.json',
                editable: true
            });

            calendar.render();
        });
    </script>
</x-app-layout>
