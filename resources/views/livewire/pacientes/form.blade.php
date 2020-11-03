 <div class="widget-content-area ">
    <div class="widget-one">
        <form>
            @include('common.messages')        

            <div class="row">
                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >Rut</label>
                    <input wire:model.lazy="rut" type="text" class="form-control"  placeholder="rut">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >Nombre</label>
                    <input wire:model.lazy="nombre" type="text" class="form-control"  placeholder="nombre">
                </div>
                 <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >Edad</label>
                    <input wire:model.lazy="edad" type="number" class="form-control"  placeholder="edad">
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12">                    
                    <label >Teléfono</label>
                    <input wire:model.lazy="telefono" type="text" class="form-control"  placeholder="11 dígitos" maxlength="11">
                                       
                </div>
                
                <div class="form-group col-lg-4 col-md-4 col-sm-12">                    
                    <label >Movil</label>
                    <input wire:model.lazy="movil" type="text" class="form-control"  placeholder="11 dígitos" maxlength="11">               
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12">                    
                    <label >Email</label>
                    <input wire:model.lazy="email" type="text" class="form-control"  placeholder="correo@gmail.com">            
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label >Sexo</label>
                    <select wire:model="sexo" class="form-control text-center">
                        <option value="Elegir" disabled="">Elegir</option>                         
                        <option value="Masculino" >Masculino</option>                         
                        <option value="Femenino" >Femenino</option>                         
                    </select>                          
                </div>                
                <div class="form-group col-sm-12">                  
                    <label >Dirección</label>
                    <input wire:model.lazy="direccion" type="text" class="form-control"  placeholder="dirección...">                
                </div>
                
            </div>
            <div class="row ">
                <div class="col-lg-5 mt-2  text-left">
                    <button type="button" wire:click="doAction(1)" class="btn btn-dark mr-1">
                        <i class="mbri-left"></i> Regresar
                    </button>
                    <button type="button"
                    wire:click="StoreOrUpdate() " 
                    class="btn btn-primary ml-2">
                    <i class="mbri-success"></i> Guardar
                </button>
            </div>
        </div>
    </form>
 </div>
</div>
