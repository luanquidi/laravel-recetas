<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function show(Perfil $profile)
    {
        $recipes = Receta::where('user_id', $profile->user_id)->paginate(10);
        return view('profiles.show', compact('profile', 'recipes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit(Perfil $profile)
    {
        // Policy para bloquear a un usuario al edit del profile
        $this->authorize('view', $profile);

        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $profile)
    {
        $this->authorize('update', $profile);

        $data = request()->validate([
            'biography' => 'required',
            'name' => 'required',
            'site' => 'required',
        ]);

        // Si el usuario sube una imagen

        if ($request->image){
            
            $ruta_image = $request['image']->store('upload-profiles', 'public');
            $img = Image::make(public_path("storage/{$ruta_image}"))->fit(500, 500);
            $img->save();
            

            // Arreglo de imagenes
            $array_image = ['image' => $ruta_image];
            auth()->user()->profile->image = $ruta_image;
        }

        // Asignar nombre y URL

        auth()->user()->name = $data['name'];
        auth()->user()->site = $data['site'];
        auth()->user()->save();

        // Asignar Biografia e  imagen - Quitar campos de site y name del data

        unset($data['site']);
        unset($data['name']);

        auth()->user()->profile->update( array_merge(
            $data,
            $array_image ?? []
        ));

        // Guardar información
        
        return  redirect()
                ->action('RecetaController@index')
                ->with('ok', 'true:update:profile');
    }
}
