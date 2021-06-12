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
use Image;
use Str;
use App\Attached;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 

class AlumnosController extends Controller
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



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response

     */

  public function index(Request $request)
    {
        


        $id_alumno  = $request->get('id_alumno');
        $matricula = $request->get('matricula');
        $nombre   = $request->get('nombre');

        $alumnos = Alumno::orderBy('id_alumno', 'DESC')
            ->id_alumno($id_alumno)
            ->matricula($matricula)
            ->nombre($nombre)
            ->where('alumnos.estatus','!=','definitiva')
            ->paginate();

        return view('alumnos.index', compact('alumnos'));
    
       
  
 }//fin index



 

 public function show($id_alumno) 
 {
$semestreCurso = DB::table('semestre')
    ->select('semestre.semestre','ciclo_escolar.ciclo_escolar')
                            ->join('semestre_curso','semestre_curso.id_semestre','=','semestre.id_semestre')
                            ->join('ciclo_escolar','semestre_curso.ciclo_escolar', '=', 'ciclo_escolar.id_ciclo')
                            ->where('semestre_curso.id_alumno','=', $id_alumno)->first();

     $Especialidad=DB::table('ingreso')->select('nombreEspecialidad','grupo')
        ->join('catalogoespecialidades', 
            'ingreso.id_especialidad','=','catalogoespecialidades.idEspecialidad')
            ->where('ingreso.id_alumno', '=', $id_alumno)->first();  
                                                 
            if ($Especialidad->grupo == null) {
                $Especialidad-> grupo = 'Único';
                # code...
            }
      /// falta corregir la consulta no pedir todo el array de informacion la variable alumno se le pasa a la vista alumnos.show
          //$alumno = Alumno::where('id_alumno','=', $id)->get();

    $alumno = Alumno::select('alumnos.id_alumno', 'alumnos.matricula' ,'alumnos.nombre', 
      'alumnos.apellido_paterno', 'alumnos.apellido_materno')->where('alumnos.id_alumno', '=', $id_alumno)->orderBy('alumnos.apellido_paterno','desc')->first();

    $pago = Inscripcionfinanza::select('inscripcionfinanzas.id','inscripcionfinanzas.id_alumno','attached.id_pago','inscripcionfinanzas.concepto','inscripcionfinanzas.amount','inscripcionfinanzas.created_at','inscripcionfinanzas.categories_id','inscripcionfinanzas.description','inscripcionfinanzas.id_ciclo','categories.name','semestre.semestre')
        -> join('attached','inscripcionfinanzas.id', '=', 'attached.id_pago')
        ->join('categories', 'inscripcionfinanzas.categories_id','=', 'categories.id')
        ->join('semestre','inscripcionfinanzas.semestre', '=', 'semestre.id_semestre')
        ->where('inscripcionfinanzas.id_alumno', '=',  $id_alumno)
        ->orderBy('inscripcionfinanzas.id','desc')->paginate();

        
      $monto = Inscripcionfinanza::where('id_alumno','=',$id_alumno)->where('concepto','=','add')->sum('amount');
       

                 $saldo = DB::table('cargoalumno')->join('cargos','cargoalumno.id_ciclo','=', 'cargos.id_ciclo')->select('cargoalumno.*', 'cargos.*')
                             ->where('cargoalumno.id_alumno', '=', $id_alumno) 
                               ->whereColumn('cargoalumno.id_semestre', '=', 'cargos.id_semestre')->SUM('cargos.amount');

                                    if ($monto == $saldo) {
                                   $diferiencia = "El estudiante no presenta adeudo"; 
                                }elseif ($monto > $saldo){
                                    $diferiencia = "El Estudiante tiene más pagos registrados de lo que debe";
                                   } elseif($saldo != null){
                                if($monto < $saldo){
                                    $adeudo = $saldo - $monto;
                                    $diferiencia = 'El Estudiante debe un acumulado de: $'.$adeudo;
                                }
                             }else{
                                 $diferiencia = 'Aún no se asignan cargos para el estudiante';
                             }

                             //  $diferiencia = $monto - $saldo  ;


          return view('alumnos.show', compact('alumno', 'pago','monto','saldo','diferiencia','semestreCurso','Especialidad'));
    }  //fin show

    //formulario que obtiene $id_alumno que le vamos agregar el pago el request es para obtener datos del form
    public function create(Request $request, $id_alumno)

    {
       ///dd($id_alumno);
              $this->authorize('create', Alumno::class);
     
     $alumno = Alumno::where('id_alumno','=', $id_alumno)->get('id_alumno');
     $concepto = $request->input('concepto');
     $semestre = Semestre::paginate(8);
     $categorias = Categories::all();
     $ciclo_escolar = CicloEscolarA::orderBy('id_ciclo', 'DESC')->paginate(5);
    // $now = Carbon::now();


     return view('alumnos.create',compact('alumno','concepto', 'semestre','categorias', 'ciclo_escolar'));
 } 




    public function baucher($id_pago){
      
              $data_file = Attached::where('id_pago','=', $id_pago)->first();
             //dd($data_file);

           return response()->file(storage_path('app/public/attached/'.$data_file->path));

      
   }
