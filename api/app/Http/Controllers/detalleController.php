<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\CicloEscolarA;
use App\Categories;
use App\Semestre;
use App\Inscripcionfinanza;
use Carbon\Carbon;
use App\CargoAlumno;
use DB;
use App\Attached;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class detalleController extends Controller
{

     public function __construct()
   {
    $this->middleware('auth');
   } 

    
     public function view(Request $request, $id_alumno){

    new AlumnoController($id_alumno='id_alumno');
     

           $alumno = Alumno::select('alumnos.id_alumno', 'alumnos.matricula' ,'alumnos.nombre', 
      'alumnos.apellido_paterno', 'alumnos.apellido_materno')->where('alumnos.id_alumno', '=', $id_alumno)->orderBy('alumnos.apellido_paterno','desc')->paginate();
           dd($alumno);

    $pago = Inscripcionfinanza::where ('id_alumno','=',$id_alumno)->get();

/// compact pasa la variable alumno para mostrarla como titulo de todos los pagos del alumno registrado y pago es el listado en un foreach
    return view('detalle.detalle', compact('alumno', 'pago'));

    }  //fin show

    //formulario que obtiene $id_alumno que le vamos agregar el pago el request es para obtener datos del form



  public function downloadFile($id){
        $r=(new summaryController)->pass($act='cuentas');
        if($r>0){
            $data_file = attached::find($id);
            return response()->file(storage_path('app/public/'.$data_file->path));
        }else{
             return view('vendor.adminlte.permission',['summary'=>null]);
        }
    }
}
