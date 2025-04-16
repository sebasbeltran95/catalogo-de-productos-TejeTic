<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;
    protected $table = 'categorias';

    public function getKeyName(){
        return "id";
    }

    public $fillable = [
        'id',
        'nombre_categoria',
        'created_at',
        'updated_at'
    ];
}