/// Reques nos devuelve los datos insertados por el usuario del formulario
 public function store(Request  $request){
                  $this->authorize('create', Alumno::class);

       
         $id_alumno = Alumno::where('id_alumno','=', $request->id_alumno)->pluck('id_alumno');
         //dd($id_alumno);
               
        $hoy=date('Y-m-d H:m:s',strtotime('today')); 
        $str = str_replace(",", "", $request->monto);
    
        request()->validate([
       'id_alumno' => 'required|min:3',
       'concepto' => 'required',
       'monto' => 'required',
       'fecha' => 'required',
       'ciclo_escolar' => 'required',
       'semestre' => 'required',
       'categoria' => 'required',
       'comentarios' => 'required',
       'baucher' => 'required|image|mimes:jpeg,png|max:6000',
       //'prorroga'=>'required',
       //'path' => 'required',
       
       
    ]);


    
     $busquedaD = Inscripcionfinanza::select('id_alumno')
                                   ->where('id_alumno','=',$request->id_alumno)
                                   ->where('concepto','=',$request->concepto)
                                   ->where('amount', '=', $str)
                                   ->where('id_ciclo', '=', $request->ciclo_escolar)
                                   ->where('semestre', '=',$request->semestre)
                                   ->where('categories_id','=',$request->categoria)
                                   ->exists();

       
     if($busquedaD >= 1)  {        
       return redirect()->route('alumnos.index')->with('mensaje', 'el pago ya existe');
   }  else {

    
                 
          $id=Inscripcionfinanza::insertGetId([
               'id_alumno' => $request->id_alumno,   
               'concepto'=> $request->concepto,
               'amount'=> $str,
               'created_at' => $request->fecha,
               'updated_at' => $request->fecha,
               'id_ciclo'=>  $request->ciclo_escolar,
               'semestre'=>  $request->semestre,
               'categories_id'=>$request->categoria,
               'fecha_prorroga'=>$request->prorroga,
               'description'=>$request->comentarios

           ]); 

          if($request->baucher==''){
           return back();
       }else{
            $baucher = Str::random(20) . '_' . $id_alumno .  '.jpg';
            $foto= $request->file('baucher')->storeAs('public/attached', $baucher);
           
           }

           $id2=Attached::create([
             'id_pago'=>  $id,
             'path' => $baucher,
             'created_at' => $hoy,
             'updated_at'=>   $hoy,
             
             ]);

     
      } //else

      
   return redirect()->route('alumnos.index')->with('mensaje', 'el pago fue creado  con exito');

} //store


   
    public function edit(Request $request, $id_pago)
        {
      
             $data = Inscripcionfinanza::where('id',$id_pago)->first();
         // dd($data->concepto);

           $this->authorize('edit',$data);
                  $alumno = Alumno::select('id_alumno')->where('id_alumno','=',$data->id_alumno)->first();
          //dd($id_alumno);
                  $semestre = Semestre::paginate(8);
                  $categorias = Categories::all();
                  $ciclo_escolar = CicloEscolarA::orderBy('id_ciclo', 'DESC')->paginate(5);
                  $attached = attached::where('id_pago','=',$id_pago)->exists();
                  

                  $cicloEscolarEstudiante = DB::table('inscripcionfinanzas')
                           ->join('ciclo_escolar','inscripcionfinanzas.id_ciclo','=','ciclo_escolar.id_ciclo')
                           ->where('ciclo_escolar.id_ciclo','=', $data->id_ciclo)
                           ->select('ciclo_escolar.id_ciclo','ciclo_escolar.ciclo_escolar')->first();

                  $semestreEstudiante = DB::table('inscripcionfinanzas')
                           ->join('semestre','inscripcionfinanzas.semestre','=','semestre.id_semestre')
                           ->where('semestre.id_semestre','=', $data->semestre)
                           ->select('semestre.id_semestre','semestre.semestre')->first();

                  $categoriaEstudiante = DB::table('inscripcionfinanzas')
                           ->join('categories','inscripcionfinanzas.categories_id','=','categories.id')
                           ->where('categories.id','=', $data->categories_id)
                           ->select('categories.id','categories.name')->first();

                  $baucherFoto = attached::where('id_pago','=',$id_pago)->first();

                   if($data->concepto=="add"){
                     $nombreConcepto="Pago";
                   }else $nombreConcepto="Prorroga";

                            //dd($semestreEstudiante);
    return view('alumnos.edit',compact('data','semestre','categorias','ciclo_escolar','attached','cicloEscolarEstudiante','semestreEstudiante','categoriaEstudiante','baucherFoto','nombreConcepto'));
  

   }

