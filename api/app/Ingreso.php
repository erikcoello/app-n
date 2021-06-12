<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    
    protected $table = 'ingreso';
    protected $primary_key = 'id_ingreso';
    public $timestamps = false;

}
