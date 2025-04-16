<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;

class PlantillaProductosExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function array(): array
    {
        return [
            ['producto', 'codigo', 'descripcion', 'categoria', 'precio_con_iva', 'precio_sin_iva'],
            // Puedes incluir una fila de ejemplo si lo deseas:
            ['Ejemplo Producto', '123ABC', 'Descripción aquí', 'cables1', 100.00, 84.03],
        ];
    }
}
