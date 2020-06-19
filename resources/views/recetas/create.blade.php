@extends('layouts.app')

@section('buttons')
    <a href="{{ route('receta.index')}}" class="btn btn-primary">Volver</a>
@endsection

@section('content')
    <h2 class="text-center">Crear Receta</h2>
    
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
        <form action="{{ route('receta.store') }}" method="POST" class="form-create" novalidate>
            @csrf
                <div class="form-group">
                    <label for="title">Titulo Receta</label>
                    <input 
                        type="text" 
                        name="title" 
                        id="title" 
                        placeholder="Titulo Receta" 
                        class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') }}"
                    />
                    @error('title')
                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">
                        <i class="fas fa-utensils"></i>
                      </label>
                    </div>
                    <select class="custom-select" id="inputGroupSelect01">
                      <option selected disabled>Categorías</option>
                      @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="form-group text-center">
                    <input 
                        type="submit" 
                        class="btn btn-primary"
                        value="Agregar Receta"
                    />
                </div>
            </form>
        </div>
    </div>
    {{-- <div class="headline">
        <h1>
            Widget Inc.
        </h1>
    </div>
    <div style="height: 1000px;"></div>
    
    @push('scripts')
        <script>
           ScrollReveal().reveal('.headline');
        </script>
    @endpush --}}
@endsection