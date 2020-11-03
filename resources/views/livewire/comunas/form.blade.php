<div class="row layout-top-spacing">

    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
        <div class="widget-content-area br-4">
            <div class="widget-one">

                <h5>
                   <b>  
                    @if($selected_id ==0)       
                    Crear Nueva Comuna
                    @else       
                    Editar Comuna
                    @endif  
                </b>
            </h5>

            @include('common.messages')


            <div class="row">                               
               <div class="col-sm-12 col-lg-8 col-md-8 ">
                 <label >Comuna</label>
                  <div class="input-group ">
                     <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Nombre de la comuna" wire:model.lazy="nombre">
                </div>
            </div>
            <div class="form-group col-lg-3 col-md-3 col-sm-12">
            <label >Imágen</label>
            <input type="file" class="form-control text-center" id="image"
            wire:change="$emit('fileChoosen',this)" accept="image/x-png, image/gif, image/jpeg" 
            >
        </div>
        </div>

        <button type="button" wire:click="doAction(1)" class="btn btn-dark mr-1">
            <i class="mbri-left"></i> Regresar
        </button>
        <button type="button"
        wire:click="StoreOrUpdate() " 
        class="btn btn-primary">
        <i class="mbri-success"></i> Guardar
    </button>

</div>
</div>
</div>
</div>
