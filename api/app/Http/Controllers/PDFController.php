<?php

namespace App\Http\Controllers;

use App\Inscripcionfinanza;
use App\Alumno;
use DB;
use PDF;
use Illuminate\Http\Request;


class PDFController extends Controller
{
    public function PDF($id_pago)
    {   

        $imprimir = Inscripcionfinanza::where('id',$id_pago)->first();
         $this->authorize('edit',$imprimir);
        $alumno = Alumno::select('alumnos.id_alumno','alumnos.nombre', 
      'alumnos.apellido_paterno', 'alumnos.apellido_materno')
        ->where('alumnos.id_alumno', '=', $imprimir->id_alumno)->first();
      //dd($alumno);
        $licenciatura = Alumno::select('alumnos.id_alumno','ingreso.id_especialidad')->where('alumnos.id_alumno', '=', $imprimir->id_alumno)
        ->join ('ingreso','alumnos.id_alumno', '=', 'ingreso.id_alumno')->first();
        $nombreLic = DB::table('catalogoespecialidades')->where('catalogoespecialidades.idEspecialidad', '=', $licenciatura->id_especialidad)->first();
        $nombreSemestre = DB::table('semestre')->where('semestre.id_semestre', '=', $imprimir->semestre)->first();
        
         if($nombreSemestre->id_semestre===1) {
            $concepto = 'INSCRIPCION';
            # code...
        }else $concepto = 'RE-INSCRIPCIÓN';
        
        $pdf = PDF::loadView('alumno_pdf.prorroga',compact('imprimir','alumno','nombreSemestre','nombreLic','concepto'));
      return $pdf->stream('prorroga.pdf');        

    }
}
