<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'title', 'category_id', 'ingredients', 'making', 'image',
    ];

    // 1:1 relacion
    public function category () {
        return $this->belongsTo(CategoriaReceta::class);
    }

    public function user () {
        return $this->belongsTo(User::class);
    }
    // Likes que ha recibido
    public function likes () {
        return $this->belongsToMany(User::class, 'likes_receta');
    }
}
