@extends('layouts.app')

@section('buttons')
    <a href="{{ route('receta.index') }}" class="btn btn-primary mr-2" data-aos="fades-up-left">Volver</a>
@endsection

@section('content')

    <article class="recipe-content opacity">

        <div class="d-flex justify-content-center mb-2">
            <h1 class="title-h1 text-center mb-4" data-aos="zoom-in">{{ $recipe->title }}</h1>
        </div>

        <div class="image-recipe d-flex justify-content-center img-fluid mb-3">
            <img src="/storage/{{ $recipe->image }}" data-aos="flip-up" style="width: 100%" alt="{{ $recipe->title }}">
        </div>

        <div class="recipe-meta" data-aos="zoom-in">
            <p>
                <span class="font-weight-bold text-primary">
                    Escrito en: 
                </span>
                <span class="span-content">
                    {{ $recipe->category->name }}
                </span>
            </p>
            <p>
                <span class="font-weight-bold text-primary">
                    Autor: 
                </span>
                <span class="span-content">
                    {{ $recipe->user->name }}
                </span>
            </p>
            <p>
                <span class="font-weight-bold text-primary">
                    Fecha: 
                </span>
                <span class="span-content">
                    <date-recipe date="{{ $recipe->created_at }}"></date-recipe>
                </span>
            </p>

            <div class="ingredients">
                <div class="d-flex justify-content-center mb-2">
                    <h2 class="my-3 text-center title-h1">
                        Ingredientes
                    </h2>
                </div>
                <div class="ingredients__content">
                    {!! $recipe->ingredients !!}
                </div>
            </div>

            <div class="making">
                <div class="d-flex justify-content-center mb-2">
                    <h2 class="my-3 text-center title-h1">
                        Preparación
                    </h2>
                </div>
                
                <div class="making__content">
                    {!! $recipe->making !!}
                </div>
            </div>
        </div>

    </article>

@endsection