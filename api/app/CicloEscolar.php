<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciclo_escolar extends Model
{
    protected $table = "ciclo_escolar";
    protected $primary_key = 'id_ciclo';

    public $timestamps = false;
}
