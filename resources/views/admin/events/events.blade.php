@extends('layout-core')

@section('title', 'Eventos')

@section('title-header', 'Eventos')

@section('extra-css')
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/fullcalendar/fullcalendar.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('/css/fullcalendar/fullcalendar.print.css') }}" media='print'>

    <style>

        .right-content-list {
            background-color: white;
        }

        #calendar {
            max-width: 900px;
            margin: 0 auto;
            padding: 10px;

        }

        #calendar h2 {
            font-size: 19px;
            padding-top: 6px;
        }

        #calendar button {
            background-color: #E6E6E6;
            box-shadow: none;
            border: 0;
            background-image: none;
            text-shadow: none;
        }

    </style>

@endsection


@section('main-header-info-app')
    @include('partials.perfil-header-info')
@endsection


@section('main-header-options-app')

    @include('partials.perfil-link')

    @include('partials.contacts-link')

    <a href="#" class="core-menu-list"><div>Seguidores</div></a>
    <a href="#" class="core-menu-list menu-list-option"><div>Ver todos</div></a>
@endsection


@section('article-content')

@section('extra-content')
    <div class="options-tools-list">
        <div class="left-content-list-tool"></div>
        <div class="right-content-list-tool"></div>
    </div>
@endsection

<div class="left-content-list">
    <table class="table table-hover">
        <tbody>
        @for($i = 0; $i <= 100; $i++)
            <tr>
                <td>
                    <a href="#" class="core-menu-list menu-list-option menu-lis-img list-contacts-table">
                        <img src="{{ asset('/media/photo-perfil/unknow.png') }}">
                        <div class="dropdown">Evento desconocido</div>
                    </a>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>
</div>
<div class="right-content-list">
    <div id='calendar'></div>
</div>

@endsection

@section('extra-js')
    <script src="{{ asset('/js/fullcalendar/moment.min.js') }}"></script>
    <script src="{{ asset('/js/fullcalendar/fullcalendar.min.js') }}"></script>

    <script>

        $(document).ready(function() {

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: '2016-01-12',
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    {
                        title: 'All Day Event',
                        start: '2016-01-01'
                    },
                    {
                        title: 'Long Event',
                        start: '2016-01-07',
                        end: '2016-01-10'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2016-01-09T16:00:00'
                    },
                    {
                        id: 999,
                        title: 'Repeating Event',
                        start: '2016-01-16T16:00:00'
                    },
                    {
                        title: 'Conference',
                        start: '2016-01-11',
                        end: '2016-01-13'
                    },
                    {
                        title: 'Meeting',
                        start: '2016-01-12T10:30:00',
                        end: '2016-01-12T12:30:00'
                    },
                    {
                        title: 'Lunch',
                        start: '2016-01-12T12:00:00'
                    },
                    {
                        title: 'Meeting',
                        start: '2016-01-12T14:30:00'
                    },
                    {
                        title: 'Happy Hour',
                        start: '2016-01-12T17:30:00'
                    },
                    {
                        title: 'Dinner',
                        start: '2016-01-12T20:00:00'
                    },
                    {
                        title: 'Birthday Party',
                        start: '2016-01-13T07:00:00'
                    },
                    {
                        title: 'Click for Google',
                        url: 'http://google.com/',
                        start: '2016-01-28'
                    }
                ]
            });

        });

    </script>
@endsection