<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function index()
    {
        // Recetas más nuevas
        $recipesNews = Receta::latest()->take(6)->get();

        // Recetas más votadas
        // $moreLikes = Receta::has('likes', '>', 1)->get();
        $moreLikes = Receta::withCount('likes')->orderBy('likes_count', 'desc')->take(3)->get();

        // Recetas por categoria
        $categories = CategoriaReceta::all();

        // Agrupar recetas por categoria
        $recipesCategories = [];

        foreach($categories as $categorie){
            $recipesCategories[ Str::slug($categorie->name) ][] = Receta::where('category_id', $categorie->id)->take(3)->get();
        }

        return view('inicio.index', compact('recipesNews', 'recipesCategories', 'moreLikes'));
    }
}
