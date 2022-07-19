<x-app-layout>
    <style>
        #calendar {
            max-width: 1100px;
            margin: 40px auto;
            opacity: 1;
            transition: opacity 0.5s ease-in-out;
        }

        #calendar.is-loading {
            opacity: 0;
        }
    </style>
    <div class="card my-4">
        <div class="card-body" x-data="">
            <div class="row justify-content-between">

                <div class="col-4">
                    <h2>Pointage Mensuel</h2>
                </div>
                <div class="col-6">
                    <x-auth-validation-errors class="mb-3" :errors="$errors" />
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col w-75">

                                <input class="form-control" type="file" id="spreadsheet" name="spreadsheet" />
                            </div>


                            <button type="submit" class="btn btn-primary text-light w-25">Import</button>
                        </div>
                    </form>


                </div>
            </div>
            <div id='calendar'></div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel" x-data x-text="$store.calendar.selectedEvent.title">Modal
                        title
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- <p x-text="JSON.stringify($store.calendar.selectedEvent)"></p> --}}
                    <ul class="list-group">
                        <template x-data
                            x-for="([key, value]) in Object.entries($store.calendar.selectedEvent.extendedProps)">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold" x-text="key">Subheading</div>
                                    <span x-text="value">-</span>
                                </div>

                            </li>
                        </template>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('calendar', {
                selectedEvent: null,
                setEvent(e) {
                    this.selectedEvent = e;
                }
            })
        });
        document.addEventListener('DOMContentLoaded', function() {
            var myModal = new bootstrap.Modal(document.getElementById('myModal'), {
                keyboard: false
            })
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
                dayMaxEvents: 1,
                initialDate: '2021-01-01',
                eventDataTransform: function(eventData) {
                    eventData.title = eventData.tlc;
                    eventData.start = new Date(eventData.departure_date);
                    eventData.end = new Date(eventData.arrival_date);
                    return eventData;
                },
                eventClick: function(info) {
                    Alpine.store('calendar').setEvent(info.event);
                    console.log(Alpine.store('calendar').selectedEvent)
                    myModal.show();
                },
            });

            calendar.render();
        });
    </script>
</x-app-layout>
