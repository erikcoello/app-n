<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Credencial;
use App\Alumno;
use App\Fecha;
use App\Semestre;
use Image;
use DB;
use PDF; 
use Illuminate\Support\Facades\Storage; 
use App\Http\Requests\ValidacionBioEstudiante;
use Illuminate\Http\Request;

class InReinscripcionController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_alumno)
    {
        $alumno = Alumno::where('id_alumno','=',$id_alumno)->first();
                //29-marzo-2021 revisar 
           //  $this->authorize('edit',$alumno);
                   $semestre= Semestre::paginate(8);


    return view('inre.edit',compact('alumno','semestre'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionBioEstudiante $request, $alumno)
    {

            $alumno1 = Alumno::where('id_alumno','=',$request->id_alumno)->first();

          //   $this->authorize('edit',$alumno1);
            $nacimiento = $request->input('fecha_nacimiento');
  
            $date = Carbon::createFromDate($nacimiento)->age; // 43


        //dd($alumno);
        $alumno = Alumno::where('id_alumno','=', $alumno1->id_alumno)
                ->update([
              'nombre' =>  strtoupper($request->nombre),
              'apellido_paterno' =>  strtoupper($request->apellido_paterno),
              'apellido_materno' =>  strtoupper($request->apellido_materno),
              'curp' =>  strtoupper($request->curp),
              'correo'=> $request->correo,
              'matricula' =>  strtoupper($request->matricula),  
              'celular' => $request->celular,
              'sexo' =>  strtoupper($request->sexo),  
              'edad' => $date,
              'nss'  =>    strtoupper($request->nss),
              'fecha_nacimiento' => $request->fecha_nacimiento,
              'alergias'  => strtoupper($request->alergias),
              'enfermedades'  => strtoupper($request->enfermedades),
              'telefono'  => $request->telefono,
              'sangre'  => strtoupper($request->sangre),
              'edo_civil'  => strtoupper($request->edo_civil),
              'hijos'  => strtoupper($request->hijos),
              'discapacidades'  => strtoupper($request->discapacidades),
              'calle'  =>    strtoupper($request->calle),
              'numero_exterior' => strtoupper($request->numero_exterior),
              'numero_interior' => strtoupper($request->numero_interior),
              'colonia'  => strtoupper($request->colonia),
              'codigo_postal'  => $request->codigo_postal,
              'municipio'  => strtoupper($request->municipio),
              'estado'  => strtoupper($request->estado),
              'lugar_nacimiento'  => strtoupper($request->lugar_nacimiento),
              'nacionalidad'  =>  strtoupper($request->nacionalidad),
              'bachillerato'  =>  strtoupper($request->bachillerato),
              'clave_bachillerato'  =>   strtoupper($request->clave_bachillerato),
              'procedencia_bachillerato'  => strtoupper($request->procedencia_bachillerato),
              'promedio_bachillerato'  => $request->promedio_bachillerato,
              'semestre1' => $request->id_semestre,
              'padre_tutor'  =>  strtoupper($request->padre_tutor),
              'tel_tutor'  => strtoupper($request->tel_tutor),
              'cel_tutor'  => $request->cel_tutor,
              'mail_tutor' => $request->mail_tutor,
              ]);
        

               return redirect()->route('controlescolar.index')->with('status', 'el Estudiante se modifico correctamente'); 
    }

      public function PDF($id_alumno)
    {   

        $fecha_inre =Fecha::first();
        //dd($fecha_inre);
        $alumno = Alumno::where('alumnos.id_alumno', '=', $id_alumno)->first();
       
        $data = Credencial::where('id_alumno','=',$id_alumno)->first();

        if ($data == Null) {
            return back()->with('mensaje','No existe foto y firma del estudiante');
        }

        $credencial = Credencial::select('id_alumno','foto','firma')->where('id_alumno','=',$id_alumno)->first();
        //dd($credencial);
        
        $licenciatura = Alumno::select('alumnos.id_alumno','ingreso.id_especialidad','ingreso.grupo')->where('alumnos.id_alumno', '=', $alumno->id_alumno)
        ->join ('ingreso','alumnos.id_alumno', '=', 'ingreso.id_alumno')->first();

        $nombreLic = DB::table('catalogoespecialidades')->where('catalogoespecialidades.idEspecialidad', '=', $licenciatura->id_especialidad)->first();

        /*$semestreCurso = DB::table('semestre')
                            ->select('semestre.id_semestre','semestre.semestre','ciclo_escolar.ciclo_escolar')
                            ->join('semestre_curso','semestre_curso.id_semestre','=','semestre.id_semestre')
                            ->join('ciclo_escolar','semestre_curso.ciclo_escolar', '=', 'ciclo_escolar.id_ciclo')
                            ->where('semestre_curso.id_alumno','=', $id_alumno)->first();*/


        $semestreCurso = DB::table('semestre')
                            ->select('semestre.id_semestre','semestre.semestre')
                            ->join('alumnos','alumnos.semestre1','=','semestre.id_semestre')
                            ->where('alumnos.id_alumno','=', $id_alumno)->first();
                           
                          //  dd($semestreCurso);
        $cicloCurso = DB::table('ciclo_escolar')->where('en_curso','=','1')->first();
       // dd($cicloCurso);                    

      
        
       //return view('ir.ficha',compact('alumno','nombreLic','credencial','licenciatura','semestreCurso','fecha_inre','cicloCurso'));
        

                $pdf = PDF::setPaper('letter','landscape')->loadView('inre.ficha',compact('alumno','nombreLic','credencial','licenciatura','semestreCurso','fecha_inre','cicloCurso'));
              return $pdf->stream('credencial.pdf'); 
     

    }



    public function destroy($id)
    {
        //
    }
}
