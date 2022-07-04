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
                themeSystem: 'bootstrap5',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: '/programme/data',
                editable: true,
                eventDataTransform: function(eventData) {
                    eventData.title = eventData.tlc;
                    eventData.start = new Date(eventData.departure_date);
                    eventData.end = new Date(eventData.arrival_date);
                    return eventData;
                },
            });

            calendar.render();
        });
    </script>
</x-app-layout>
