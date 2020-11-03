 <div class="widget-content-area ">
    <div class="widget-one">
        <form>
            @include('common.messages')        

                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 text-center">
                            <h5><b>Creando caso</b></h5>
                        </div> 
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                    <label for="">Paciente</label>
                    <select name="" id="" wire:model="paciente">
                        <option value="Elegir" disabled="">Elegir</option>
                         @foreach($pacientes as $p)
                            <option value="{{$p->id}}">{{$p->nombre}}</option>
                        @endforeach
                    </select>
                </div>
               </div>

               <div class="row">
                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                        <label >Fecha PCR</label>
                        <input wire:model.lazy="fecha_pcr" type="date" class="form-control"  placeholder="fecha pcr">
                    </div>
                
                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                        <label >Resultado PCR</label>
                        <select wire:model="resultado_pcr" class="form-control text-center">
                            <option value="Elegir" disabled="">Elegir</option>                         
                            <option value="Positivo" >Positivo</option>                         
                            <option value="Negativo" >Negativo</option>                         
                        </select>                          
                    </div>

                    <div class="form-group col-lg-4 col-md-4 col-sm-12">
                        <label >Inicio Cuarentena</label>
                        <input wire:model.lazy="inicio_qrtna" type="date" class="form-control"  placeholder="inicio cuarentena">
                    </div>
               </div>
                        
                <div class="row">
                     <div class="form-group col-lg-4 col-md-4 col-sm-12">
                        <label >Fin Cuarentena</label>
                        <input wire:model.lazy="fin_qrtna" type="date" class="form-control"  placeholder="inicio cuarentena">
                    </div>

                     <div class="form-group col-lg-4 col-md-4 col-sm-12">
                        <label >Extensión Cuarentena</label>
                        <input wire:model.lazy="extension_qrtna" type="date" class="form-control"  placeholder="inicio cuarentena">
                    </div>
                </div>  

                <div class="row">
                     <div class="form-group col-lg-4 col-md-4 col-sm-12">
                        <label >Tratamiento Farmacologíco</label>
                        <textarea wire:model.lazy="tto_farmacologico" rows="4" cols="50" placeholder="descripción tratamiento">
                            
                        </textarea>
                       
                    </div>

                     <div class="form-group col-lg-4 col-md-4 col-sm-12">
                        <label >Observaciones</label>
                        <textarea wire:model.lazy="observaciones" rows="4" cols="50" placeholder="descripción tratamiento">
                            
                        </textarea>
                       
                    </div>
                </div>
               
            
                
            
            <div class="row ">
                <div class="col-lg-5 mt-2  text-left">
                    <button type="button" wire:click="doAction(1)" class="btn btn-dark mr-1">
                        <i class="mbri-left"></i> Regresar
                    </button>
                    <button type="button"
                        wire:click.prevent="StoreOrUpdate() " 
                        class="btn btn-primary ml-2">
                        <i class="mbri-success"></i> Guardar
                    </button>
            </div>
        </div>
    </form>
 </div>
</div>
