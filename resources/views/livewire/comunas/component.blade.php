 <div class="row layout-top-spacing">    
        <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-spacing">
           @if($action == 1)                

           <div class="widget-content-area br-4">
               <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 text-center">
                        <h5><b>Maestro Comunas</b></h5>
                    </div> 
                </div>
            </div>
            @include('common.search')
            @include('common.alerts')

            <div class="table-responsive">
                <table class="table table-bordered table-hover table-striped table-checkable table-highlight-head mb-4">
                    <thead>
                        <tr>                                                   
                            <th class="text-center">ID</th>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">IMÁGEN</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($info as $r)
                       <tr>

                        <td class="text-center"><p class="mb-0">{{$r->id}}</p></td>
                        <td class="text-center">{{$r->nombre}}</td>
                        <td class="text-center"><img class="rounded" src="images/{{$r->imagen}}" alt="" height="40"></td>
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
    @include('livewire.comunas.form')     
    @endif  
</div>

<script type="text/javascript">

    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('fileChoosen', () => {
            let inputField = document.getElementById('image')
            let file = inputField.files[0]
            let reader = new FileReader();
            reader.onloadend = ()=> {
                window.livewire.emit('fileUpload', reader.result)
            }
            reader.readAsDataURL(file);
        }); 

    });

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
