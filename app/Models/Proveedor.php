<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;
    protected $table = 'proveedores';

    protected $fillable=['nombre','contacto','telefono','condicion'];

    public function facturas()
    {
        return $this->hasMany('App\Models\Factura');
    }
}
