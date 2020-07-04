<a href="{{ route('receta.create') }}" class="btn btn-primary mr-2" data-aos="fades-up-left">Crear Receta</a>
<a href="{{ route('profile.edit', $user) }}" class="btn btn-success mr-2" data-aos="fades-up-left">Editar Perfil</a>
<a href="{{ route('profile.show', $user) }}" class="btn btn-info mr-2 text-white" data-aos="fades-up-left">Ver Perfil</a>
<button type="button" class="btn like" data-toggle="modal" data-target="#exampleModal" data-aos="fades-up-left">
    <svg class="like__icon" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"><path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
</button>