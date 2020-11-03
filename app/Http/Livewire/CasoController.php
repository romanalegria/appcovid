<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\withPagination;
use App\Paciente;
use App\Caso;

class CasoController extends Component
{
     use WithPagination;

    //properties
    public $fecha_pcr,$resultado_pcr = 'Elegir',$inicio_qrtna,$fin_qrtna,$extension_qrtna,$tto_farmacologico,$observaciones,$paciente = 'Elegir',$pacientes,$usuario;
    public  $selected_id, $search;                          
    public  $action = 1;                                    
    private $pagination = 5;                                
    public  $tipos;
    
    
    public function render()
    {
         $this->pacientes = Paciente::all();  

         if(strlen($this->search) > 0)
        {
            $info = Caso::leftjoin('pacientes as t','t.id','casos.paciente_id')
            ->leftjoin('users as u','u.id','casos.usuario_id')
            ->select('casos.*','t.nombre as paciente')
            ->where('pacientes.nombre','like','%'.$this->search .'%')
            ->paginate($this->pagination);

            return view('livewire.casos.component', [
                'info' => $info
            ]);    
        }
        else {

            $info = Caso::leftjoin('pacientes as t','t.id','casos.paciente_id')
            ->leftjoin('users as u','u.id','casos.usuario_id')
            ->select('casos.*','t.nombre as paciente','u.name as usuario')
            ->orderBy('casos.id','desc')     
            ->paginate($this->pagination);

            return view('livewire.casos.component', [
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
        $this->fecha_pcr = '';
        $this->rut = '';
        $this->resultado_pcr = 'Elegir';
        $this->inicio_qrtna = '';
        $this->fin_qrtna = '';
        $this->extension_qrtna = '';
        $this->tto_farmacologico = '';
        $this->observaciones = '';       
        $this->selected_id = null;       
        $this->action = 1;
        $this->search = '';
        $this->paciente = 'Elegir';
        $this->usuario = '';       
    }

    //buscamos el registro seleccionado y asignamos la info a las propiedades
    public function edit($id)
    {
        $record = Caso::findOrFail($id);
        $this->selected_id = $id;
        $this->fecha_pcr = $record->fecha_pcr;
        $this->resultado_pcr = $record->resultado_pcr;
        $this->inicio_qrtna = $record->inicio_qrtna;
        $this->fin_qrtna = $record->fin_qrtna;
        $this->extension_qrtna = $record->extension_qrtna;
        $this->tto_farmacologico = $record->tto_farmacologico;
        $this->observaciones = $record->observaciones;
        $this->usuario = $record->usuario_id;
        $this->paciente = $record->paciente_id;
        $this->action = 2;

    }


    //método para registrar y/o actualizar registros
    public function StoreOrUpdate()
    {           

        $this->validate([
            'fecha_pcr' => 'required', 
            'paciente' => 'not_in:Elegir'
        ]);     
         

        if($this->selected_id <= 0) {        

            $contacto =  Caso::create([
                'fecha_pcr' => $this->fecha_pcr,            
                'resultado_pcr' => $this->resultado_pcr,            
                'inicio_qrtna' => $this->inicio_qrtna,            
                'fin_qrtna' => $this->fin_qrtna,
                'extension_qrtna' => $this->extension_qrtna,
                'tto_farmacologico' => $this->tto_farmacologico,
                'observaciones' => $this->observaciones,
                'usuario_id' => Auth::id(),
                'paciente_id' => $this->paciente
            ]);


        }
        else 
        {

            $contacto = Caso::find($this->selected_id);
            $contacto->update([
                'fecha_pcr' => $this->fecha_pcr,            
                'resultado_pcr' => $this->resultado_pcr,            
                'inicio_qrtna' => $this->inicio_qrtna,            
                'fin_qrtna' => $this->fin_qrtna,
                'extension_qrtna' => $this->extension_qrtna,
                'tto_farmacologico' => $this->tto_farmacologico,
                'observaciones' => $this->observaciones,
                'usuario_id' => Auth::id(),
                'paciente_id' => $this->paciente
            ]);                    


        }
        

        if($this->selected_id) 
             $this->emit('msgok', 'Caso Actualizado');
        else
             $this->emit('msgok', 'Caso Creado con éxito');


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
