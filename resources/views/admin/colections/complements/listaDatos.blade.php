@extends('layout-admin')

@section('title', @trans('title.home'))

@section('content')

    <!-- REVISAR -->
    <div class="head-fixed">
        <div class="head-menu">
            <h1><span><img src="{{ asset('/images/icon-complements.svg') }}"></span> <span> > </span> GESTIONAR DATOs: COLECCIÓN {{ $form->name  }}</h1>
            @include('admin.colections.complements.partials.menu')
            @include('admin.colections.partials.form-search')
        </div>
    </div>


<div class="container-inputs-list" id="datos">

    @if(count($dTitlesColums) === 0)
        <p>Sin registros > <a href="{{ route('form', $form) }}">NUEVO REGISTRO</a></p>
    @else

        <table class="table table-condensed">
            <thead scope="row">
            <tr>
                <th>#</th>
                @foreach($dTitlesColums as $dTitlesColum)
                    <th style="font-size: 14px;">{{ substr($dTitlesColum->dtitle, 0, 16) . '...' }}</th>
                @endforeach
                    <th>Eliminar</th>
            </tr>
            </thead>
            <tbody>

                @foreach($arrayRows as $arrayRow)
                    <tr>
                        <th scope="row"><h4 style="margin-top: 7px;">{{ $numList++ }}</h4></th>
                        @foreach($arrayRow++ as $row)
                            <td>
                                {!! Form::text('content', $row->content, ['id' => $numList, 'class' => 'form-control input-base ' . $row->type_validation, 'onclick' => 'getVaInput(this);', 'onblur' => 'updateInput(this,'. $row->id .');']) !!}
                            </td>
                            <div style="display: none;">{{ $rowIdDelete = $row->row_id }}</div>
                        @endforeach
                        <td class="text-center">
                            <a href="#" class="input-delete" onclick="eliminarInput(this, {{ $rowIdDelete }} );">
                                <span>
                                    <img src="{{ asset('/images/icon-delete.svg') }}" style="padding-top: 7px;">
                                </span>
                            </a>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    @endif
    </div>

    <div class="listar-data">
        {!! $dTitlesRows->render() !!}
    </div>

    <!--
    <h1>FILAS</h1>
    @foreach($dTitlesRows as $dTitlesRow)
        {{ $dTitlesRow->row_id }}
    @endforeach
        -->


@include('partials.alert-ajax')
@endsection

@include('admin.colections.complements.partials.alert-delete')

{!! Form::open(['route' => ['admin.colecciones.form.data.list.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
{!! Form::close() !!}

{!! Form::open(['route' => ['admin.colecciones.form.data.list.update.input', ':USER_ID'], 'method' => 'PUT', 'id' => 'form-update']) !!}
    {!! Form::text('content', old('content'), ['id' => 'contentUpdate', 'class' => 'form-control']) !!}
{!! Form::close() !!}

@section('scripts')
    <script src="{{ asset('/js/codizer-alert.js') }}"></script>
    <script src="{{ asset('/js/codizer-validate.js') }}"></script>
    <script src="{{ asset('/js/lists.js') }}"></script>
@endsection