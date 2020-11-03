<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $fillable = [
        'rut', 'nombre', 'sexo','edad','telefono','movil','direccion','email','paciente_id'
    ];
}
