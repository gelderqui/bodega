<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $fillable=['idpoveedor','idusuario','numero','serie','total','descuento_nota','flete','condicion'];

    public function proveedor(){
        return $this->belongsTo('App\Models\Proveedor');
    }
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
