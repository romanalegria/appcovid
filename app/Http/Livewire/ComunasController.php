<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Comuna;
use Livewire\WithPagination;

class ComunasController extends Component
{
 
    use WithPagination;

    //propiedades publica
    public $nombre; //campo tabla comunas
    public $selected_id, $search;
    public $action = 1; //permite movernos entre formularios 
    private $pagination = 5;


    //es el primero que se ejecuta al iniciar el componente
    public function mount()
    {
        //inicializar variables / data
    }

    //se ejecuta despues del mount
    public function render()
    {
        if (strlen($this->search) > 0)
        {
            $info = Comuna::where('nombre','like', '%'. $this->search .'%' )->paginate($this->pagination);
                 return view('livewire.comunas.component',['info' => $info]);
        }else
        {
             $info = Comuna::paginate($this->pagination);
            return view('livewire.comunas.component', ['info' => $info]);
        }
        
    }

    //para busquedas con paginacion
    public function updatingSearch():void 
    {
        $this->gotoPage(1);
    }

    //movenos entre formularios
    public function doAction($action)
    {
        $this->action = $action;

    }

    //limpiar todas la variables
    public function resetInput()
    {
        $this->nombre = '';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';

    }

    //mostrar la info del registro a editar
    public function edit($id)
    {
        $record = Comuna::findOrFail($id);
        $this->nombre = $record->nombre;
        $this->selected_id = $record->id;
        $this->action = 2;
    }


    //altas y actualizaciones
    public function StoreOrUpdate()
    {
         //validación campos requeridos
        $this->validate([
        'nombre' => 'required|min:3' //validamos que nombre no sea vacío o nulo y que tenga al menos 4 caracteres
      ]);

         //valida si existe otra comuna con el mismo nombre (edicion de comunas)
        if($this->selected_id > 0) {
          $existe = Comuna::where('nombre', $this->nombre)
          ->where('id', '<>', $this->selected_id)
          ->select('nombre')
          ->get();

          if( $existe->count() > 0) {
           session()->flash('msg-error', 'Ya existe la Comuna');
           $this->resetInput();
           return;
         }
       }        
       else 
       {
        //valida si existe otra comuna con el mismo nombre (nuevos registros)
        $existe = Comuna::where('nombre', $this->nombre)
        ->select('nombre')
        ->get();

        if($existe->count() > 0 ) {
         session()->flash('msg-error', 'Ya existe una Comuna con ese nombre');
         $this->resetInput();
         return;
        } 

        }

         if($this->selected_id <= 0) 
         {
            //creamos el registro
          $tipo =  Comuna::create([
            'nombre' => $this->nombre         
          ]);
          
         }
        else 
        {   
            //buscamos la comuna
          $record = Comuna::find($this->selected_id);
            //actualizamos el registro
          $record->update([
           'nombre' => $this->nombre
         ]);                    
          

        }


        //enviamos feedback al usuario
        if($this->selected_id) 
         session()->flash('message', 'Comuna Actualizada');
        else
         session()->flash('message', 'Comuna Creada');

        //limpiamos las propiedades
        $this->resetInput();
    }

   //escuchar eventos y ejecutar acción solicitada
    protected $listeners = [
      'deleteRow'     => 'destroy',
      'fileUpload' =>'handleFileUpload' 
    ];  

    public function handleFileUpload($imageData)
    {
      $this->image = $imageData;
    }


    //método para eliminar un registro dado
    public function destroy($id)
    {
        if ($id) { //si es un id válido
            $record = Comuna::where('id', $id); //buscamos el registro
            $record->delete(); //eliminamos el registro
            $this->resetInput(); //limpiamos las propiedades
          }

    }


}
