@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.css" integrity="sha256-scOSmTNhvwKJmV7JQCuR7e6SQ3U9PcJ5rM/OMgL78X8=" crossorigin="anonymous" />
@endsection

@section('buttons')
    <a href="{{ route('profile.show', $profile) }}" class="btn btn-primary"  data-aos="flip-up">Volver</a>
@endsection

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8" data-aos="fade-up">
            <div class="title">
                <h1 
                    class="text-center mb-5 title-h1"  
                    data-aos="fade-down"
                >
                    Editar Perfil
                </h1>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-2">

        <div class="col-md-8 bg-white p-4 rounded">
            <form 
                action="{{ route('profile.update', $profile) }}" 
                method="POST"
                enctype="multipart/form-data"
            >

                @csrf @method('PUT')

                <div class="form-group">
                    <label for="title">Nombre</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        placeholder="Nombre" 
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') ? old('name') : $profile->user->name  }}"
                    />
                    @error('name')
                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title">Sitio Web</label>
                    <input 
                        type="text" 
                        name="site" 
                        id="site" 
                        placeholder="Tu Sitio Web" 
                        class="form-control @error('site') is-invalid @enderror"
                        value="{{ old('site') ? old('site') : $profile->user->site  }}"
                    />
                    @error('site')
                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="making">Biografía</label>
                    <input 
                        type="hidden" 
                        id="biography"
                        name="biography" 
                        value="{{ old('biography') ? old('biography') : $profile->biography  }}"
                    >
                    <trix-editor input="biography" class="@error('biography') is-invalid-trix @enderror"></trix-editor>
                    @error('biography')
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

                @if ($profile->image)
                    <div class="d-flex justify-content-center my-4">
                        <div>
                            <p class="text-center">Imagen actual:</p>
                            <img src="/storage/{{ $profile->image }}" alt="Profile" class="rounded-circle" width="250">
                        </div>
                    </div>
                @endif

                <div class="form-group text-center">
                    <input 
                        type="submit" 
                        class="btn btn-primary"
                        value="Editar Perfil"
                    />
                </div>

            </form>
        </div>
        
@endsection

@push('scripts')

    {{-- Trix Editor Script --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.3/trix.js" integrity="sha256-b2QKiCv0BXIIuoHBOxol1XbUcNjWqOcZixymQn9CQDE=" crossorigin="anonymous" defer></script>

@endpush
