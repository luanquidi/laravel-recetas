<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    protected $fillable = [
        'biography', 'user_id', 'image',
    ];
    // Relacion 1:1 Perfil con Usuario
    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
