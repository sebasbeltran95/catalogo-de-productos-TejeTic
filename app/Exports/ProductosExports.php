<?php

namespace App\Exports;

use App\Models\Productos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductosExports implements FromCollection, WithHeadings
{
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function headings(): array
    {
        return [
            'Nombre Prodcuto',
            'imagen',
            'codigo',
            'descripcion',
            'categoria',
            'precio con iva',
            'precio sin iva'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->data != ''){
            return Productos::orWhere('producto', 'LIKE', '%'.$this->data.'%')
            ->orWhere('codigo', 'LIKE', '%'.$this->data.'%')
            ->orWhere('descripcion', 'LIKE', '%'.$this->data.'%')
            ->orWhere('precio_con_iva', 'LIKE', '%'.$this->data.'%')
            ->orWhere('precio_sin_iva', 'LIKE', '%'.$this->data.'%')
            ->join('categorias', 'productos.categoria_id', '=',  'categorias.id')->
            select('productos.producto','productos.imagen','productos.codigo', 'productos.descripcion', 'categorias.nombre_categoria', 'productos.precio_con_iva','productos.precio_sin_iva')->get();
        } else {
            return Productos::join('categorias', 'productos.categoria_id', '=',  'categorias.id')->
                    select('productos.producto','productos.imagen','productos.codigo', 'productos.descripcion', 'categorias.nombre_categoria', 'productos.precio_con_iva','productos.precio_sin_iva')->get();
        }
    }
}
