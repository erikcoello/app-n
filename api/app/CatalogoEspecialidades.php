<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogoEspecialidades extends Model
{
      protected $table = 'catalogoespecialidades';
    protected $primary_key = 'idEspecialidad';
    public $timestamps = false;
}
