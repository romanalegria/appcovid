 <div class="row layout-top-spacing">    
       <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
       @if($action == 1)                
          
        <div class="widget-content-area br-4">
           <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 text-center">
                    <h5><b>Creación Nuevo Caso</b></h5>
                </div> 
            </div>
        </div>
        @include('common.search')      
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                <thead>
                    <tr>     
                        <th class="">N° CAS0</th>                                              
                        <th class="">PACIENTE</th>
                        <th class="">FECHA PCR</th>
                        <th class="">RESULTADO PCR</th>
                        <th class="">INICIO CUARENTENA</th>
                        <th class="">FIN CUARENTENA</th>
                        <th class="">EXTENSION CUARENTENA</th>                         
                        <th class="">ATENDIDO POR</th>               
                        <th class="text-center">ACCIONES</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($info as $r)
                   <tr>
                    <td><p class="mb-0">{{$r->id}}</p></td> 
                    <td><p class="mb-0">{{$r->paciente}}</p></td>
                    <td>{{date('d-m-Y',strtotime($r->fecha_pcr))}}</td>
                    <td>{{$r->resultado_pcr}}</td>
                    <td>{{date('d-m-Y',strtotime($r->inicio_qrtna))}}</td>
                    <td>{{date('d-m-Y',strtotime($r->fin_qrtna))}}</td>
                    <td>{{date('d-m-Y',strtotime($r->extension_qrtna))}}</td>                   
                    <td>{{$r->usuario}}</td>                    
                    <td class="text-center">
                        @include('common.actions')
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$info->links()}}
    </div>

</div>     

@elseif($action == 2)
@include('livewire.casos.form')     
@endif  
</div>
<script type="text/javascript">

    function Confirm(id)
    {

       let me = this
       swal({
        title: 'CONFIRMAR',
        text: '¿DESEAS ELIMINAR EL REGISTRO?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        closeOnConfirm: false
    },
    function() {
        console.log('ID', id);
        window.livewire.emit('deleteRow', id)    
        toastr.success('info', 'Registro eliminado con éxito')
        swal.close()   
    })



       
   }



</script>
