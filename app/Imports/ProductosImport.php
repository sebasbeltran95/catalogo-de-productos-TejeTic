<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Productos;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductosImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach($collection as $n => $row){
            if($n != 0){
                $productos = new Productos();
                $productos->producto = $row[0];
                $productos->imagen = null;
                $productos->codigo = $row[1];
                $productos->descripcion = $row[2];
                $productos->categoria_id = Categoria::where('nombre_categoria', $row[3])->first()->id;
                $productos->precio_con_iva = $row[4];
                $productos->precio_sin_iva = $row[5];
                $productos->user_id = Auth()->user()->id;

                $productos->save();

            }
        }
    }
}
