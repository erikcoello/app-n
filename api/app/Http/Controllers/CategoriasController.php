<?php

namespace App\Http\Controllers;
use App\Categories;
use Illuminate\Http\Request;
use App\Http\Requests\SaveCategoriaRequest;
class CategoriasController extends Controller
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
        $categorias = Categories::all();  
        return view('categorias/index', compact( 'categorias'));
    }

    public function create(){
            $this->authorize('create', Categories::class);


         return view('categorias.create',[

            'categoria' => new Categories
             ]);
    }



    public function store(SaveCategoriaRequest $request)
    {
            
            //return $request->all();
             Categories::create($request->validated());

        
         return redirect()->route('categorias.index')->with('status', 'La Categoria  fue creada con éxito');

    }

        /// es la base de datos y la variable que se trae del index en los parametros

    public function edit(Categories $categoria)
        {
                    $this->authorize('edit', $categoria);

           /* return $categoria;*/
            return view('categorias.edit', [
                'categoria' => $categoria
            ]);
        }



           public function update(Categories $categoria, SaveCategoriaRequest $request)
        {

            $this->authorize('update', $categoria);

           $categoria ->update($request->validated());
            return redirect()->route('categorias.index', $categoria)->with('status', 'el proyecto fue actualizado con éxito');
        }


      public function destroy(Request $request){
            $eliminar  = Categories::find($request->categoria_id);
           $this->authorize('delete', $eliminar);

        $eliminar->delete();
        return back();
         //return redirect()->route('categorias.index')->with('status', 'el proyecto fue eliminado con exito');
    }


       

    }// fin clase CategoriasController
