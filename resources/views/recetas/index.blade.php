@extends('layouts.app')

@section('buttons')
    <a href="{{ route('receta.create') }}" class="btn btn-primary mr-2" data-aos="fades-up-left">Crear Receta</a>
@endsection


@section('content')
    <div class="col-md-10 mx-auto  p-3">
        <div class="title">
            <h1 class="text-center mb-5 title-h1" data-aos="zoom-in">Administra tus recetas</h1>
        </div>
        
        <table class="table" data-aos="zoom-in">
            <thead class="bg-primary text-light">
                <tr>
                    <th class="text-center" scole="col">Titulo</th>
                    <th class="text-center" scole="col">Categoria</th>
                    <th class="text-center" scole="col">Acciones</th>
                </tr>
            </thead>

            <tbody class="bg-dark text-light" id="tbody">
                
                @foreach ($recipes as $recipe)
                    <tr>
                        <td class="text-center">{{ $recipe->title }}</td>
                        <td class="text-center">{{ $recipe->category->name }}</td>
                        <td>
                            <div class="text-center actions-recipe">
                                <a class="btn btn-info" href="/receta/{{ $recipe->id }}/edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger" onclick="confimrDelete(event, {{$recipe->id}} )" >
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a class="btn btn-success" href="/receta/{{ $recipe->id }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div> 
                        </td>
                    </tr>
                @endforeach

            </tbody>
            
        </table>
    </div>
    @push('scripts')
        <script>
            const recipes = [
                @foreach ($recipes as $recipe)
                    {
                        'id':  "{{ $recipe->id }}",
                        'title':  "{{ $recipe->title }}",
                    }, 
                @endforeach
            ]
            
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

            if({{ session('ok') === 'true' ? 'true' :  'false' }}){
               showAlert('success', 'Receta se creo correctamente.');
            }

            if({{ session('ok-update') === 'true' ? 'true' :  'false' }}){
               showAlert('success', 'Receta se actualizó correctamente.');
            }

            const showActionsMovil = () => {
                const childrens = [...document.getElementById('tbody').children];
                    
                    childrens.map((i, index) => {
                        i.children[2].children[0].classList.remove('actions-recipe');
                        i.children[2].children[0].innerHTML = `
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Acciones
                                </button>
                                <div class="dropdown-menu text-center items-drop actions-recipe" aria-labelledby="dropdownMenuButton">
                                    <a class="btn btn-info" href="/receta/${recipes[index].id}/edit">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a class="btn btn-danger" onclick="confimrDelete(event, ${recipes[index].id})">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                    <a class="btn btn-success" href="/receta/${recipes[index].id}">
                                        <i class="fas fa-eye"></i>
                                    </a>    
                                </div>
                            </div>
                        `;
                    })
            }

            if(window.innerWidth < 764){
                showActionsMovil();
            }

           window.addEventListener('resize', () => {
                if(window.innerWidth < 764){
                    showActionsMovil();
                }else {
                    const childrens = [...document.getElementById('tbody').children];
                    
                    childrens.map((i, index) => {
                        i.children[2].children[0].classList.add('actions-recipe');
                        i.children[2].children[0].innerHTML = `
                            <div class="text-center actions-recipe">
                                <a class="btn btn-info" href="/receta/${recipes[index].id}/edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger" onclick="confimrDelete(event, ${recipes[index].id})">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <a class="btn btn-success" href="/receta/${recipes[index].id}">
                                    <i class="fas fa-eye"></i>
                                </a>    
                            </div> 
                        `;
                    })
                    
                }
           });

           const confimrDelete = (e, id) => {
                e.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro de eliminar esta receta?',
                    text: 'Una vez eliminada, no se puedrá recuperar',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Si, eliminarla!',
                    cancelButtonText: 'No, mantenerla'
                    }).then((result) => {
                    if (result.value) {

                        axios.delete(`/receta/${id}`)
                        .then((res) => {
                            console.log(res);
                        })
                        .catch((error) => {
                            console.log(error);
                        });

                        Swal.fire(
                        '¡Eliminada!',
                        'La receta ha sido eliminada',
                        'success',
                        )
                        setTimeout(()=> {
                            location.reload();
                        }, 1500);
                        
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire(
                        'Cancelado',
                        'No se ha eliminado la receta',
                        'error'
                        )
                    }
                })
           }
           
        </script>
    @endpush
@endsection