///funciona para probar que envia el form edti
  /* public function update (Request $request, $id_pago) {
       return $request;
   }
*/
public function update(Request $request, $id_pago)
       {
               $editPago = Inscripcionfinanza::find($id_pago);

               $this->authorize('edit',$editPago);
               $editBaucher = attached::where('id_pago','=', $id_pago)->first();
              
               $now = Carbon::now();
        //  $currentData = $now->format('y-m-d');
             //  $editPago = Inscripcionfinanza::find($id_pago);


               request()->validate([
       
       'concepto' => 'required',
       'monto' => 'required',
       'ciclo_escolar' => 'required',
       'semestre' => 'required',
       'fecha' => 'required',
       'categoria' => 'required',
       //'prorroga'=>'required',
       'comentarios' => 'required',
       //'baucher' => 'required|image|mimes:jpeg,png|max:6000',
       
    ]);


      

   $editPago->updated_at  = $now;
   $editPago->concepto  = $request->concepto; 
   $str = str_replace(",", "", $request->monto);
   $editPago->amount  = $str;  
   $editPago->id_ciclo  = $request->ciclo_escolar;  
   $editPago->semestre  = $request->semestre;  
   $editPago->categories_id  = $request->categoria;
   $editPago->fecha_prorroga  = $request->prorroga;             
   $editPago->description  = $request->comentarios;
   $editPago->save();

    if($request->baucher!=''){
            $baucher = Str::random(20) . '_' . $editPago->id_alumno .  '.jpg';
            $foto= $request->file('baucher')->storeAs('public/attached', $baucher);
             $editBaucher->path = $baucher;
   $editBaucher->updated_at  = $now;
   $editBaucher->save();
       }else{
            }


  

     return redirect()->route('alumnos.index')->with('mensaje', 'el proyecto fue actualizado con éxito');
       }
 


public function destroy(Request $request){
 //$id_alumno = 2216;

           $eliminar = Inscripcionfinanza::find($request->pago_item);

        
               $this->authorize('delete',$eliminar);
         $id_alumnos = Inscripcionfinanza::where('id_alumno','=',$eliminar->id_alumno)->first();


               $liga= attached::where('id_pago',$request->pago_item)->first();
               
     //$data_file = attached::where('id_pago',$request->pago_item)->Pluck('path');

         // $imgOld =$data_file[0];

          $eliminarBaucher = Storage::disk('public')->delete("attached/$liga->path");
          
        

       
            //unlink(storage_path('app/public/attached/'.$imgOld));
            // dd($imgOld);
   
     
       $eliminar->delete();
       $liga->delete();
       // return redirect()->route('alumnos.index')->with('status', 'el proyecto fue eliminado con exito');
        return redirect()->route('alumnos.show',compact('id_alumnos'))->with('Success','Post Deleted');
       return back();
   }

}//fin 