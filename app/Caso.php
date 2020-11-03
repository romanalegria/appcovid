<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Caso extends Model
{
   protected $fillable = [
        'fecha_pcr', 'resultado_pcr', 'inicio_qrtna','fin_qrtna', 'extension_qrtna','tto_farmacologico','observaciones','paciente_id','usuario_id'
    ];
}
