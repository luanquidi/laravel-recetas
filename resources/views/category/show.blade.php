@extends('layouts.app')


@section('content')
    <div 
        class="home" 
        data-aos="fade-up"
    >
        <h2 class="text-uppercase mt-2">{{ $category->name }}</h2>

        <div class="row">
            @foreach ($recipes as $recipe)
                @include('ui.receta')
            @endforeach
        </div>
        
        <div class="mt-3">
            {{ $recipes->links() }}
        </div>
    </div>
@endsection