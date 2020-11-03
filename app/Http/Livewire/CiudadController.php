<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\withPagination;
use App\Ciudad;
use App\Comuna;


class CiudadController extends Component
{
    //paginacion
    use WithPagination;

    //propiedades
    public $comuna ='Elegir', $nombre, $comunas;
    public $selected_id, $search;
    public $action = 1, $pagination = 5;


    public function render()
    {
        $this->comunas = Comuna::all();        

        if (strlen($this->search) > 0) 
        {
            $info = Ciudad::leftjoin('comunas as t','t.id','ciudades.comuna_id')
            ->select('ciudades.*','t.nombre as comuna')
            ->where('ciudades.nombre','like','%'.$this->search .'%')
            ->paginate($this->pagination);

            return view('livewire.ciudades.component', [
                'info' => $info
            ]);    
        }
        else
        {
            $info = Ciudad::leftjoin('comunas as t','t.id','ciudades.comuna_id')
            ->select('ciudades.*','t.nombre as comuna')
            ->orderBy('ciudades.id','desc')     
            ->paginate($this->pagination);

            return view('livewire.ciudades.component', [
                'info' => $info
            ]);
        }

        
    }

    //para busquedas con paginacion
    public function updatingSearch():void 
    {
        $this->gotoPage(1);
    }

    //movernos entre formularios
    public function doAction($action)
    {
        $this->action = $action;

    }

    //limpiar todas la variables
    public function resetInput()
    {
        $this->nombre = '';
        $this->ciudad ='Elegir';
        $this->selected_id = null;
        $this->action = 1;
        $this->search = '';

    }

    //mostrar la info del registro a editar
    public function edit($id)
    {
        $record = Ciudad::find($id);
        $this->selected_id = $record->id;
        $this->comuna = $record->comuna_id;
        $this->nombre = $record->nombre;        
        $this->action = 2;
    }

    //altas y actualizaciones
    public function StoreOrUpdate()
    {
        //validar combo no sea elegir
        $this->validate([
            'comuna' => 'not_in:Elegir'
        ]);

         //validación campos requeridos
        $this->validate([
        'comuna' => 'required',
        'nombre' => 'required|min:3' //validamos que nombre no sea vacío o nulo y que tenga al menos 4 caracteres
      ]);

         //valida si existe otra ciudad con el mismo nombre (edicion de ciudades)
        if($this->selected_id <= 0) {
          $ciudad = Ciudad::create([
            'comuna_id' => $this->comuna, 
            'nombre'=> $this->nombre
          ]);   
       }        
       else 
       {
            $record = Ciudad::find($this->selected_id);
            $record->update([
                'comuna_id' => $this->comuna, 
                'nombre'=> $this->nombre
            ]);
       } 

        

        //enviamos feedback al usuario
        if($this->selected_id)
            $this->emit('msgok','Ciudad actualizado con éxito');
         else       
            $this->emit('msgok','Ciudad creada con éxito');
       

        //limpiamos las propiedades
        $this->resetInput();
    }

    //escuchar eventos y ejecutar acción solicitada
    protected $listeners = [
      'deleteRow'     => 'destroy'      
    ];  



     //método para eliminar un registro dado
    public function destroy($id)
    {
        if ($id)
        { //si es un id válido
            $record = Ciudad::where('id', $id); //buscamos el registro
            $record->delete(); //eliminamos el registro
            $this->resetInput(); //limpiamos las propiedades
            $this->emit('msgok','Registro eliminado con éxito');
         }

    }


}
