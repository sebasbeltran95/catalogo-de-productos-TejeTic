<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Productos;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Component
{

    public $prodcutos_año;
    public $productos_mes;
    public $usuarios_registrados;
    public $categorias;
    public $produc;


    public function mount()
    {

        // me trae todos los posts que se publicaron en el año actual
        $this->prodcutos_año = Productos::whereYear('created_at', Carbon::now()->year)->count();

        // me trae todos los posts que se publicaron por año actual y mes actual
        $this->productos_mes = Productos::whereYear('created_at', Carbon::now()->year)
                            ->whereMonth('created_at', Carbon::now()->month)
                            ->count();

        // me trae cuantos usuarios hay creados
        $this->usuarios_registrados = User::count();

        // me trae cuantos categorias hay creados
        $this->categorias = Categoria::count();


        // consulta graficas 
        $this->produc = Productos::selectRaw('MONTH(created_at) AS month, COUNT(*) AS posts')
        ->whereYear('created_at', Carbon::now()->year)  // Filtra por el año actual
        ->groupByRaw('MONTH(created_at)')  // Agrupamos por el número del mes
        ->orderByRaw('MONTH(created_at) DESC')  // Ordenamos de manera descendente por el número de mes
        ->get()
        ->map(function ($item) {
            // Creamos un array con el mes (por nombre) y el número de posts
            $monthNames = [
                1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio',
                7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
            ];
            
            
            return [
                'Meses' => $monthNames[$item->month],  // Nombre del mes usando el número
                'Value' => $item->posts  // Cantidad de posts
            ];
        })
        ->toArray();  // Convertir a un array simple para pasarlo a JavaScript

    }

    public function render()
    {
        return view('livewire.dashboard')->extends('layouts.plantilla_back')->section('contenido');
    }
}
