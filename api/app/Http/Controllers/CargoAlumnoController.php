<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alumno;
use App\CargoAlumno;
use DB;

class CargoAlumnoController extends Controller
{

  public function __construct()
   {
    $this->middleware('auth');
   } 


     public function before($user, $ability)
{
    if ($user->isAdmin()) {
        return true;
    }
} 

   public function show($id_alumno)
   {

    $alumno = Alumno::select('alumnos.id_alumno', 'alumnos.matricula' ,'alumnos.nombre', 
      'alumnos.apellido_paterno', 'alumnos.apellido_materno')->where('alumnos.id_alumno', '=', $id_alumno)->orderBy('alumnos.apellido_paterno','desc')->paginate();

 $cargo = CargoAlumno::select('cargoalumno.id','cargoalumno.id_alumno','cargoalumno.id_ciclo','cargoalumno.id_semestre','cargoalumno.created_at', 'ciclo_escolar.ciclo_escolar','semestre.semestre')
        ->join('ciclo_escolar','cargoalumno.id_ciclo', '=', 'ciclo_escolar.id_ciclo')
        ->join('semestre', 'semestre.id_semestre','=', 'cargoalumno.id_semestre')
        //->join('cargos','cargos.id_ciclo', '=', 'cargoalumno.id_ciclo')
        //->where('cargos.id_semestre','=','cargoalumno.id_semestre')
        ->where('cargoalumno.id_alumno', '=',  $id_alumno)
        ->orderBy('cargoalumno.id','ASC')->paginate();

        return view('cargo-alumno.show', compact('alumno','cargo'));
   }






   public function create($id_alumno)
    {

              $this->authorize('create', CargoAlumno::class);
          $alumno = Alumno::select('alumnos.id_alumno', 'alumnos.matricula' ,'alumnos.nombre', 
      'alumnos.apellido_paterno', 'alumnos.apellido_materno')->where('alumnos.id_alumno', '=', $id_alumno)->orderBy('alumnos.apellido_paterno','desc')->paginate();
         // dd($alumno);


        $listaCE = DB::table('cargos')
        ->select('cargos.id_ciclo','ciclo_escolar.ciclo_escolar')
        ->join('ciclo_escolar','ciclo_escolar.id_ciclo','=','cargos.id_ciclo')
        ->groupBy('id_ciclo')
        ->get();
        //dd($listaCE);
        /*return view('alumnos.cargo')->with('listaCE',$listaCE,'id_alumno', $id_alumno);*/
        return view('cargo-alumno.create', compact('alumno', 'listaCE'));
    }

  public function fetch(Request $request)
    {
        
     $select = $request->get('select');
           
     $value = $request->get('value');
     $dependent = $request->get('dependent');
     $data = DB::table('cargos')->select('cargos.id_semestre','semestre.semestre')
       ->join('semestre','semestre.id_semestre','=','cargos.id_semestre')
       ->where($select, $value)
       ->groupBy($dependent)
       ->get();
     $output = '<option value="">Select '.ucfirst($dependent).'</option>';
     foreach($data as $row)
     {
      $output .= '<option value="'.$row->$dependent.'">'.$row->semestre.'</option>';
     }
     echo $output;


}
 public function store(Request $request)
 {
        $this->authorize('create', CargoAlumno::class);

     request()->validate([
        'id_ciclo' => 'required',
        'id_semestre' => 'required',
        'id_alumno' => 'required',
        
     ]);



      $cargoAlumno = new CargoAlumno; 
      $cargoAlumno->id_ciclo = $request->id_ciclo;
      $cargoAlumno->id_semestre = $request->id_semestre;  
      $cargoAlumno->id_alumno = $request->id_alumno;
      $cargoAlumno->save();
      
    

          return redirect()->route('alumnos.index')->with('status', 'el cargo fue creado  con exito');
 }


//public function destroy($id_cargo) 
public function destroy(Request $request)
{
    //dd($request->cargo_id);
    $eliminar  = CargoAlumno::find($request->cargo_id);
              $this->authorize('delete',$eliminar);

        $eliminar->delete();

        return back();
    
  }  


    }// class
