@extends('brackets/admin-ui::admin.layout.default')

<head>
    <title>Agregar producción</title>
    <link rel="icon" href="{{URL::asset('images/logo-tamales.png')}}"/>
</head>

@section('body')

    <div class="container-xl">
        <div class="card">
            <form id="form-basic" method="post" action="{{ url('admin/production-store') }}">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <form class="form-horizontal form-create">
                    <div class="card-header">
                        <i class="fa fa-plus"></i>&nbsp; Agregar producción
                    </div>

                    <div class="card-body">
                        @include('admin.production.components.form-elements')
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary" :disabled="submiting">
                            <i class="fa" :class="submiting ? 'fa-spinner' : 'fa-download'"></i>
                            &nbsp; Guardar
                        </button>
                    </div>
                </form>
            </form>
        </div>
    </div>

@endsection
