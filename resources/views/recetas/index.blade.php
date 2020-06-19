@extends('layouts.app')

@section('buttons')
    <a href="{{ route('receta.create') }}" class="btn btn-primary mr-2">Crear Receta</a>
@endsection


@section('content')
    <h2 class="text-center mb-5">Administra tus recetas</h2>
    <div class="col-md-10 mx-auto bg-white p-3">
        <table class="table">
            <thead class="bg-primary text-light">
                <tr>
                    <th class="text-center" scole="col">Titulo</th>
                    <th class="text-center" scole="col">Categoria</th>
                    <th class="text-center" scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="bg-dark text-light">
                <tr>
                    <td class="text-center">Pizza</td>
                    <td class="text-center">Comida Italiana</td>
                    <td>
                       <div class="text-center">
                            <button class="btn btn-info">edit</button>
                            <button class="btn btn-danger">delete</button>
                            <button class="btn btn-success">ver</button>    
                        </div> 
                    </td>
                    
                </tr>
            </tbody>
        </table>
    </div>
@endsection