<?php

namespace App\Http\Livewire;

use App\Models\Categoria as ModelsCategoria;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class Categoria extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $nombre_categoria;
    public $idx, $nombre_categoriax;
    public $search  = "";

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getCategoriaProperty()
    {
        if ($this->search == "") {
            return ModelsCategoria::orderBy('id','DESC')->paginate(5);
        } else {
            return ModelsCategoria::orWhere('nombre_categoria', 'LIKE', '%'.$this->search.'%')
                // ->orWhere('codigo', 'LIKE', '%'.$this->search.'%')
                // ->orWhere('descripcion', 'LIKE', '%'.$this->search.'%')
                // ->orWhere('categoria', 'LIKE', '%'.$this->search.'%')
                // ->orWhere('precio_con_iva', 'LIKE', '%'.$this->search.'%')
                // ->orWhere('precio_sin_iva', 'LIKE', '%'.$this->search.'%')
                ->paginate(3);
        }
    }

    public function crear()
    {
        try {
            $this->validate([
                'nombre_categoria' => 'required|string|max:255',
            ],[
                'nombre_categoria.required' => 'El campo Nombre Categoria es obligatorio',
                'nombre_categoria.string' => 'El campo Nombre Categoria recibe solo cadena de texto',
                'nombre_categoria.max' => 'El campo Nombre Categoria debe contener maximo 255 caracteres',
            ]);
    
            $user = new ModelsCategoria();
            $user->nombre_categoria =  $this->nombre_categoria;
            $user->save();

            $this->reset();
            $msj = ['!Registrado!', 'Se registro la Categoria', 'success'];
            $this->emit('ok', $msj);

        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e->getMessage(), 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function datacliente($obj)
    {
        $this->idx = $obj['id'];
        $this->nombre_categoriax =  $obj['nombre_categoria'];
    }

    public function actua()
    {
        try {

            $this->validate([
                'nombre_categoriax' => 'required|string|max:255',
            ],[
                'nombre_categoriax.required' => 'El campo Nombre Categoria es obligatorio',
                'nombre_categoriax.string' => 'El campo Nombre Categoria recibe solo cadena de texto',
                'nombre_categoriax.max' => 'El campo Nombre Categoria debe contener maximo 255 caracteres',
            ]);
    
            $data = ModelsCategoria::find($this->idx);
            $data->nombre_categoria = $this->nombre_categoriax;
            $data->save();
            $msj = ['!Actualizado!', 'Se actualizo la categoria', 'success'];
            $this->emit('ok', $msj);

        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e->getMessage(), 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function delete($post)
    {
        try { 

            ModelsCategoria::where('id',$post)->first()->delete();

         } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e->getMessage(), 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function render()
    {
        return view('livewire.categoria')->extends('layouts.plantilla_back')->section('contenido');
    }
}
