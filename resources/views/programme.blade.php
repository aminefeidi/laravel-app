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



        .spanner {
            position: absolute;
            top: 50%;
            left: 0;
            background: #2a2a2a55;
            width: 100%;
            display: block;
            text-align: center;
            height: 300px;
            color: #FFF;
            transform: translateY(-50%);
            z-index: 1000;
            visibility: hidden;
        }

        .overlay {
            position: fixed;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            visibility: hidden;
        }

        .loader,
        .loader:before,
        .loader:after {
            border-radius: 50%;
            width: 2.5em;
            height: 2.5em;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
            -webkit-animation: load7 1.8s infinite ease-in-out;
            animation: load7 1.8s infinite ease-in-out;
        }

        .loader {
            color: #ffffff;
            font-size: 10px;
            margin: 80px auto;
            position: relative;
            text-indent: -9999em;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }

        .loader:before,
        .loader:after {
            content: '';
            position: absolute;
            top: 0;
        }

        .loader:before {
            left: -3.5em;
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .loader:after {
            left: 3.5em;
        }

        @-webkit-keyframes load7 {

            0%,
            80%,
            100% {
                box-shadow: 0 2.5em 0 -1.3em;
            }

            40% {
                box-shadow: 0 2.5em 0 0;
            }
        }

        @keyframes load7 {

            0%,
            80%,
            100% {
                box-shadow: 0 2.5em 0 -1.3em;
            }

            40% {
                box-shadow: 0 2.5em 0 0;
            }
        }

        .show {
            visibility: visible;
        }

        .spanner,
        .overlay {
            opacity: 0;
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            transition: all 0.3s;
        }

        .spanner.show,
        .overlay.show {
            opacity: 1
        }
    </style>
    <div class="wrapper card my-4">
        <div class="card-body" x-data="">
            <div class="row justify-content-between">

                <div class="col-md-4">
                    <h2>Pointage Mensuel</h2>
                </div>
                <div class="col-md-6">
                    <x-auth-validation-errors class="mb-3" :errors="$errors" />
                    <form action="{{ route('programme.import') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-4">
                            <label for="spreadsheet">Programme:</label>
                            <div class="col w-75">

                                <input @click="$store.isLoading.toggle()" class="form-control" type="file" id="spreadsheet" name="spreadsheet" />
                            </div>


                            <button @click="$store.isLoading.toggle()" type="submit" class="btn btn-primary text-light w-25">Import</button>
                        </div>
                    </form>
                    <form action="{{ route('programme.flights') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <label for="spreadsheet2">Flights (after programme uploaded):</label>
                            <div class="col w-75">

                                <input class="form-control" type="file" id="spreadsheet2" name="spreadsheet2" />
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
    <div class="overlay" :class="$store.isLoading.on && 'show'"></div>
    <div class="spanner" :class="$store.isLoading.on && 'show'">
        <div class="loader"></div>
        <p>Uploading music file, please be patient.</p>
    </div>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('calendar', {
                selectedEvent: null,
                setEvent(e) {
                    this.selectedEvent = e;
                }
            })
            Alpine.store('isLoading', {
                on: false,
                toggle() {
                    this.on = !this.on;
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
                    eventData.title =
                        `${eventData.flight_no} - ${eventData.airport_c_is_dep} - ${eventData.airport_c_is_dest}`;
                    eventData.start = new Date(eventData.departure_date);
                    eventData.end = new Date(eventData.arrival_date);
                    // eventData.title = eventData.fn_carrier;
                    // eventData.start = new Date(eventData.dep_sched_dt);
                    // eventData.end = new Date(eventData.arr_sched_dt);
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
