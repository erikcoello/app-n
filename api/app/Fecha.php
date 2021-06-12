<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    protected $table = 'pagos';
    protected $primary_key = 'id_inre';
    protected $guarded = ['id_inre'];
    public $timestamps = false;
}
