@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
    integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
    crossorigin="anonymous" />
@endsection

@section('hero')

    <div class="hero-categorias">
        <form action="{{ route('receta.search') }}" class="container h-100">
            <div class="row h-100 align-items-center" id="hero-items">
                <div class="col-md-8"></div>
                <div class="col-md-4 texto-buscar">
                    <p class="display-4">
                        Encuentra una receta para tu próxima comida
                    </p>
                    <input type="serch" name="search" class="form-control" placeholder="Buscar Receta">
                </div>
            </div>
        </form>
    </div>
    
@endsection

@section('content')

    <div class="home">
        <h2 class="text-uppercase mt-2">Últimas Recetas</h2>

        <div class="owl-carousel owl-theme">
            @foreach ($recipesNews as $recipeNew)
                <div class="card">
                    <img src="/storage/{{ $recipeNew->image }}" alt="{{ $recipeNew->title }}" class="card-img-top">
                    <div class="card-body">
                        <h3>{{ Str::title($recipeNew->title) }}</h3>
                        <p>{{ Str::words(strip_tags($recipeNew->making), 10) }}</p>
                        <a href="{{ route('receta.show', $recipeNew) }}" class="btn btn-primary btn-block text-uppercase">
                            Ver Receta
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <h2 class="text-uppercase mt-5 mb-4">Recetas más Votadas</h2>
        <div class="row">
            @foreach ($moreLikes as $recipe)
                @include('ui.receta')
            @endforeach
        </div>

        @foreach ($recipesCategories as $key =>  $group)
            <h2 class="text-uppercase mt-5 mb-4">{{str_replace('-', ' ', $key)}}</h2>
            <div class="row">
                @foreach ($group as $recipes)
                    @if (count($recipes) > 0)
                        @foreach ($recipes as $recipe)
                            @include('ui.receta')
                        @endforeach
                    @else
                        <div class="col">
                            <p>Aún no hay recetas en esta categoria</p>
                        </div>
                    @endif
                    
                @endforeach
            </div>
        @endforeach
    </div>
    @push('scripts')
        <script>
            if(window.innerWidth < 768){
                const heroParent = document.getElementById('hero-items');
                heroParent.removeChild(heroParent.children[0]);
            }

            window.addEventListener('resize', () => {
                const heroParents = document.getElementById('hero-items');
                if(window.innerWidth < 768 && heroParents.children.length == 2){
                    const heroParent = document.getElementById('hero-items');
                    heroParent.removeChild(heroParent.children[0]);
                }else{
                    const heroParent = document.getElementById('hero-items');

                    if(heroParent.children.length == 1){
                        const div = document.createElement('div');
                        div.classList.add('col-md-8');
                        heroParent.insertBefore(div, heroParent.children[0]);
                    }
                }
           });
        </script>
    @endpush

@endsection