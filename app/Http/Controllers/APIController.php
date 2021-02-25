<?php

namespace App\Http\Controllers;

use App\Imagen;
use App\Categoria;
use App\Establecimiento;
use Illuminate\Http\Request;

class APIController extends Controller
{
    // Metodo para obtener todos los establecimientos
    public function index()
    {
        // como tenemos la funcion que hace relacion en el modelo de Establecimiento podemos usar with
        $establecimientos = Establecimiento::with('categoria')->get();

        return response()->json($establecimientos);
    }

    // Metodo para obtener todas las categorías
    public function categorias()
    {
        $categoria = Categoria::all();

        return response()->json($categoria);
        
    }

    // Muestra los establecimientos de la categoria en especifico
    public function categoria(Categoria $categoria)
    {
        // con el with('categoria') le estamos diciendo que carge también la información de categoría con la cual tiene relación, para eso se creo el metodo de relación en el modelo Establecimiento
        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->take(3)->get();

        return response()->json($establecimientos);

    }

    public function establecimientoscategoria( Categoria $categoria)
    {
        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->get();

        return response()->json($establecimientos);
    }

    // Muesta un establecimiento en especifico
    public function show( Establecimiento $establecimiento ) {

        $imagenes = Imagen::where('id_establecimiento', $establecimiento->uuid)->get();
        $establecimiento->imagenes = $imagenes;

        return response()->json($establecimiento);
    }
}
