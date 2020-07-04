<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(CategoriaReceta $category)
    {
        $recipes = Receta::where('category_id', $category->id)->paginate(6);
        return view('category.show', compact('recipes', 'category'));
    }
}
