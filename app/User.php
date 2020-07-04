<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'site',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    // Evento cuando un usuario es creado
    protected static function boot()
    {
        parent::boot();

        // Asignar perfil cuando se crea el usuario
        static::created(function ($user) {
            $user->perfil()->create();
        });
    }

    // Relacion 1:n Usuarios a Recetas
    public function recipes(){
        return $this->hasMany(Receta::class);
    }

    // Relacion 1:1 Usuario y Perfil
    public function profile(){
        return $this->hasOne(Perfil::class);
    }

    // Relacion n:n Usuarios a Likes Recetas
    public function meGusta(){
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }
}
