<div class="form-group row align-items-center" :class="{'has-danger': errors.has('date'), 'has-success': this.fields.date && this.fields.date.valid }">
    <label for="date" class="col-form-label text-md-right" :class="'col-md-3'">Fecha</label>
    <div :class="'col-md-9 col-xl-7'">
        <input disabled value="{{ $production['date'] }}" required type="date" class="form-control" :class="{'form-control-danger': errors.has('date'), 'form-control-success': this.fields.date && this.fields.date.valid}" id="date" name="date" placeholder="Fecha">
        <div v-if="errors.has('date')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('date') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('lot'), 'has-success': this.fields.lot && this.fields.lot.valid }">
    <label for="lot" class="col-form-label text-md-right" :class="'col-md-3'">Lote</label>
    <div :class="'col-md-9 col-xl-7'">
        <input disabled value="{{ $production['lot'] }}" required minlength="1" type="number" class="form-control" :class="{'form-control-danger': errors.has('lot'), 'form-control-success': this.fields.lot && this.fields.lot.valid}" id="lot" name="lot" placeholder="Lote">
        <div v-if="errors.has('lot')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('lot') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('marmitas'), 'has-success': this.fields.marmitas && this.fields.marmitas.valid }">
    <label for="marmitas" class="col-form-label text-md-right" :class="'col-md-3'">Número de Marmitas</label>
    <div :class="'col-md-9 col-xl-7'">
        <input disabled value="{{ $production['marmitas'] }}" required minlength="1" type="number" class="form-control" :class="{'form-control-danger': errors.has('marmitas'), 'form-control-success': this.fields.marmitas && this.fields.marmitas.valid}" id="marmitas" name="marmitas" placeholder="Número de Marmitas">
        <div v-if="errors.has('marmitas')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('marmitas') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('broken'), 'has-success': this.fields.broken && this.fields.broken.valid }">
    <label for="broken" class="col-form-label text-md-right" :class="'col-md-3'">Tamales Rotos</label>
    <div :class="'col-md-9 col-xl-7'">
        <input value="{{ $production['broken'] }}" type="number" class="form-control" :class="{'form-control-danger': errors.has('broken'), 'form-control-success': this.fields.broken && this.fields.broken.valid}" id="broken" name="broken" placeholder="Tamales Rotos">
        <div v-if="errors.has('broken')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('broken') }}</div>
    </div>
</div>

<div class="card-header">
    <i class="fa fa-plus"></i>&nbsp; Agregar tamales por tipo
</div>
<div class="card-body">
    @foreach ($types as $item)
        <div class="form-group row align-items-center">
            <label for="{{ $item->name }}" class="col-form-label text-md-right" :class="'col-md-3'">{{ $item->name }}</label>
            <div :class="'col-md-9 col-xl-7'">
                <input value="{{ $item->quantity }}" id="{{ $item->name }}" name="{{ $item->name }}" type="number" class="form-control"  placeholder="{{ $item->name }}">
            </div>
        </div>
    @endforeach
</div>
