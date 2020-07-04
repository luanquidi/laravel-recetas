@extends('layouts.app')

@section('content')
    <div class="home">
    <h2 class="text-uppercase mt-2">Resultados: {{ $recipes->total() }}</h2>
        <div class="row">
            @foreach ($recipes as $recipe)
                @include('ui.receta')
            @endforeach
        </div>

        <div class="mt-4">
            {{ $recipes->links() }}
        </div>
    </div>
@endsection