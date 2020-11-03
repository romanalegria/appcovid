<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\withPagination;
use App\Paciente;

class PacienteController extends Component
{
   use WithPagination;

    //properties
    public  $sexo ='Elegir',$nombre,$rut,$edad,$telefono,$movil,$direccion,$email;
    public  $selected_id, $search;                          
    public  $action = 1;                                    
    private $pagination = 5;                                
    public  $tipos;
    
    
    public function render()
    {

        if(strlen($this->search) > 0)
        {
            return view('livewire.pacientes.component', [
                'info' => Paciente::where('nombre', 'like', '%' .  $this->search . '%')
                ->paginate($this->pagination),
            ]);
        }
        else {

            $info = Paciente::orderBy('id','desc')          
            ->paginate($this->pagination);

            return view('livewire.pacientes.component', [
                'info' => $info,
            ]);
        }
    }

    //permite la búsqueda cuando se navega entre el paginado
    public function updatingSearch()
    {
        $this->gotoPage(1);
    }

    //activa la vista edición o creación
    public function doAction($action)
    {
        $this->resetInput();
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
        //$this->jerarquia =null;
    }

    //buscamos el registro seleccionado y asignamos la info a las propiedades
    public function edit($id)
    {
        $record = Paciente::findOrFail($id);
        $this->selected_id = $id;
        $this->nombre = $record->nombre;
        $this->telefono = $record->telefono;
        $this->movil = $record->movil;
        $this->email = $record->email;
        $this->direccion = $record->direccion;
        $this->sexo = $record->sexo;
        $this->edad = $record->edad;
        $this->rut = $record->rut;
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
            'direccion' => 'required'
        ]);     


        if($this->selected_id <= 0) {        

            $user =  Paciente::create([
                'nombre' => $this->nombre,            
                'telefono' => $this->telefono,            
                'movil' => $this->movil,            
                'sexo' => $this->sexo,
                'email' => $this->email,
                'direccion' => $this->direccion,
                'edad' => $this->edad,
                'rut' => $this->rut
            ]);


        }
        else 
        {

            $user = Paciente::find($this->selected_id);
            $user->update([
                'nombre' => $this->nombre,            
                'telefono' => $this->telefono,            
                'movil' => $this->movil,            
                'sexo' => $this->sexo,
                'email' => $this->email,
                'direccion' => $this->direccion,
                'edad' => $this->edad,
                'rut' => $this->rut
            ]);                    


        }
        

        if($this->selected_id) 
             $this->emit('msgok', 'Paciente Actualizado');
        else
             $this->emit('msgok', 'Paciente Creado');


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
            $record = Paciente::where('id', $id);
            $record->delete();
            $this->resetInput();
        }

    }
}
