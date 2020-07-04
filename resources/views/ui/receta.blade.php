<div class="col-md-4 mt-4" data-aos="flip-up">
    <div class="card shadow">
        <img src="/storage/{{ $recipe->image }}" alt="{{ $recipe->title }}" class="card-img-top">
        <div class="card-body">
            <h3 class="card-title">{{ Str::title($recipe->title) }}</h3>
            <div class="d-flex justify-content-between">
                <p class="font-weight-bold text-primary">
                    <date-recipe date="{{ $recipe->created_at }}"></date-recipe>
                </p>
                <p>{{ count($recipe->likes) }} Likes</p>
            </div>
            <p>{{ Str::words(strip_tags($recipe->making), 10) }}</p>
            <a href="{{ route('receta.show', $recipe) }}" class="btn btn-primary btn-block text-uppercase">
                Ver Receta
            </a>
        </div>
    </div>
</div>