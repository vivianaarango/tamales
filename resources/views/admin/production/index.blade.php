@extends('brackets/admin-ui::admin.layout.default')

<head>
    <title>Producción</title>
    <link rel="icon" href="{{URL::asset('images/logo-tamales.png')}}"/>
</head>

@section('body')
    <admin-user-listing
        :data="{{ $data->toJson() }}"
        :activation="!!'{{ $activation }}'"
        :url="'{{ url('admin/production-list') }}'"
        inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>  Producción
                        <a style="color: white" class="btn btn-success btn-sm pull-right m-b-0 ml-2" href="{{ url('admin/production/export') }}" role="button"><i class="fa fa-file-excel-o"></i>&nbsp;Exportar</a>
                        <a class="btn btn-primary btn-spinner btn-sm pull-right m-b-0" href="{{ url('admin/production-create') }}" role="button"><i class="fa fa-plus"></i>&nbsp; Agregar producción</a>
                    </div>
                    <div class="card-body" v-cloak>
                        <form @submit.prevent="">
                            <div class="row justify-content-md-between">
                                <div class="col col-lg-7 col-xl-5 form-group">
                                    <div class="input-group">
                                        <input class="form-control" placeholder="Buscar" v-model="search" @keyup.enter="filter('search', $event.target.value)" />
                                        <span class="input-group-append">
                                            <button type="button" class="btn btn-primary" @click="filter('search', search)"><i class="fa fa-search"></i>&nbsp; Buscar</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-auto form-group ">
                                    <select class="form-control" v-model="pagination.state.per_page">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>

                            </div>
                        </form>
                        <table class="table table-hover table-listing">
                            <thead>
                                <tr>
                                    <th is='sortable' :column="'id'">ID</th>
                                    <th is='sortable' :column="'lot'">Lote</th>
                                    <th is='sortable' :column="'marmitas'">Número de Marmitas</th>
                                    <th is='sortable' :column="'broken'">Rotos</th>
                                    <th is='sortable' :column="'total'">Total</th>
                                    <th is='sortable' :column="'date'">Fecha</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in collection">
                                    <td >@{{ item.id }}</td>
                                    <td >@{{ item.lot }}</td>
                                    <td >@{{ item.marmitas }}</td>
                                    <td >@{{ item.broken }}</td>
                                    <td >@{{ item.total }}</td>
                                    <td >@{{ item.date }}</td>
                                    <td>
                                        <div class="row no-gutters">
                                            <div class="col-auto">
                                                <a class="btn btn-sm btn-spinner btn-link-documents" :href="item.resource_url+'/edit'" title="Editar" role="button"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row" v-if="pagination.state.total > 0">
                            <div class="col-sm">
                            </div>
                            <div class="col-sm-auto">
                                <pagination></pagination>
                            </div>
                        </div>
	                   <div class="no-items-found" v-if="!collection.length > 0">
		                    <i class="icon-magnifier"></i>
                            <h3>No se encontraron registros</h3>
                            <p>Intenta cambiando los filtros o agregando uno nuevo</p>
                            <a class="btn btn-primary btn-spinner" href="{{ url('admin/production-create') }}" role="button"><i class="fa fa-plus"></i>&nbspAgregar producción</a>
	                    </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-user-listing>

@endsection
