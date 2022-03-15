<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Precio extends Model
{
    use HasFactory;

    protected $fillable=['idproducto','precio','descripcion','condicion'];

    public function producto(){
        return $this->belongsTo('App\Models\Producto');
    }

}
