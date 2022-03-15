<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $fillable=['nombre','descripcion','cantidad','condicion'];
    public function precios()
    {
        return $this->hasMany('App\Models\Precio');
    }
}
