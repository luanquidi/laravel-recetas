<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Recetas que te gustan
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    @foreach (Auth::user()->meGusta as $likeRecipe)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p> {{ $likeRecipe->title }} </p>
                            <a 
                                href=" {{ route('receta.show', $likeRecipe) }} "
                                class="btn btn-outline-success text-uppercase"
                            >
                                Ver
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>