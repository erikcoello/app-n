<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan_estudios extends Model
{
    protected $table = 'plan_estudios';
    protected $primary_key = 'id_plan';
    public $timestamps = false;
}
