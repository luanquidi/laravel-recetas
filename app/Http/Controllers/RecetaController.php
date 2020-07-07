<?php

namespace App\Http\Controllers;

use App\Receta;
use App\CategoriaReceta;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{


    // ->except(['index', 'show'])

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // $recipes = Auth::user()->recipes;

        $recipes = Receta::where('user_id', $user->id)->paginate(10);

        return view('recetas.index', compact('recipes', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories = CategoriaReceta::all();

        return view('recetas.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|min:6',
            'category_id' => 'required',
            'making' => 'required|min:20',
            'ingredients' => 'required|min:20',
            'image' => 'required|image',
        ]);

        $ruta_image = $request['image']->store('upload-recetas', 'public');

        $img = Image::make(public_path("storage/" . $ruta_image))->fit(1000, 550);
        $img->save();

        // DB::table('recetas')->insert([
        //     'title' => $data['title'],
        //     'category_id' => $data['category_id'],
        //     'making' => $data['making'],
        //     'ingredients' => $data['ingredients'],
        //     'user_id' => Auth::user()->id,
        //     'image' => $ruta_image,
        // ]);

        Auth::user()->recipes()->create([
            'title' => $data['title'],
            'category_id' => $data['category_id'],
            'making' => $data['making'],
            'ingredients' => $data['ingredients'],
            'image' => $ruta_image,
        ]);

        return redirect()->action('RecetaController@index')->with('ok', 'true');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Excel::download(new UsersExport, 'users.xlsx');


        // Obetener si el usuario le dio me gusta
        
        $recipe = Receta::findOrFail($id);
        $like = (auth()->user()) ? auth()->user()->meGusta->contains($recipe->id) : false;
        $countLikes = $recipe->likes->count();

        return view('recetas.show', compact('recipe', 'like', 'countLikes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Receta $recetum)
    {
        $this->authorize('view', $recetum);

        $categories = CategoriaReceta::all();
        $recipe = $recetum;
        
        return view('recetas.edit', compact('recipe', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $recipe = Receta::findOrFail($id);

        // Revisar Policy

        $this->authorize('update', $recipe);

        $data = request()->validate([
            'title' => 'required|min:6',
            'category_id' => 'required',
            'making' => 'required',
            'ingredients' => 'required',
            'image' => 'image',
        ]);

        $recipe->title = $data['title'];
        $recipe->making = $data['making'];
        $recipe->ingredients = $data['ingredients'];
        $recipe->category_id = $data['category_id'];

        if (request('image')) {
            $ruta_image = $request['image']->store('upload-recetas', 'public');
            $img = Image::make(public_path("storage/{$ruta_image}"))->fit(1000, 550);
            $img->save();
            $recipe->image = $ruta_image;
        }

        $recipe->save();

        return redirect()->action('RecetaController@index')->with('ok', 'true:update:recipe');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $recipe = Receta::findOrFail($id);
        $this->authorize('delete', $recipe);
        $recipe->delete();
    }

    public function search(Request $request)
    {
       $query = $request->search;
       $recipes = Receta::where('title', 'like', '%' . $query . '%')->paginate(6);

       return view('ui.search', compact('recipes'));

    }
}
