<nav class="navbar navbar-expand-md navbar-light categorias-bg bg-white">
    <div class="container">
        <button class="navbar-toggler btn-block" type="button" data-toggle="collapse" data-target="#categorias"
            aria-controls="categorias" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
            Categorías
        </button>
        <div class="collapse navbar-collapse " id="categorias">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav w-100 d-flex justify-content-between">
                @foreach ($categorias as $categoria)
                <li class="nav-item">
                    <a class="nav-link text-primary" href="{{ route('category.show', $categoria) }}">
                        {{ $categoria->name }}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>