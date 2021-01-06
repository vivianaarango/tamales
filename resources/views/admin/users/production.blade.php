@extends('brackets/admin-ui::admin.layout.default')

<head>
    <title>Producción</title>
    <link rel="icon" href="{{URL::asset('images/logo-tamales.png')}}"/>
</head>

@section('body')
    <admin-user-listing
            :data="{{ $data->toJson() }}"
            :activation="!!'{{ $activation }}'"
            :url="'{{ $url }}'"
            inline-template>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>  Producción
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
                                <th is='sortable' :column="'city'">Total</th>
                                <th is='sortable' :column="'location'">Dañados</th>
                                <th is='sortable' :column="'neighborhood'">Tipo</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td >1</td>
                                <td >100</td>
                                <td >12</td>
                                <td >Amarillos</td>
                                <td>
                                    <div class="row no-gutters">
                                        <form class="col" @submit.prevent="">
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td >1</td>
                                <td >100</td>
                                <td >12</td>
                                <td >Gallina</td>
                                <td>
                                    <div class="row no-gutters">
                                        <form class="col" @submit.prevent="">
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td >1</td>
                                <td >150</td>
                                <td >16</td>
                                <td >Costilla</td>
                                <td>
                                    <div class="row no-gutters">
                                        <form class="col" @submit.prevent="">
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"><i class="fa fa-trash-o"></i></button>
                                        </form>
                                    </div>
                                </td>
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