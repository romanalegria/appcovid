<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\withPagination;
use App\Paciente;
use App\Contacto;

class ContactoController extends Component
{
     use WithPagination;

    //properties
    public  $sexo ='Elegir',$nombre,$rut,$edad,$telefono,$movil,$direccion,$email,$pacientes,$paciente = 'Elegir';
    public  $selected_id, $search;                          
    public  $action = 1;                                    
    private $pagination = 5;                                
    public  $tipos;
    
    
    public function render()
    {
         $this->pacientes = Paciente::all();   

        if(strlen($this->search) > 0)
        {
            $info = Contacto::leftjoin('pacientes as t','t.id','contactos.paciente_id')
            ->select('contactos.*','t.nombre as paciente')
            ->where('contactos.nombre','like','%'.$this->search .'%')
            ->paginate($this->pagination);

            return view('livewire.contactos.component', [
                'info' => $info
            ]);    
        }
        else {

            $info = Contacto::leftjoin('pacientes as t','t.id','contactos.paciente_id')
            ->select('contactos.*','t.nombre as paciente')
            ->orderBy('contactos.id','desc')     
            ->paginate($this->pagination);

            return view('livewire.contactos.component', [
                'info' => $info
            ]);
        }
    }

    //permite la búsqueda cuando se navega entre el paginado
    public function updatingSearch():void 
    {
        $this->gotoPage(1);
    }

    //activa la vista edición o creación
    public function doAction($action)
    {
       
        $this->action = $action;

    }

    //método para reiniciar variables
    private function resetInput()
    {
        $this->nombre = '';
        $this->rut = '';
        $this->sexo = 'Elegir';
        $this->edad = null;
        $this->telefono = '';
        $this->email = '';
        $this->movil = '';
        $this->direccion = '';       
        $this->selected_id = null;       
        $this->action = 1;
        $this->search = '';
        $this->paciente = 'Elegir';
        //$this->jerarquia =null;
    }

    //buscamos el registro seleccionado y asignamos la info a las propiedades
    public function edit($id)
    {
        $record = Contacto::findOrFail($id);
        $this->selected_id = $id;
        $this->nombre = $record->nombre;
        $this->telefono = $record->telefono;
        $this->movil = $record->movil;
        $this->email = $record->email;
        $this->direccion = $record->direccion;
        $this->sexo = $record->sexo;
        $this->edad = $record->edad;
        $this->rut = $record->rut;
        $this->paciente = $record->paciente_id;
        $this->action = 2;

    }


    //método para registrar y/o actualizar registros
    public function StoreOrUpdate()
    {           

        $this->validate([
            'nombre' => 'required',
            'edad'  => 'required',
            'email'   => 'required|email',
            'sexo'   => 'not_in:Elegir',
            'direccion' => 'required',
            'paciente' => 'not_in:Elegir'
        ]);     


         //valida si existe otro contacto con el mismo correo (edicion de contactos)
        if($this->selected_id > 0) {
          $existe = Contacto::where('email', $this->email)
          ->where('id', '<>', $this->selected_id)
          ->select('email')
          ->get();


          if( $existe->count() > 0) {
           session()->flash('msg-error', 'Correo ya existe asignado a otro contacto');
           $this->resetInput();
           return;
         }
       }        
       else 
       {
        //valida si existe otro contacto con el mismo correo (nuevos registros)
        $existe = Contacto::where('email', $this->email)
        ->select('email')
        ->get();

        if($existe->count() > 0 ) {
         session()->flash('msg-error', 'Correo ya existe asignado a otro contacto');
         $this->resetInput();
         return;
        } 

        }

        if($this->selected_id <= 0) {        

            $contacto =  Contacto::create([
                'nombre' => $this->nombre,            
                'telefono' => $this->telefono,            
                'movil' => $this->movil,            
                'sexo' => $this->sexo,
                'email' => $this->email,
                'direccion' => $this->direccion,
                'edad' => $this->edad,
                'rut' => $this->rut,
                'paciente_id' => $this->paciente
            ]);


        }
        else 
        {

            $contacto = Contacto::find($this->selected_id);
            $contacto->update([
                'nombre' => $this->nombre,            
                'telefono' => $this->telefono,            
                'movil' => $this->movil,            
                'sexo' => $this->sexo,
                'email' => $this->email,
                'direccion' => $this->direccion,
                'edad' => $this->edad,
                'rut' => $this->rut,
                'paciente_id' => $this->paciente
            ]);                    


        }
        

        if($this->selected_id) 
             $this->emit('msgok', 'Contacto Actualizado');
        else
             $this->emit('msgok', 'Contacto Creado');


        $this->resetInput();
    }


    //escuchar eventos y ejecutar acción solicitada
    protected $listeners = [
        'deleteRow'     => 'destroy'        
    ];  


   //método para eliminar un registro dado
    public function destroy($id)
    {
        if ($id) {
            $record = Contacto::where('id', $id);
            $record->delete();
            $this->resetInput();
        }

    }
}
