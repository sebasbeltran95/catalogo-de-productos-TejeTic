<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class Usuarios extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name, $email, $password, $rol;
    public $idx, $namex, $emailx, $passwordx, $rolx;
    public $search  = "";


    protected $listeners = ['render', 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getUsuariosProperty()
    {
        if($this->search == ""){
            return User::orderBy('id','DESC')->paginate(5);
        } else {
            return User::
            orWhere('name', 'LIKE', '%'.$this->search.'%')
            ->orWhere('email', 'LIKE', '%'.$this->search.'%')
            ->paginate(3);
        }
    }

    public function crear()
    {
        try {  

            $this->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|string|email',
                'password' => 'required|string|min:6',
                'rol' => 'required|string',
            ],[
                'name.required' => 'El campo Nombre Completo es obligatorio',
                'name.string' => 'El campo Nombre Completo recibe solo cadena de texto',
                'name.max' => 'El campo Nombre Completo debe contener maximo 100 caracteres',
                'email.required' => 'El campo Email es obligatorio',
                'email.string' => 'El campo Email recibe solo cadena de texto',
                'email.email' => 'El campo Email le falta el @',
                'password.required' => 'El campo Password es obligatorio',
                'password.string' => 'El campo Password recibe solo cadena de texto',
                'rol.required' => 'El campo Rol es obligatorio',
                'rol.string' => 'El campo Rol recibe solo cadena de texto',
            ]);

            $user = new User();
            $user->name =  $this->name;
            $user->email =  $this->email;
            $user->password = Hash::make($this->password);
            $user->rol = $this->rol;
            $user->save();
            $this->reset();
            $msj = ['!Registrado!', 'Se registro el Usuario', 'success'];
            $this->emit('ok', $msj);

          } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function cargausuario($obj)
    {
        $this->idx =  $obj['id'];
        $this->namex =  $obj['name'];
        $this->emailx =  $obj['email'];
        $this->rolx = $obj['rol'];
    }

    public function cargacredenciales($obj)
    {
        $this->idx = $obj;
    }

    public function actuacredenciales()
    {
        try {  

            $data = User::find($this->idx);
            if($this->passwordx != null){
                $data->password = Hash::make($this->passwordx);
                $data->save();
            }
            $this->reset();
            $msj = ['!Actualizado!', 'Se actualizaron las credenciales', 'success'];
            $this->emit('ok', $msj);

          } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function actua()
    {
        try { 

            $this->validate([
                'namex' => 'required|string|max:100',
                'emailx' => 'required|string|email',
                'rolx' => 'required|string',
            ],[
                'namex.required' => 'El campo Nombre Completo es obligatorio',
                'namex.string' => 'El campo Nombre Completo recibe solo cadena de texto',
                'namex.max' => 'El campo Nombre Completo debe contener maximo 100 caracteres',
                'emailx.required' => 'El campo Email es obligatorio',
                'emailx.string' => 'El campo Email recibe solo cadena de texto',
                'emailx.email' => 'El campo Email le falta el @',
                'rolx.required' => 'El campo Rol es obligatorio',
                'rolx.string' => 'El campo Rol recibe solo cadena de texto',
            ]);

            $data = User::find($this->idx);
            $data->name = $this->namex;
            $data->email = $this->emailx;
            $data->rol = $this->rolx;
    
            $data->save();
            $msj = ['!Actualizado!', 'Se actualizo el Usuario', 'success'];
            $this->emit('ok', $msj);

          } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }

        public function delete($post)
    {
        try {  

            User::where('id',$post)->first()->delete();

          } catch (QueryException $e) {

            $msj = ['!ERROR!', 'se ha presentado un error: ', $e, 'danger'];
            $this->emit('ok', $msj);

        }
    }

    public function render()
    {
        return view('livewire.usuarios')->extends('layouts.plantilla_back')->section('contenido');
    }
}
