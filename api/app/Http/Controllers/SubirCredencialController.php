<?php
namespace App\Http\Controllers;
use App\Alumno;
use App\Credencial;
use Image;
use DB;
use PDF;
use Carbon\Carbon;  
use Illuminate\Support\Facades\Storage; 
use Illuminate\Http\Request;




class SubirCredencialController extends Controller
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
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
               //  $this->authorize('create', Credencial::class);
     $id_alumno = Alumno::where('id_alumno','=', $request->id_alumno)->get('id_alumno');
     //dd($id_alumno);
     foreach ($id_alumno as $alumno) {
         $id_alumno =$alumno->id_alumno;
     }
     

     $id_credencial = Credencial::where('id_alumno','=',$request->id_alumno)->first('id_alumno');
     //dd($id_credencial);
     if($id_credencial !=Null) {

        
             return redirect()->route('credencial.edit',compact('id_alumno'))->with('mensaje', 'será redirect a la opcion editar');
          
             }

     return view('credencial.create',compact('id_alumno')); 

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //   $this->authorize('create', Credencial::class);
        
       $id_alumno = Credencial::where('id_alumno','=', $request->id_alumno)->first('id_alumno');
     
       

            if($retrato = Credencial::setRetrato($request->nameRetrato))
                            $request->request->add(['foto' => $retrato]);
           
            if($firma = Credencial::setFirma($request->nameFirma))
                            $request->request->add(['firma' => $firma]);

                          // $request->request->add(['id_alumno' => $request->id_alumno]);


                           $credencial = new Credencial; 
                           $credencial->id_alumno = $request->id_alumno;
                           $credencial->foto = $retrato;  
                           $credencial->firma = $firma;
                           $credencial->save();


           // Credencial::create($request->all());  
        return redirect()->route('controlescolar.index')->with('mensaje', 'Su fotografía y firma se han subido correctamente favor de previsualizar en la opción de credencial ');
        
    }

 public function show($id_alumno)
    {      

        $alumno = Alumno::select('alumnos.id_alumno', 'alumnos.matricula' ,'alumnos.nombre', 
        'alumnos.apellido_paterno', 'alumnos.apellido_materno')
        ->where('alumnos.id_alumno', '=', $id_alumno)
        ->orderBy('alumnos.apellido_paterno','desc')->first();  
// $this->authorize('edit',$alumno);
         

            $semestreCurso = DB::table('semestre')
                            ->select('semestre.semestre','ciclo_escolar.ciclo_escolar')
                            ->join('semestre_curso','semestre_curso.id_semestre','=','semestre.id_semestre')
                            ->join('ciclo_escolar','semestre_curso.ciclo_escolar', '=', 'ciclo_escolar.id_ciclo')
                            ->where('semestre_curso.id_alumno','=', $id_alumno)->first();

        $Especialidad=DB::table('ingreso')->select('nombreEspecialidad','grupo')
                          ->join('catalogoespecialidades', 'ingreso.id_especialidad','=','catalogoespecialidades.idEspecialidad')
                          ->where('ingreso.id_alumno', '=', $id_alumno)->first();  
                                                 
                                if ($Especialidad->grupo == null) {
                                    $Especialidad-> grupo = 'Único';
                                     }


    

        $data = Credencial::
                    where('id_alumno', '=',  $id_alumno)
                    ->first();

                    //dd($data);
               

               

        return view('credencial.show', compact('alumno','data','semestreCurso','Especialidad'));

    }



   /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
            $alumno = Credencial::where('id_alumno','=',$request->id_alumno)->first('id_alumno');
            
            //     $this->authorize('edit',$alumno);
        $datos = credencial::where('id_alumno','=', $request->id_alumno)->get();
 
           return view('credencial.edit',compact('datos')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$data)
    {

       $credencial = Credencial::findOrFail($data);
       

        if ($retrato = Credencial::setRetrato($request->nameRetrato))
        $eliminarFoto = Storage::disk('public')->delete("$credencial->foto");
                            $request->request->add(['foto' => $retrato]);
           
            if ($firma = Credencial::setFirma($request->nameFirma))
             $eliminarFirma = Storage::disk('public')->delete("$credencial->firma");
                            $request->request->add(['firma' => $firma]);

                          // $request->request->add(['id_alumno' => $request->id_alumno]);

                           $credencial->id_alumno = $request->id_alumno;
                           if($retrato!=Null){
                                $credencial->foto = $retrato;
                            }
                           if ($firma!=Null) {
                                 $credencial->firma = $firma;
                             }  
                           
                           $credencial->save();
                                   return redirect()->route('controlescolar.index')->with('mensaje', 'Se cambio la fotografía y/o firma con éxito');

    }


/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
            
        $eliminar = Credencial::findOrFail($id);
        //dd($eliminar);
            
                 $this->authorize('destroy',$eliminar);
            
              $eliminarFoto = Storage::disk('public')->delete("$eliminar->foto");
             $eliminarFirma = Storage::disk('public')->delete("$eliminar->firma");
             $eliminar->delete();
         

        
             return redirect()->route('controlescolar.index')->with('mensaje', 'El registro fue eliminado con éxito');
          
                }

    public function PDF($id_alumno)
    {   

        $alumno = Alumno::select('alumnos.id_alumno','alumnos.nombre', 
      'alumnos.apellido_paterno', 'alumnos.apellido_materno','alumnos.curp','alumnos.matricula')
        ->where('alumnos.id_alumno', '=', $id_alumno)->first();

        $data = Credencial::where('id_alumno','=',$id_alumno)->first();

        if ($data == Null) {
            return back()->with('mensaje','No existe foto y firma del estudiante');
        }

        $credencial = Credencial::select('id_alumno','foto','firma')->where('id_alumno','=',$id_alumno)->first();
        //dd($credencial);
        
        $licenciatura = Alumno::select('alumnos.id_alumno','ingreso.id_especialidad')->where('alumnos.id_alumno', '=', $alumno->id_alumno)
        ->join ('ingreso','alumnos.id_alumno', '=', 'ingreso.id_alumno')->first();
        $nombreLic = DB::table('catalogoespecialidades')->where('catalogoespecialidades.idEspecialidad', '=', $licenciatura->id_especialidad)->first();
      
        //dd($credencial);
      // return view('credencial.id',compact('alumno','nombreLic','credencial'));
        

     $pdf = PDF::setPaper('credencial','portrail')->loadView('credencial.id',compact('alumno','nombreLic','credencial'));
      return $pdf->download('credencial.pdf');   
     

    }













}
