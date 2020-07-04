@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" integrity="sha256-scOSmTNhvwKJmV7JQCuR7e6SQ3U9PcJ5rM/OMgL78X8=" crossorigin="anonymous" />
@endsection

@section('buttons')
    <a href="{{ route('receta.index')}}" class="btn btn-primary"  data-aos="flip-up">Volver</a>
@endsection

@section('content')
    
    
    <div class="row justify-content-center mt-5">

        <div class="col-md-8" data-aos="fade-up">
            <div class="title">
                <h1 
                    class="text-center mb-5 title-h1"  
                    data-aos="fade-down"
                >
                    Editar Receta
                </h1>
            </div>
        <form action="{{ route('receta.update', $recipe) }}" method="POST" class="form-create bg-white" enctype="multipart/form-data" novalidate>
            @csrf @method('PUT')

                <div class="form-group">
                    <div class="form-row">

                        <div class="col">
                            <label for="title">Titulo Receta</label>
                            <input 
                                type="text" 
                                name="title" 
                                id="title" 
                                placeholder="Titulo Receta" 
                                class="form-control @error('title') is-invalid @enderror"
                                value="{{ old('title') ? old('title') : $recipe->title  }}"
                            />
                            @error('title')
                                <span class="invalid-feedback d-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>


                        <div class="col">
                            <label>Categoría</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <label class="input-group-text" for="inputGroupSelect01">
                                    <i class="fas fa-utensils"></i>
                                  </label>
                                </div>
                                <select 
                                    class="custom-select @error('category_id') is-invalid @enderror" 
                                    id="inputGroupSelect01" 
                                    name="category_id"
                                >
                                  <option value="" selected>Categorías</option>
                                  @foreach ($categories as $category)
                                    <option 
                                        value="{{ $category->id }}" 
                                        {{ old('category_id') ? (old('category_id')  == $category->id ? 'selected' : '') : ($recipe->category_id == $category->id ? 'selected' : '')}}
                                    >
                                        {{ $category->name }}
                                    </option>
                                  @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback d-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                              </div>
                        </div>
                        
                    </div>
                </div>

                
                
                <div class="form-group">
                    <label for="making">Preparación</label>
                    <input 
                        type="hidden" 
                        id="making" 
                        name="making" 
                        value="{{ old('making') ? old('making') : $recipe->making  }}"
                    >
                    <trix-editor input="making" class="@error('making') is-invalid-trix @enderror"></trix-editor>
                    @error('making')
                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="ingredients">Ingredientes</label>
                    <input 
                      type="hidden" 
                      id="ingredients" 
                      name="ingredients" 
                      value="{{ old('ingredients') ? old('ingredients') : $recipe->ingredients  }}"
                     >
                    <trix-editor input="ingredients" class="@error('ingredients') is-invalid-trix @enderror"></trix-editor>
                    @error('ingredients')
                    <span class="invalid-feedback d-block" role="alert">
                        {{ $message }}
                    </span>
                @enderror
                </div>

                <div class="form-group mt-3">
                    <label for="image">Imagen</label>
                    <input 
                        type="file" 
                        name="image"
                        id="image" 
                        class="form-control @error('image') is-invalid @enderror"
                    />
                    @error('image')
                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-center my-4">
                    <div>
                        <p class="text-center">Imagen actual:</p>
                        <img src="/storage/{{ $recipe->image }}" alt="" width="300px">
                    </div>
                </div>

                <div class="form-group text-center">
                    <input 
                        type="submit" 
                        class="btn btn-primary"
                        value="Editar Receta"
                    />
                </div>
            </form>
        </div>
    </div>
    @push('scripts')

        {{-- Trix Script --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha256-b2QKiCv0BXIIuoHBOxol1XbUcNjWqOcZixymQn9CQDE=" crossorigin="anonymous" defer></script>

        <script>
            
            const showAlert = (type, text) => {
                const bg = (type === 'error' ? '#f51616' : '#6ab52d');

                Toastify({
                    text: text,
                    duration: 5000, 
                    // destination: "https://github.com/apvarun/toastify-js",
                    // newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: 'right', // `left`, `center` or `right`
                    backgroundColor: bg,
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    onClick: function(){} // Callback after click
                }).showToast();
            }

            switch (key) {
                case value:
                    
                    break;
            
                default:
                    break;
            }

            if({{ $errors->any() ? 'true' :  'false' }}){
               showAlert('error', 'Todos los campos son obligatorios.');
            }
        </script>
    @endpush
@endsection