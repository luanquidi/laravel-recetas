<?php

namespace App\Policies;

use App\User;
use App\Receta;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecetaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Receta $recetum)
    {
        // Revisa si el usuario es el mismo que creo receta
        return $user->id === $recetum->user_id;
    }

    public function update(User $user, Receta $recipe)
    {
        // Revisa si el usuario es el mismo que creo receta

        return $user->id === $recipe->user_id;
    }

    public function delete(User $user, Receta $recipe)
    {
        // Revisa si el usuario es el mismo que creo receta

        return $user->id === $recipe->user_id;
    }
}
