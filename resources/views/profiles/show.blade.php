@extends('layouts.app')


@section('buttons')
    <a href="{{ route('receta.index') }}" class="btn btn-primary mr-2" data-aos="fades-up-left">Volver</a>
@endsection

@section('content')
<div class="container profile" data-aos="zoom-out-down">
    <div class="row opacity">
        <div class="col-md-5 pr-md-4 pl-md-0  profile__image" >
            @if ($profile->image)
            <img src="/storage/{{ $profile->image }}" alt="Image profile" class="rounded-circle w-100">
            @endif
        </div>
        <div class="col-md-7 text-center mt-5 mt-md-0 bg-white profile__content">
            <h2 class="mb-2">
                {{ $profile->user->name }}
            </h2>
            <a class="btn btn-primary" href="{{ $profile->user->site }}" target="_blank">
                Visitar Sitio Web
            </a>
            <div class="profile__biography">
                {!! $profile->biography !!}
            </div>
        </div>
    </div>
</div>

<div class="recipes mt-4 opacity" data-aos="zoom-out-up">
    <div class="title">
        <h2 class="title-h1 text-center">Recetas creadas por: {{ explode(" ", Auth::user()->name)[0] }}</h2>
    </div>

    @if (count($recipes) > 0)
    <div class="recipes__content">
        <div class="row mx-auto p-4">
            @foreach ($recipes as $recipe)
            <div class="col-md-4 mb-4">
                <div class="card action recipes__content__item">
                    <img src="/storage/{{ $recipe->image }}" class="card-img-top" alt=" {{ $recipe->title }} ">
                    <div class="card-body">
                        <h5 class="card-title text-center"> {{ $recipe->title }} </h5>
                        {{-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> --}}
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-block btn-outline-primary" href=" {{ route('receta.show', $recipe) }} ">
                            Ver Receta
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    {{ $recipes->links() }}
    @else
    <div class="recipes__empty">
        <p>Aún no ha creado recetas</p>
    </div>
    @endif
</div>
@endsection