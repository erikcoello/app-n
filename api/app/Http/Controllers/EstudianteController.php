<?php

namespace App\Http\Controllers;
use App\Alumno;
use App\CicloEscolarA;
use App\Ingreso;
use App\Semestre;
use App\SemestreCurso;
use App\Plan_estudios;
use App\CatalogoEspecialidades;
use App\Http\Requests\ValidacionCrearEstudiante;
use App\Http\Requests\ValidacionEditarEstudiante;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DB;
use str;
use Illuminate\Http\Request;

class EstudianteController extends Controller
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
       // $this->authorize('create', Alumno::class);
         $semestre= Semestre::paginate(8);
         $plan_estudios = Plan_estudios::orderBy('id_plan', 'DESC')->paginate(5);
         $ciclo_escolar = CicloEscolarA::orderBy('id_ciclo', 'DESC')->paginate(6);
         $grupo = $request->input('grupoAlumno');
         $tipo_ingreso = $request->input('tipo_ingreso');

        return view('estudiante.create', compact('semestre','plan_estudios','ciclo_escolar','tipo_ingreso','grupo'));
    }

    public function getEspecialidades($id_plan)
    {
         //return response()->json();
      echo json_encode(CatalogoEspecialidades::where('plan_estudios','=', $id_plan)->get());
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ValidacionCrearEstudiante $request)
    {     
           //  $this->authorize('create', Alumno::class);

      //  dd($request->ciclo_escolar);
         $id=Alumno::insertGetId([
                
                           
              'nombre'=> strtoupper($request->nombre),
              'apellido_paterno'=> strtoupper($request->apellido_paterno),
              'apellido_materno' => strtoupper($request->apellido_materno),
              'celular' => $request->celular,
              //'correo'=>  $request->correo,
              'pass'=>  Hash::make($request['pass']),
              'curp'=>strtoupper($request->curp),
              'matricula'=>strtoupper($request->matricula),
              
 ]); 
  

        $id2=Ingreso::insertGetId([
              'id_alumno'=>$id,
              'id_especialidad'=>$request->idEspecialidad,
              'grupo'=>strtoupper($request->grupoAlumno),
              'plan_estudios' =>$request->plan_estudios,
              'tipo_ingreso' => strtoupper($request->tipo_ingreso), 
              'semestre_ingreso'=>$request->id_semestre,
              'ciclo_escolar' => $request->ciclo_escolar,
                            ]);

        $id3=SemestreCurso::insertGetId([
              'id_alumno'=>$id,
              'id_semestre'=>$request->id_semestre,
              'ciclo_escolar'=>$request->ciclo_escolar,
              'plan_estudios'=>$request->plan_estudios,
   ]);

        $id4 = User::insertGetId([
             
              'name' =>$request->nombre,
              'password' => Hash::make($request['pass']),
              'id_alumno'=>$id,
              'email' =>$request->email,
              
              

        ]);

   return redirect()->route('controlescolar.index')->with('status', 'El estudiante fue creado con éxito');

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
         
        $alumno = Alumno::select('id_alumno','nombre','apellido_paterno','apellido_materno','celular','correo','pass','curp','matricula')->where('id_alumno', '=', $id_alumno)->first();
         //  $this->authorize('edit',$alumno);


            //dd($alumno);
            $ingreso = Ingreso::where('id_alumno', '=', $id_alumno)->first();
           // $semestre_curso = SemestreCurso::where('id_alumno', '=', $id_alumno)->first();
              $semestre= Semestre::paginate(8);
            $plan_estudios = Plan_estudios::orderBy('id_plan', 'DESC')->paginate(5);
            $ciclo_escolar = CicloEscolarA::orderBy('id_ciclo', 'DESC')->paginate(6);
            $usuario = User::where('id_alumno','=',$id_alumno)->first();


            $cicloEscolarEstudiante = DB::table('semestre_curso')
                            ->join('ciclo_escolar','semestre_curso.ciclo_escolar','=','ciclo_escolar.id_ciclo')
                            ->where('semestre_curso.id_alumno','=', $id_alumno)->first();

                           // dd($cicloEscolarEstudiante);

            $EspecialidadEstudiante = DB::table('ingreso')
                            ->join('catalogoespecialidades','ingreso.id_especialidad','=','catalogoespecialidades.idEspecialidad')
                            ->where('ingreso.id_alumno','=', $id_alumno)->first();
            //dd($EspecialidadEstudiante);
           $tipo_ingreso=Null;

            return view('estudiante.edit', compact('semestre','plan_estudios','ciclo_escolar','alumno','ingreso','EspecialidadEstudiante','cicloEscolarEstudiante','usuario'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ValidacionEditarEstudiante $request, $id_alumno)
    {
            $usuario1 = User::where('id_alumno','=',$id_alumno)->first();
            $alumno = Alumno::where('id_alumno','=', $id_alumno)->first();
            //   $this->authorize('edit',$alumno);
        $alumno = Alumno::where('id_alumno','=', $id_alumno)
                ->update([
             'nombre'=> strtoupper($request->nombre),
              'apellido_paterno'=> strtoupper($request->apellido_paterno),
              'apellido_materno' => strtoupper($request->apellido_materno),
              'celular' => $request->celular,
              'correo'=>  $request->correo,
              'pass'=>  Hash::make($request['pass']),
              'curp'=>strtoupper($request->curp),
              'matricula'=>strtoupper($request->matricula),
              ]);
          

        $ingreso = Ingreso::where('id_alumno','=', $id_alumno)
                    ->update([
              'id_especialidad'=>$request->idEspecialidad,
              'grupo'=>strtoupper($request->grupoAlumno),
              'plan_estudios' =>$request->plan_estudios,
              //'tipo_ingreso' => $request->tipo_ingreso, 
              //'semestre_ingreso'=>$request->id_semestre,
             // 'ciclo_escolar' => $request->ciclo_escolar,
                            ]); 
        $semestreCurso = SemestreCurso::where('id_alumno','=', $id_alumno)
                        ->update([
              //'id_semestre'=>$request->id_semestre,
              //'ciclo_escolar'=>$request->ciclo_escolar,
              'plan_estudios'=> $request->plan_estudios,
   ]); 

            if($usuario1->email != $request->email){
        $usuario = User::where('id_alumno','=', $id_alumno)
                ->update([
              'name'=> strtoupper($request->nombre),
              'email'=>  $request->email,
              'password'=> Hash::make($request['pass']),
              
   ]);
}else {
     $usuario = User::where('id_alumno','=', $id_alumno)
                ->update([
              'name'=> strtoupper($request->nombre),
              //'email'=>  $request->email,
              'password'=> Hash::make($request['pass']),
              
   ]);
}
         
    

   return redirect()->route('controlescolar.index')->with('status', 'El estudiante Se actualizo con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
