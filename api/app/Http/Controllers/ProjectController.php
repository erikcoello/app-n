<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Requests\SaveProjectRequest;

class ProjectController extends Controller
{

    //proteger rutas 
    public function __construct() {
        $this->middleware('auth')->only('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        return view('projects.index', [
               'projects' => Project:: latest()->paginate()

        ]);
    }


    public function show(Project $project)
    {
        return view('projects.show', [
            'project' => $project
        ]);
    }


    public function create()
    {
        return view('projects.create',[

            'project' => new Project

        ]);
    }


    public function store(SaveProjectRequest $request)
    {
            
            //return $request->all();
             Project::create($request->validated());

        
         return redirect()->route('projects.index')->with('status', 'el proyecto fue creado con éxito');

    }

     public function edit(Project $project)
    {
        return view('projects.edit', [
            'project' => $project
        ]);
    }

    public function update(Project $project, SaveProjectRequest $request)
    {
       $project ->update($request->validated());
        return redirect()->route('projects.show', $project)->with('status', 'el proyecto fue actualizado con éxito');
    }


    public function destroy(Project $project){

        $project->delete();
         return redirect()->route('projects.index')->with('status', 'el proyecto fue eliminado con exito');
    }


}
