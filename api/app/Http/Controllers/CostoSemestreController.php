<?php

namespace App\Http\Controllers;

use App\Cargo;  
use App\Ciclo_escolar;
use App\Semestre;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\HandlesAuthorization;


class CostoSemestreController extends Controller
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
    public function index(Request $request)
    {   

            /* $cargo = Cargo::select('ciclo_escolar.ciclo_escolar','semestre.semestre','cargos.amount', 'cargos.type','cargos.id')
        -> join('ciclo_escolar','ciclo_escolar.id_ciclo', '=', 'cargos.id_ciclo')
        -> join('semestre','semestre.id_semestre', '=', 'cargos.id_semestre')
        //->where('semestre_curso.ciclo_escolar', '=')
        ->paginate();

        
         return view('costo-semestres.index', compact('cargo'));*/


         $ciclo_escolar  = $request->get('ciclo_escolar');

         $cargo = Cargo::select('ciclo_escolar.ciclo_escolar','semestre.semestre','cargos.amount', 'cargos.type','cargos.id')
        -> join('ciclo_escolar','ciclo_escolar.id_ciclo', '=', 'cargos.id_ciclo')
        -> join('semestre','semestre.id_semestre', '=', 'cargos.id_semestre')
        -> where('ciclo_escolar.ciclo_escolar', 'LIKE', "%$ciclo_escolar%")
        ->paginate(10);


        return view('costo-semestres.index', compact('cargo'));
    


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   

           $this->authorize('create', Cargo::class);
        //$concepto = array("Inscripcion", "Reinscripcion", "Titulacion");

         $ciclo_escolar = Ciclo_escolar::select('id_ciclo','ciclo_escolar')
        ->orderBy('id_ciclo','desc')
        ->paginate(); 
        $semestre = Semestre::select('id_semestre','semestre')
        ->orderBy('id_semestre','asc')
        ->paginate();
        $cargo = Cargo::select('type');
        $type = $request->input('type');


         return view('costo-semestres.create', compact('ciclo_escolar','semestre','cargo','type'));
     }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

     {
         $this->authorize('create', Cargo::class);
         $str = str_replace(",", "", $request->amount);

     request()->validate([
        'id_ciclo' => 'required',
        'semestre_id' => 'required',
        'amount' => 'required',
        'type' => 'required',
     ]);



      $cargo = new Cargo; 
      $cargo->id_ciclo = $request->id_ciclo;
      $cargo->id_semestre=  $request->semestre_id;  
      $cargo->type = $request->type;
      $cargo->amount= $str;
      $cargo->save();
      
    
        return back();
        // return redirect()->route('costo-semestre.index')->with('status', 'el proyecto fue actualizado con éxito');
    }

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CostoSemestre  $costoSemestre
     * @return \Illuminate\Http\Response
     */
    public function edit($cargoItem, Request $request)
    {
        // dd($cargoItem);
       
     //  $this->authorize('update',$cargoItem);
         $ciclo_escolar = Ciclo_escolar::select('id_ciclo','ciclo_escolar')
        ->orderBy('id_ciclo','desc')
        ->paginate(); 
        $semestre = Semestre::select('id_semestre','semestre')
        ->orderBy('id_semestre','asc')
        ->paginate();
        
       // $saldo= Cargo::first()->where('id','=',$id);
     
         $cargo = Cargo::select('type');
        $type = $request->input('type');


         return view('costo-semestres.edit', compact('ciclo_escolar','semestre','cargo','type','cargoItem'));
        
      
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CostoSemestre  $costoSemestre
     * @return \Illuminate\Http\Response
     */
    public function update($cargoItem, Request $request )
    {
                 $editPago = Cargo::find($cargoItem);
              $this->authorize('update',$editPago);
                

             //$now = Carbon::now();
         //  $currentData = $now->format('y-m-d');
                 $str = str_replace(",", "", $request->amount);

                $editPago = Cargo::find($cargoItem);


                request()->validate([
        
         'id_ciclo' => 'required',
        'semestre_id' => 'required',
        'amount' => 'required',
        'type' => 'required',
     ]);

    //$editPago->updated_at  = $now;
                 $editPago->id_ciclo = $request->id_ciclo;
      $editPago->id_semestre=  $request->semestre_id;  
      $editPago->type = $request->type;
      $editPago->amount= $str;
      $editPago->save();

         // return back();
      
return redirect()->route('costo-semestre.index')->with('status', 'el proyecto fue actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CostoSemestre  $costoSemestre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
         $eliminar = Cargo::find($request->cargo_id);
            $this->authorize('delete',$eliminar);
     $eliminar->delete();
         return redirect()->route('costo-semestre.index')->with('status', 'el proyecto fue eliminado con exito');
    }

}

