<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidacionEditarEstudiante extends FormRequest
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
              'nombre' => 'required|max:100',
              'apellido_paterno' => 'required|max:100',
              'apellido_materno' => 'required|max:100',
              'celular' => 'required|numeric|min:10',
              'pass' =>  ['string', 'min:8', 'confirmed'],
              'pass_confirmation' => 'required',
              'curp'=>'required|min:18|max:18',
              'matricula'=>'required|max:192',
              'email'=>  ['required', 'string', 'email', 'max:255', 'unique:users'],

              'idEspecialidad'=>'required|max:100',
              //'grupoAlumno'=>'required|max:5',
              'plan_estudios' =>'required|max:100',
              //'tipo_ingreso' => 'required|max:50', 
              //'id_semestre'=>'required|max:50',
              //'ciclo_escolar' => 'required|max:50',
              
             
             
            
              
             
             
            
        ];
    }
}
