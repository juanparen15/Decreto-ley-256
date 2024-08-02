@extends('voyager::master')

@section('page_title', __('voyager::generic.' . (isset($dataTypeContent->id) ? 'edit' : 'add')) . ' ' .
    $dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.' . (isset($dataTypeContent->id) ? 'edit' : 'add')) . ' ' . $dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form"
            action="@if (!is_null($dataTypeContent->getKey())) {{ route('voyager.' . $dataType->slug . '.update', $dataTypeContent->getKey()) }}@else{{ route('voyager.' . $dataType->slug . '.store') }} @endif"
            method="POST" enctype="multipart/form-data" autocomplete="off">
            <!-- PUT Method if we are editing -->
            @if (isset($dataTypeContent->id))
                {{ method_field('PUT') }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-bordered">
                        {{-- <div class="panel"> --}}
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-body">
                            @if (Auth::user()->role_id == '1')
                                <div class="form-group">
                                    <h5>{{ __('Estado') }}</h5>
                                    <div class="toggle-switch">
                                        <input type="checkbox" id="estado" name="estado"
                                            {{ old('estado', $dataTypeContent->estado ?? '') == 'Activo' ? 'checked' : '' }}>
                                    </div>
                                </div>
                            @endif
                            @php
                                if (isset($dataTypeContent->tipo_documento)) {
                                    $selected_documento = $dataTypeContent->tipo_documento;
                                } else {
                                    $selected_documento = null; // Cambia '' por null
                                }
                            @endphp
                            <div class="form-group">
                                <h5 for="tipo_documento">{{ __('Tipo Documento') }}</h5>
                                <select class="form-control select2" id="tipo_documento" name="tipo_documento">
                                    <option value="" disabled selected>Seleccione un Tipo de Documento</option>
                                    @foreach (App\Voyager\Voyager::tipo_documento() as $tipo_documento)
                                        <option value="{{ $tipo_documento->id }}"
                                            {{ $tipo_documento->id == $selected_documento ? 'selected' : '' }}>
                                            {{ $tipo_documento->tipo_documento }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <h5 for="numero_documento">{{ __('Número de Documento') }}</h5>
                                <input type="text" class="form-control" id="numero_documento" name="numero_documento"
                                    placeholder="{{ __('Número de Documento') }}"
                                    value="{{ old('numero_documento', $dataTypeContent->numero_documento ?? '') }}">
                            </div>
                            <div class="form-group">
                                <h5 for="name">{{ __('Primer Nombre') }}</h5>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="{{ __('Primer Nombre') }}"
                                    value="{{ old('name', $dataTypeContent->name ?? '') }}">
                            </div>
                            <div class="form-group">
                                <h5 for="segundo_nombre">{{ __('Segundo Nombre') }}</h5>
                                <input type="text" class="form-control" id="segundo_nombre" name="segundo_nombre"
                                    placeholder="{{ __('Segundo Nombre') }}"
                                    value="{{ old('segundo_nombre', $dataTypeContent->segundo_nombre ?? '') }}">
                            </div>
                            <div class="form-group">
                                <h5 for="primer_apellido">{{ __('Primer Apellido') }}</h5>
                                <input type="text" class="form-control" id="primer_apellido" name="primer_apellido"
                                    placeholder="{{ __('Primer Apellido') }}"
                                    value="{{ old('primer_apellido', $dataTypeContent->primer_apellido ?? '') }}">
                            </div>
                            <div class="form-group">
                                <h5 for="segundo_apellido">{{ __('Segundo Apellido') }}</h5>
                                <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido"
                                    placeholder="{{ __('Segundo Apellido') }}"
                                    value="{{ old('segundo_apellido', $dataTypeContent->segundo_apellido ?? '') }}">
                            </div>
                            <div class="form-group">
                                <h5 for="fecha_nacimiento">{{ __('Fecha de Nacimiento') }}</h5>
                                <input type="text" class="form-control datepicker" id="fecha_nacimiento"
                                    name="fecha_nacimiento" placeholder="{{ __('Fecha de Nacimiento') }}"
                                    value="{{ old('fecha_nacimiento', $dataTypeContent->fecha_nacimiento ?? '') }}">
                            </div>
                            <div class="form-group">
                                <h5 for="telefono">{{ __('Teléfono') }}</h5>
                                <input type="number" class="form-control" id="telefono" name="telefono"
                                    placeholder="{{ __('Teléfono') }}"
                                    value="{{ old('telefono', $dataTypeContent->telefono ?? '') }}">
                            </div>
                            <div class="form-group">
                                <h5 for="segundo_telefono">{{ __('Segundo Teléfono') }}</h5>
                                <input type="number" class="form-control" id="segundo_telefono" name="segundo_telefono"
                                    placeholder="{{ __('Segundo Teléfono') }}"
                                    value="{{ old('segundo_telefono', $dataTypeContent->segundo_telefono ?? '') }}">
                            </div>

                            @php
                                if (isset($dataTypeContent->departamento)) {
                                    $selected_departamentos = $dataTypeContent->departamento;
                                } else {
                                    $selected_departamentos = null; // Cambia '' por null
                                }
                            @endphp
                            <div class="form-group">
                                <h5 for="departamento">{{ __('Departamento de Nacimiento') }}</h5>
                                <select class="form-control select2" id="departamento" name="departamento">
                                    <option value="" disabled selected>Seleccione un Departamento</option>
                                    @foreach (App\Voyager\Voyager::departamentos() as $departamento)
                                        <option value="{{ $departamento->id }}"
                                            {{ $departamento->id == $selected_departamentos ? 'selected' : '' }}>
                                            {{ $departamento->departamento }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @php
                                if (isset($dataTypeContent->municipio)) {
                                    $selected_municipios = $dataTypeContent->municipio;
                                } else {
                                    $selected_municipios = null; // Cambia '' por null
                                }
                            @endphp
                            <div class="form-group">
                                <h5 for="municipio">{{ __('Municipio de Nacimiento') }}</h5>
                                <select class="form-control select2" id="municipio" name="municipio">
                                    <option value="" disabled selected>Seleccione un Municipio</option>
                                    @foreach (App\Voyager\Voyager::municipios() as $municipio)
                                        <option value="{{ $municipio->id }}"
                                            {{ $municipio->id == $selected_municipios ? 'selected' : '' }}>
                                            {{ $municipio->municipio }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @if (Auth::user()->role_id == '1')
                                @php
                                    if (isset($dataTypeContent->grado)) {
                                        $selected_grado = $dataTypeContent->grado;
                                    } else {
                                        $selected_grado = null; // Cambia '' por null
                                    }
                                @endphp
                                <div class="form-group">
                                    <h5 for="grado">{{ __('Grado') }}</h5>
                                    <select class="form-control select2" id="grado" name="grado">
                                        <option value="" disabled selected>Seleccione un Grado</option>
                                        @foreach (App\Voyager\Voyager::grados() as $grado)
                                            <option value="{{ $grado->id }}"
                                                {{ $grado->id == $selected_grado ? 'selected' : '' }}>
                                                {{ $grado->nombre_grado }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @php
                                if (isset($dataTypeContent->genero)) {
                                    $selected_genero = $dataTypeContent->genero;
                                } else {
                                    $selected_genero = null; // Cambia '' por null
                                }
                            @endphp
                            <div class="form-group">
                                <h5 for="genero">{{ __('Género') }}</h5>
                                <select class="form-control select2" id="genero" name="genero">
                                    <option value="" disabled selected>Seleccione un Género</option>
                                    @foreach (App\Voyager\Voyager::genero() as $genero)
                                        <option value="{{ $genero->id }}"
                                            {{ $genero->id == $selected_genero ? 'selected' : '' }}>
                                            {{ $genero->genero }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <h5 for="email">{{ __('voyager::generic.email') }}</h5>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="{{ __('voyager::generic.email') }}"
                                    value="{{ old('email', $dataTypeContent->email ?? '') }}">
                            </div>

                            <div class="form-group">
                                <h5 for="password">{{ __('voyager::generic.password') }}</h5>
                                @if (isset($dataTypeContent->password))
                                    <br>
                                    <small>{{ __('voyager::profile.password_hint') }}</small>
                                @endif
                                <input type="password" class="form-control" id="password" name="password"
                                    value="" autocomplete="new-password">
                            </div>

                            @can('editRoles', $dataTypeContent)
                                <div class="form-group">
                                    <h5 for="default_role">{{ __('voyager::profile.role_default') }}</h5>
                                    @php
                                        $dataTypeRows =
                                            $dataType->{isset($dataTypeContent->id) ? 'editRows' : 'addRows'};

                                        $row = $dataTypeRows
                                            ->where('field', 'user_belongsto_role_relationship')
                                            ->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                                <div class="form-group">
                                    <h5 for="additional_roles">{{ __('voyager::profile.roles_additional') }}</h5>
                                    @php
                                        $row = $dataTypeRows
                                            ->where('field', 'user_belongstomany_role_relationship')
                                            ->first();
                                        $options = $row->details;
                                    @endphp
                                    @include('voyager::formfields.relationship')
                                </div>
                            @endcan
                            @php
                                if (isset($dataTypeContent->locale)) {
                                    $selected_locale = $dataTypeContent->locale;
                                } else {
                                    $selected_locale = config('app.locale', 'en');
                                }

                            @endphp
                            <div class="form-group">
                                <h5 for="locale">{{ __('voyager::generic.locale') }}</h5>
                                <select class="form-control select2" id="locale" name="locale">
                                    @foreach (Voyager::getLocales() as $locale)
                                        <option value="{{ $locale }}"
                                            {{ $locale == $selected_locale ? 'selected' : '' }}>{{ $locale }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-body">
                            <div class="form-group">
                                @if (isset($dataTypeContent->avatar))
                                    <img src="{{ filter_var($dataTypeContent->avatar, FILTER_VALIDATE_URL) ? $dataTypeContent->avatar : Voyager::image($dataTypeContent->avatar) }}"
                                        style="width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:10px;" />
                                @endif
                                <input type="file" data-name="avatar" name="avatar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right save">
                {{ __('voyager::generic.save') }}
            </button>
        </form>
        <div style="display:none">
            <input type="hidden" id="upload_url" value="{{ route('voyager.upload') }}">
            <input type="hidden" id="upload_type_slug" value="{{ $dataType->slug }}">
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function() {
            $('.toggleswitch').bootstrapToggle();
        });
    </script>

    <script>
        var departamento = $('#departamento');
        var municipio = $('#municipio');

        $(document).ready(function() {
            departamento.change(function() {
                var departamento = $(this).val();
                // console.log("Cambio en departamentos detectado");
                if (departamento) {
                    $.get('/get-municipios/' + departamento, function(data) {
                        $('#municipio').empty();


                        $('#municipio').append(
                            '<option disabled selected>Seleccione un Municipio</option>'
                        );
                        $.each(data, function(key, value) {
                            $('#municipio').append('<option value="' + value.id +
                                '" name="' + value.id + '">' + value
                                .municipio + '</option>');
                        });
                        // Selecciona automáticamente la primera opción
                        $('#municipio').val($('#municipio option:first').val());
                    });
                } else {
                    // Si no se selecciona ningun departamento, limpia la lista de municipios
                    $('#municipio').empty();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Inicializar el datetimepicker
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd', // Formato de la fecha
                autoclose: true, // Cerrar automáticamente después de seleccionar la fecha
                todayHighlight: true, // Resaltar la fecha actual
                startDate: 'today' // Iniciar desde la fecha actual
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.toggle-switch input[type="checkbox"]').bootstrapToggle({
                on: '{{ __('Activo') }}',
                off: '{{ __('Inactivo') }}',
                size: 'small', // Puedes ajustar el tamaño aquí
                onstyle: 'success', // Estilo para "SI"
                offstyle: 'danger' // Estilo para "NO"
            });
        });
    </script>

@stop
