<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    protected $table = 'productos';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'producto',
        'imagen',
        'codigo',
        'descripcion',
        'categoria',
        'precio_con_iva',
        'precio_sin_iva',
        'created_at',
        'updated_at'
    ];
}
