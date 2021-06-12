<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionBioEstudiante extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
              'nombre' => 'required|min:4',
              'apellido_paterno' => 'required|min:2',
              'apellido_materno' => 'required|min:2',
              'curp' => 'required|min:18|max:18',
              'celular' => 'required|numeric|min:10',
              //'correo'=>   'required|unique:alumnos,correo|max:255',
              'matricula' =>    'required|max:191',
              'sexo' =>    'required|max:2',
              'nss'  =>    'required|max:191',
              'fecha_nacimiento' => 'required|max:192',
              'alergias'  =>'required|max:192',
              'enfermedades'  =>'required|max:192',
              'sangre' => 'required|max:192', 
              'edo_civil'  =>'required|max:192', 
              //'hijos'  =>'required|max:192', 
              'discapacidades'  =>'required|max:192', 
              'calle'  =>'required|max:192',
              'numero_exterior' => 'required|max:192',
              'colonia'  =>'required|max:192', 
              'codigo_postal'  =>'required|numeric|min:5',
              'municipio'  =>'required|max:192',
              'estado'  =>'required|max:192',
              'lugar_nacimiento'  =>'required|max:192',
              'nacionalidad'  =>'required|max:192',  
              'bachillerato'  =>'required|max:192', 
              'clave_bachillerato'  =>'required|max:192',
              'id_semestre'  =>'required|max:192',    
              'procedencia_bachillerato'  =>'required|max:192',
              'promedio_bachillerato'  =>'required|max:192', 
              'padre_tutor'  =>'required|max:192',  
              'tel_tutor'  =>'required|max:192', 
              'cel_tutor'  =>'required|max:192',
              'mail_tutor' =>'required|email|max:192', 
                
      
              
        ];
    }
}
