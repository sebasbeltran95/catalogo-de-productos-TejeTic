<?php

namespace App\Http\Livewire;

use App\Exports\ProductosExports;
use App\Imports\ProductosImport;
use App\Models\Categoria;
use App\Models\Productos as ModelsProductos;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PlantillaProductosExport;


class Productos extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $producto, $codigo, $descripcion, $categoria_id, $precio_con_iva, $precio_sin_iva,$user_id;
    public $idy, $idx, $productox, $imagenx, $codigox, $descripcionx, $categoria_idx, $precio_con_ivax, $precio_sin_ivax, $user_idx;
    public $search  = "", $category, $categoryy, $file, $descripcion_producto;

    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getProductosProperty()
    {
        if (Auth::user()->rol == 'Admon') {
            if ($this->search == "") {
                return ModelsProductos::orderBy('id','DESC')->paginate(5);
            } else {
                return ModelsProductos::orWhere('producto', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('codigo', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('descripcion', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('precio_con_iva', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('precio_sin_iva', 'LIKE', '%'.$this->search.'%')
                    ->paginate(3);
            }
        } else {
            if ($this->search == "") {
                return ModelsProductos::where('user_id', Auth::user()->id)->orderBy('id', 'DESC')->paginate(5);
            } else {
                return ModelsProductos::where('user_id', Auth::user()->id)
                    ->orWhere('producto', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('codigo', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('descripcion', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('precio_con_iva', 'LIKE', '%'.$this->search.'%')
                    ->orWhere('precio_sin_iva', 'LIKE', '%'.$this->search.'%')
                    ->paginate(3);
            }
        }
    }

    // El slug lo que entiendo viene siendo como la ruta dinamica que va a tener cada
    // post que se cree
    public function crear()
    {
        try {
            $this->validate([
                'producto' => 'required|string|max:255',
                'codigo' => 'required|string|max:255',
                'descripcion' => 'required|string|max:255 ',
                'categoria_id' => 'required|numeric',
                'precio_con_iva' => 'required|numeric ',
                'precio_sin_iva' => 'required|numeric',
            ],[
                'producto.required' => 'El campo Producto es obligatorio',
                'producto.string' => 'El campo Producto recibe solo cadena de texto',
                'producto.max' => 'El campo Producto debe contener maximo 255 caracteres',
                'codigo.required' => 'El campo Codigo es obligatorio',
                'codigo.string' => 'El campo Codigo recibe solo cadena de texto',
                'codigo.max' => 'El campo Codigo debe contener maximo 255 caracteres',
                'descripcion.required' => 'El campo Descripcion es obligatorio',
                'descripcion.string' => 'El campo Descripcion recibe solo cadena de texto',
                'descripcion.max' => 'El campo Descripcion debe contener maximo 255  caracteres',
                'categoria_id.required' => 'El campo Categoria es obligatorio',
                'categoria_id.numeric' => 'El campo Categoria recibe solo numeros enteros',
                'precio_con_iva.required' => 'El campo Precio con iva es obligatorio',
                'precio_con_iva.numeric' => 'El campo Precio con iva recibe solo numeros enteros',
                'precio_sin_iva.required' => 'El campo Precio sin iva es obligatorio',
                'precio_sin_iva.numeric' => 'El campo Precio sin iva recibe solo numeros enteros',
            ]);
    
            $user = new ModelsProductos();
            $user->producto =  $this->producto;
            $user->codigo =  $this->codigo;
            $user->descripcion =  $this->descripcion;
            $user->categoria_id =  $this->categoria_id;
            $user->precio_con_iva =  $this->precio_con_iva;
            $user->precio_sin_iva =  $this->precio_sin_iva;
            $user->user_id =  Auth()->user()->id;
            $user->save();

            $this->reset();
            $msj = ['!Registrado!', 'Se registro el Prodcuto', 'success'];
            $this->emit('ok', $msj);

        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e->getMessage(), 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function datacliente($obj)
    {
        $this->idx = $obj['id'];
        $this->productox =  $obj['producto'];
        $this->codigox = $obj['codigo'];
        $this->descripcionx = $obj['descripcion'];
        $this->categoria_idx = $obj['categoria_id'];
        $this->precio_con_ivax = $obj['precio_con_iva'];
        $this->precio_sin_ivax = $obj['precio_sin_iva'];
    }

    public function cargardescripcion($obj){

        $temp = ModelsProductos::find($obj['id']);

        $this->idy = $temp->id;
        $this->descripcion_producto = $temp->descripcion;
    }

    public function actua()
    {
        try {

            $this->validate([
                'productox' => 'required|string|max:255',
                'codigox' => 'required|string|max:255',
                'descripcionx' => 'required|string|max:255 ',
                'categoria_idx' => 'required|numeric',
                'precio_con_ivax' => 'required|numeric ',
                'precio_sin_ivax' => 'required|numeric',
            ],[
                'productox.required' => 'El campo Producto es obligatorio',
                'productox.string' => 'El campo Producto recibe solo cadena de texto',
                'productox.max' => 'El campo Producto debe contener maximo 255 caracteres',
                'codigox.required' => 'El campo Codigo es obligatorio',
                'codigox.string' => 'El campo Codigo recibe solo cadena de texto',
                'codigox.max' => 'El campo Codigo debe contener maximo 255 caracteres',
                'descripcionx.required' => 'El campo Descripcion es obligatorio',
                'descripcionx.string' => 'El campo Descripcion recibe solo cadena de texto',
                'descripcionx.max' => 'El campo Descripcion debe contener maximo 255  caracteres',
                'categoria_idx.required' => 'El campo Categoria es obligatorio',
                'categoria_idx.numeric' => 'El campo Categoria recibe solo numeros enteros',
                'precio_con_ivax.required' => 'El campo Precio con iva es obligatorio',
                'precio_con_ivax.numeric' => 'El campo Precio con iva recibe solo numeros enteros',
                'precio_sin_ivax.required' => 'El campo Precio sin iva es obligatorio',
                'precio_sin_ivax.numeric' => 'El campo Precio sin iva recibe solo numeros enteros',
            ]);

            $data = ModelsProductos::find($this->idx);
            $data->producto = $this->productox;
            $data->codigo = $this->codigox;
            $data->descripcion = $this->descripcionx;
            $data->categoria_id = $this->categoria_idx;
            $data->precio_con_iva = $this->precio_con_ivax;
            $data->precio_sin_iva = $this->precio_sin_ivax;
            if($this->imagenx){
                $radomName = Str::random(10);
                $manager = new ImageManager(new Driver());
                $image = $manager->read($this->imagenx)->toWebp(60)->save('fotos/'.$radomName.'.webp');
                if($data->imagen){
                    unlink($data->imagen);
                }
                $data->imagen = 'fotos/'.$radomName.'.webp';

                $this->imagenx = null;
            }

            $data->save();
            $msj = ['!Actualizado!', 'Se actualizo el Prodcuto', 'success'];
            $this->emit('ok', $msj);

        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e->getMessage(), 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function delete($post)
    {
        try { 

            ModelsProductos::where('id',$post)->first()->delete();

         } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e->getMessage(), 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function export(){
        return Excel::download(new ProductosExports($this->search), 'productos.xlsx');
    }

    public function import(){
        Excel::import(new ProductosImport, $this->file);
    }
    
    public function exportPdf()
    {
        $productos = [];

        if ($this->search == "") {
            $dataproductos = ModelsProductos::orderBy('id', 'DESC')->get();

            foreach($dataproductos as $producto){
                $categoria_id =  Categoria::where('id', $producto->categoria_id)->get();

                $list = array(
                    'producto' =>$producto->producto,
                    'imagen' =>$producto->imagen,
                    'codigo' =>$producto->codigo,
                    'descripcion' =>$producto->descripcion,
                    'categoria_id' =>$categoria_id[0]['nombre_categoria'],
                    'precio_con_iva' =>$producto->precio_con_iva,
                    'precio_sin_iva' =>$producto->precio_sin_iva,
                );
                array_push($productos, $list);
            }

            $pdf = Pdf::loadView('pdf/pdf', compact('productos'));
    
            return response()->streamDownload(
                fn() => print($pdf->output()),
                'productos.pdf'
            );
        } else {
            $dataproductos =  ModelsProductos::orWhere('producto', 'LIKE', '%'.$this->search.'%')
                ->orWhere('codigo', 'LIKE', '%'.$this->search.'%')
                ->orWhere('descripcion', 'LIKE', '%'.$this->search.'%')
                ->orWhere('precio_con_iva', 'LIKE', '%'.$this->search.'%')
                ->orWhere('precio_sin_iva', 'LIKE', '%'.$this->search.'%')
                ->get();


                foreach($dataproductos as $producto){
                    $categoria_id =  Categoria::where('id', $producto->categoria_id)->get();
    
                    $list = array(
                        'producto' =>$producto->producto,
                        'imagen' =>$producto->imagen,
                        'codigo' =>$producto->codigo,
                        'descripcion' =>$producto->descripcion,
                        'categoria_id' =>$categoria_id[0]['nombre_categoria'],
                        'precio_con_iva' =>$producto->precio_con_iva,
                        'precio_sin_iva' =>$producto->precio_sin_iva,
                    );
                    array_push($productos, $list);
                }


                $pdf = Pdf::loadView('pdf/pdf', compact('productos'));

                return response()->streamDownload(
                    fn() => print($pdf->output()),
                    'productos.pdf'
                );
        }
    }

    public function descargarPlantilla()
    {
        return Excel::download(new PlantillaProductosExport, 'plantilla_productos.xlsx');
    }

    public function render()
    {
        $this->category = Categoria::all();
        $this->categoryy = Categoria::class;
        return view('livewire.productos')->extends('layouts.plantilla_back')->section('contenido');
    }
}
