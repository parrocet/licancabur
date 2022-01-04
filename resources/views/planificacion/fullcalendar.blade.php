<!-- Start Full Calendar area -->

<link href="{{ asset('assets/fullcalendar/core/main.min.css') }}" rel='stylesheet' />
<link href="{{ asset('assets/fullcalendar/daygrid/main.min.css') }}" rel='stylesheet' />
<link href="{{ asset('assets/fullcalendar/timegrid/main.min.css') }}" rel='stylesheet' />
<script src="{{ asset('assets/fullcalendar/core/main.min.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/interaction/main.min.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/daygrid/main.min.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/timegrid/main.min.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/core/es.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/bootstrap/main.min.js') }}"></script>
<!-- <script src="{{ asset('assets/fullcalendar/list/main.js') }}"></script> -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('myCalendar');
        /*$.get("buscar_api",function (info) {                
                console.log(info.length);
                console.log("dsa");
            });*/
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'bootstrap', 'list'],
            themeSystem: 'bootstrap',
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            editable: false,
            eventLimit: false,
            events: '/api_fc',

            eventClick: function (info) {
                document.getElementById('tituloEvento').innerHTML = info.event.title;
                document.getElementById('descripcionEvento').innerHTML = info.event.start;

                $("#myModalfour").modal();
            }

        });

        calendar.setOption('locale', 'es');
        calendar.render();
    });
    
</script>
<div class="basic-tb-hd text-center">
    @if(!empty($planificacion1))
    <p>Actividades - Información detallada de la semana {{ $planificacion1->semana }}</p>
    @else

    <p>No existe planificación registrada para la semana actual</p>

    @endif
    @if(count($errors))
    <div class="alert-list m-4">
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
            <ul>
                @foreach($errors->all() as $error)
                <li>
                    {{$error}}
                </li>
                @endforeach

            </ul>
        </div>
    </div>
    @endif
    @include('flash::message')
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="calendar-wrap">
                <div id="myCalendar"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Full Calendar area -->
<!-- Start modal view -->
<div class="modal animated bounce" id="myModalfour" role="dialog">
    <div class="modal-dialog modals-default">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                

                <h1 id="tituloEvento"></h1>
                <!-- <small>En la lista de: John Doe</small> -->
                <div class="row">
                    <div class="col-md-12">
                        <b>
                            <p>Vencimiento:
                                <span class="label label-success p-1" data-toggle="tooltip" data-placement="bottom"
                                    title="Feha de vencimiento"><i class="lni-alarm-clock"></i> 19 Agos.</span>
                            </p>
                        </b>
                        <b>
                            <p>Descripción:
                        </b><br>
                        Fecha: <span id="descripcionEvento"></span></p>
                    </div>


                </div>

               
            </div>
            <div class="modal-footer mt-4">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- End modal view -->
