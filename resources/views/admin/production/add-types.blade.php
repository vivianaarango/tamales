@extends('brackets/admin-ui::admin.layout.default')

<head>
    <title>Agregar Tipo</title>
    <link rel="icon" href="{{URL::asset('images/logo-tamales.png')}}"/>
</head>

@section('body')
    <div class="container-xl">
        <div class="card">
            <form id="form-basic" method="post" action="{{ url('admin/production/store-type') }}">
                <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                <form class="form-horizontal form-create">
                    <div class="card-header">
                        <i class="fa fa-plus"></i>&nbsp; Agregar Tipo
                    </div>

                    <div class="card-body">
                        <div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': this.fields.name && this.fields.name.valid }">
                            <div class="col-md-2"></div>
                            <div :class="'col-md-4 col-md-9 col-xl-7'">
                                <input type="text" required class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': this.fields.name && this.fields.name.valid}" id="name" name="name" placeholder="Nombre">
                                <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-download"></i>
                            &nbsp; Agregar
                        </button>
                    </div>
                </form>
            </form>
        </div>
    </div>
    <admin-user-listing
            :data="{{ $data->toJson() }}"
            :activation="!!'{{ $activation }}'"
            :url="'{{ $url }}'"
            inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body" v-cloak>
                        <table class="col-md-8 col-md-offset-2 table table-hover table-listing">
                            <thead>
                            <tr>
                                <th is='sortable' :column="'id'">ID</th>
                                <th is='sortable' :column="'name'">Tipo de tamal</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(item, index) in collection">
                                <td >@{{ item.id }}</td>
                                <td >@{{ item.name }}</td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="no-items-found" v-if="!collection.length > 0">
                            <i class="icon-magnifier"></i>
                            <h3>No se encontraron registros</h3>
                            <p>Intenta cambiando los filtros o agregando uno nuevo</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-user-listing>
@endsection
