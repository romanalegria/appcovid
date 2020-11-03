<div class="widget-content-area">
    <div class="widget-one">
        @include('common.messages')

        <div class="row">
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="">Nombre</label>
                <input type="text" wire:model.lazy="nombre" class="form-control" placeholder="nombre">
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                <label for="">Comuna</label>
                <select name="" id="" wire:model="comuna">
                    <option value="Elegir" disabled="">Elegir</option>
                     @foreach($comunas as $c)
                        <option value="{{$c->id}}">{{$c->nombre}}</option>
                    @endforeach
                </select>
            </div>

            <div class="row">
                
            </div>

            <div class="col-lg-5 mt-2 text-left">
                <button type="button" class="btn btn-dark mr-1" wire:click="doAction(1)">
                    <i class="mbri-left"></i>
                    Regresar
                </button>
                <button type="button" class="btn btn-primary ml-2" wire:click.prevent="StoreOrUpdate()">
                    <i class="mbri-success"></i>
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>
