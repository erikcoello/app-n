<?php

namespace App\Http\Controllers;
use App\Alumno;
use App\Official;
use DB;
use Str;
use Carbon\Carbon;  
use Illuminate\Support\Facades\Storage; 
use Illuminate\Http\Request;

class DocumentosOficialesController extends Controller
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
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
            $this->authorize('create', Official::class);
        $id_alumno = Alumno::where('id_alumno','=', $request->id_alumno)->get('id_alumno');
       
        $registro = Official::where('id_alumno',$request->id_alumno)->first();
       
        if($registro != Null){
                return back();
            } 
            
       
         return view('official.create',compact('id_alumno'));
         

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->authorize('create', Official::class);
            $hoy=date('Y-m-d H:m:s',strtotime('today')); 
              $foto = $request->bachiller;
              $curp = $request->curp;
              $nacimiento = $request->nacimiento;
              $id_alumno = $request->id_alumno;


            

        if($foto==''){
            $nameBachiller =   'untitle.pdf';
        }else{
             $nameBachiller = Str::random(20) . '_' . $id_alumno .  '.pdf';
             $foto= $request->file('bachiller')->storeAs('public/official/', $nameBachiller);
            
            }
        if($curp==''){
                $nameCurp = 'untitle.pdf';
            }
           else{     
                $nameCurp = Str::random(20) . '_' . $id_alumno .  '.pdf';
                $curp= $request->file('curp')->storeAs('public/official/', $nameCurp);
                 }

        if($nacimiento==''){
                $nameActa = 'untitle.pdf';
            }
            else {
                $nameActa = Str::random(20) . '_' . $id_alumno .  '.pdf';
                $nacimiento= $request->file('nacimiento')->storeAs('public/official/', $nameActa);
                }

             $id=Official::create([
              'id_alumno'=>  $id_alumno,
              'bachiller' => $nameBachiller,
              'curp' => $nameCurp,
              'acta' => $nameActa,
              'created_at' => $hoy,
              'updated_at'=>   $hoy,
              
              ]);



     return redirect()->route('controlescolar.index')->with('mensaje', 'El libro se creo correctamente');
        
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id_alumno)
    {      

        $alumno = Alumno::select('alumnos.id_alumno', 'alumnos.matricula' ,'alumnos.nombre', 
        'alumnos.apellido_paterno', 'alumnos.apellido_materno')
        ->where('alumnos.id_alumno', '=', $id_alumno)
        ->orderBy('alumnos.apellido_paterno','desc')->first();  

         

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


    

        $data = Official::
                    where('id_alumno', '=',  $id_alumno)
                    ->first();

                    //dd($data);
                 if($data==Null)
                    {
                        $data=1;
                    };

               

        return view('official.show', compact('alumno','data','semestreCurso','Especialidad'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$data)
    {
             $data1 = Official::where('id','=',$data)->first();
            // dd($data1);
             $this->authorize('edit',$data1);
   
     
       if($data1==Null)
       {
        return redirect()->back();
       }

        $id_alumno = Official::where('id_alumno','=',$request->id_alumno)->get();
       // dd($id_alumno);
        
         
        return view('official.edit', compact('id_alumno','data1'));
        //return 'hola';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $data1)
    {
        $hoy=date('Y-m-d H:m:s',strtotime('today')); 
              
              
              
              $id_alumno = $request->id_alumno;
             // dd($id_alumno);

           $data_file = Official::where('id','=',$data1)->first();
          $this->authorize('edit',$data_file);
   
       
             $foto = $request->bachiller;
             if($foto !=Null){
             $nameBachiller = Str::random(20) . '_' . $data_file->id_alumno .  '.pdf';
         
             $foto= $request->file('bachiller')->storeAs('public/official/', $nameBachiller);
            
             $id=Official::where('id',$data1)->update([
             // 'id_alumno'=>  $id_alumno,
              'bachiller' => $nameBachiller,
              'created_at' => $hoy,
              'updated_at'=>   $hoy,
              
              ]);
             
            }elseif($foto==""){

            }
                $curp = $request->curp;
                if($curp!=Null){
             $nameCurp = Str::random(20) . '_' . $data_file->id_alumno .  '.pdf';
            
             $curp= $request->file('curp')->storeAs('public/official/', $nameCurp);
             $id2=Official::where('id',$data1)->update([
             // 'id_alumno'=>  $id_alumno,
              
              'curp' => $nameCurp,
              'created_at' => $hoy,
              'updated_at'=>   $hoy,
              
              ]);
         }elseif($curp==""){
                
            }
                
             $nacimiento = $request->nacimiento;
             if($nacimiento!=Null){
             $nameActa = Str::random(20) . '_' . $data_file->id_alumno .  '.pdf';
            
             $nacimiento= $request->file('nacimiento')->storeAs('public/official/', $nameActa);
             $id2=Official::where('id',$data1)->update([
             // 'id_alumno'=>  $id_alumno,
              
              'acta' => $nameActa,
              'created_at' => $hoy,
              'updated_at'=>   $hoy,
              
              ]);
         }elseif($nacimiento==""){
                
            }
              
             /*$id=Official::where('id',$data1)->update([
             // 'id_alumno'=>  $id_alumno,
              'bachiller' => 'official'.'/'.$nameBachiller,
              'curp' => 'official'.'/'.$nameCurp,
              'acta' => 'official'.'/'.$nameActa,
              'created_at' => $hoy,
              'updated_at'=>   $hoy,
              
              ]);*/



     return redirect()->route('controlescolar.index')->with('mensaje', 'El libro se creo correctamente');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($data)
    {

             $eliminar = Official::find($data);
          
                 $this->authorize('destroy',$eliminar);
            //$data_file = Official::where('id',$data)->first('bachiller');
            $data_file = Official::findOrFail($data);
            //dd($data_file);
            $bachiller = storage_path("/app/public/official/".$data_file->bachiller);
            $curp = storage_path("/app/public/official/".$data_file->curp);
            $acta = storage_path("/app/public/official/".$data_file->acta);

                    if($data_file !=''){
                    if(file_exists($bachiller)){
                         unlink($bachiller); }
                    if(file_exists($curp)){
                             unlink($curp);
                         }
                    if(file_exists($acta)){
                         unlink($acta);
                     }
                        $eliminar->delete();
             return redirect()->route('controlescolar.index')->with('Success','Post Deleted');

            }else{
                return 'No Existe Registro';
            }

    }

    public function bachiller(Request $request,$data)
    {

        $data_file = Official::where('id',$data)->first();
        $this->authorize('edit',$data_file);
       // dd($data_file);
       
            
                 $header = array(
                                  'Content-Type: application/pdf',
                            );
  
         return response()->file(storage_path("/app/public/official/".$data_file->bachiller), $header);
        
         /*original  $data_file = Official::where('id','77')->first();
         $file = storage_path($data_file->path)."/app/public/official/";
            
                 $header = array(
                                  'Content-Type: application/pdf',
                            );
  
         return response()->file(storage_path("/app/public/".$data_file->bachiller), $header);
*/

      
        //return view('official.detail',compact('vista'));
  }

  /*   return response()->file(storage_path("/app/public/official/".$data_file->curp), $header);
         return response()->file(storage_path("/app/public/official/".$data_file->acta), $header);*/

             public function curp(Request $request,$data)
                  {
                     $data_file = Official::where('id',$data)->first();
                     $this->authorize('edit',$data_file);
                        $header = array(
                                  'Content-Type: application/pdf',
                            );
  
         return response()->file(storage_path("/app/public/official/".$data_file->curp), $header);
        
         
  }
             public function acta(Request $request,$data)
                {
                     $data_file = Official::where('id',$data)->first();
                     $this->authorize('edit',$data_file);
                        $header = array(
                                  'Content-Type: application/pdf',
                            );
  
         return response()->file(storage_path("/app/public/official/".$data_file->acta), $header);
     }
        

}
