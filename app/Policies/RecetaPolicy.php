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
