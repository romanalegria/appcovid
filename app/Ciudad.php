<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    protected $table = 'ciudades';

    protected $fillable= ['nombre','comuna_id'];

    //ralaciones entre ciudades -> comunas
}
