<?php

namespace App\Http\Controllers;
use App\Attached;
use App\Alumno;
use Datetime;
use Illuminate\Http\Request;

class attachedController extends Controller
{

   /*  public function __construct()
   {
    $this->middleware('auth');
   } */

    

  public function edit(Request $request, $id){

            dd($id);
        $data = attached::where('id',$id)->first();
        return view('/attached.edit',['data'=>$data]);

        /*}else{
                return view('vendor.adminlte.permission',['summary'=>null]);
            }*/


    }

   public function update(Request $request, $id)
    {   
        $hoy = new Datetime ('now');
       // $log = Auth::id();
        $data = $request->file('path');
        
        if(isset($data)){
            $file = $request->path->store('attached','public');         
        }


        $attached = attached::find($id);
        $attached->path = $file;
        $attached->updated_at = $hoy;
        $attached->save();

       /* $bitacora = new bitacora;
        $bitacora->created_date = $hoy;
        $bitacora->type="update";
        $bitacora->id_activity=$id;
        $bitacora->activity="Documento";
        $bitacora->id_user=$log;
        $bitacora->save();*/
        return redirect('alumnos/show');
                
    }

 /*   public function destroy( $id)
    {
        
        $r=(new summaryController)->pass($act='adjuntos');
        if($r==1 || $r==5 || $r==6 || $r==7){

        $attached = attached::find($id);
        $attached->delete();
        return redirect('attached/attached');

       }else{
                return view('vendor.adminlte.permission',['summary'=>null]);
            }

        
    }*/
}