<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;


class Perfil extends Component
{
    use WithFileUploads;
    public $idu, $idperfil,$passwordy,$fotox = null, $perfil;
    public $idy,$idx, $name, $email, $rol;
    protected $listeners = ['render', 'delete'];


    public function mount(){
        $this->perfil = User::where('id', Auth()->user()->id)->first();

        $this->idx = $this->perfil->id;
        $this->name = $this->perfil->name;
        $this->email = $this->perfil->email;
        $this->rol = $this->perfil->rol;
    }

    public function actualizar()
    {
        try {
            $this->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|string|email',
                'fotox' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'rol' => 'required|string',
            ],[
                'name.required' => 'El campo Nombre Completo es obligatorio',
                'name.string' => 'El campo Nombre Completo recibe solo cadena de texto',
                'name.max' => 'El campo Nombre Completo debe contener maximo 100 caracteres',
                'email.required' => 'El campo Email es obligatorio',
                'email.string' => 'El campo Email recibe solo cadena de texto',
                'email.email' => 'El campo Email le falta el @',
                'fotox.image' => 'El archivo debe ser una imagen válida (JPG, PNG, JPEG, WebP).',
                'fotox.mimes' => 'Solo se permiten imágenes con las extensiones JPG, PNG, JPEG o WebP.',
                'fotox.max' => 'La imagen no debe superar los 2MB de tamaño.',
                'rol.required' => 'El campo Rol es obligatorio',
                'rol.string' => 'El campo Rol recibe solo cadena de texto',
            ]);


            $cliente = User::find($this->idx);
            $cliente->name = $this->name;
            $cliente->email = $this->email;
            $cliente->rol = $this->rol;


            if($this->fotox){
                $radomName = Str::random(10);
                $manager = new ImageManager(new Driver());
                $image = $manager->read($this->fotox)->toWebp(60)->save('img_perfil/'.$radomName.'.webp');
                if($cliente->foto){
                    unlink($cliente->foto);
                }
                $cliente->foto = 'img_perfil/'.$radomName.'.webp';
            }

            $cliente->save();
            $this->reset(['fotox']);
            $msj = ['!Actualizado!', 'Se actualizo el Perfil', 'success'];
            $this->emit('ok', $msj);
        } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function cargacredenciales($obj)
    {
        $this->idy = $obj;
    }

    public function actuacredenciales()
    {
        $data = User::find($this->idy);
        if($this->passwordy != null){
            $data->password = Hash::make($this->passwordy);
            $data->save();
        }
        $this->reset();
        $msj = ['!Actualizado!', 'Se actualizaron las credenciales', 'success'];
        $this->emit('ok', $msj);
        return redirect()->route('perfil');
    }

    public function delete($post)
    {
        $data = User::find($post);
        $data->password = "DASDASDASDADASDASDADAFACWFVDFGXVDVXV######********@@@@";
        $data->save();
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.perfil')->extends('layouts.plantilla_back')->section('contenido');
    }
}
