<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semestre extends Model
{
    protected $table = 'semestre';
    protected $primary_key = 'id_semestre';
    public $timestamps = false;
}
