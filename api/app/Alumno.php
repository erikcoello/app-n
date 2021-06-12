<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Image;
use Str;
use Illuminate\Support\Facades\Storage;
//use Laravel\Scout\Searchable;
class Alumno extends Model
{
    // en caso de no funcionar activar el protected $table = 'alumnos';
    protected $table = 'alumnos';
    protected $primary_key = 'id_alumno';
    //protected $guarded = [id_alumno]; 

   // protected $guarded = ['id_alumno'];
    public $timestamps = false;


     public function scopeId_alumno($query, $id_alumno)
    {
        if($id_alumno)
            return $query->where('id_alumno', 'LIKE', "%$id_alumno%");
    }

    public function scopeMatricula($query, $matricula)
    {
        if($matricula)
            return $query->where('matricula', 'LIKE', "%$matricula%");
    }

   /* public function scopeNombre($query, $nombre)
    {
        if($nombre)
            return $query->where('nombre', 'LIKE', "%$nombre%");
    }*/

     public function scopeNombre($query, $nombre)
    {
        if(trim($nombre)!=""){

            return $query->where(\DB::raw("CONCAT(nombre, ' ', apellido_paterno, ' ' ,apellido_materno)"), "LIKE", "%$nombre%");
        }
    }


}
