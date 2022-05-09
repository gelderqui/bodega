<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    use HasFactory;
    //protected $table = 'detalle';
    protected $fillable=['idfactura','idproducto','cantidad','precio'];
    public $timestamps = false;
}
