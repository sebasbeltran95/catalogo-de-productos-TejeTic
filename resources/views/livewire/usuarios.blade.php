<div>
   @section('title', 'Usuarios')
   <div class="container-fluid">
       <div class="row text-center mb-3">
           <div class="col-md-12 d-flex justify-content-between align-items-center">
               <h1 class="display-4">Usuarios</h1>
               <button class="btn btn-primary rounded-circle " data-bs-toggle="modal"
                   data-bs-target="#modalCrearUsuarios">+</button>
           </div>
       </div>
       <div class="row">
           <div class="col-md-12">
               <div class="table-responsive">
                   <table class="table table-hover table-bordered table-sm">
                       <thead>
                           <th colspan="4">
                               <div class="input-group input-group-sm">
                                   <input type="text" class="form-control"
                                   placeholder="Buscar..."
                                   wire:model="search">
                               </div>
                           </th>
                           <tr>
                               <th class="text-center">Nombre Completo</th>
                               <th class="text-center">Correo</th>
                               <th class="text-center">Rol</th>
                               <th class="text-center">Acciones</th>
                           </tr>
                       </thead>
                       <tbody>
                           @forelse ($this->usuarios as $usu)
                               <tr>
                                   <td class="text-center">{{ $usu->name }}</td>
                                   <td class="text-center">{{ $usu->email }}</td>
                                   @if ($usu->rol == "Admon")
                                       <td class="text-center">Administrador</td>
                                   @else
                                       <td class="text-center">Cliente</td>
                                   @endif
                                   <td class="d-flex justify-content-center">
                                       <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                           <button type="button" class="btn btn-sm btn-success"
                                               wire:click="cargacredenciales({{ $usu->id }})"
                                               data-bs-toggle="modal" data-bs-target="#Modalcontraseña"><i
                                                   class="fas fa-lock"></i></button>
                                           <button type="button" class="btn btn-sm btn-warning"
                                               wire:click="cargausuario({{ $usu }})" data-bs-toggle="modal"
                                               data-bs-target="#Modaleditar"><i class="fas fa-user-edit"></i></button>
                                           <button type="submit" class="btn btn-sm btn-danger"
                                               wire:click="$emit('deletePost',{{$usu->id}})"><i
                                                   class="fas fa-trash-alt"></i></button>
                                       </div>
                                   </td>
                               </tr>
                           @empty
                               <tr>
                                   <td colspan="4" class="text-center">No hay registros</td>
                               </tr>
                           @endforelse
                       </tbody>
                   </table>
                   {{ $this->usuarios->links() }}
               </div>
           </div>
       </div>
       {{-- Modal crear Servicio --}}
       <div class="modal fade" id="modalCrearUsuarios" tabindex="-1" wire:ignore.self>
           <div class="modal-dialog modal-lg">
               <div class="modal-content">
                   <div class="modal-header">
                       <h4 class="modal-title">Crear Usuarios</h4>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>
                   <div class="modal-body">
                       <div class="container-fluid">
                           <div class="row">
                               <div class="col-md-6">
                                   <div class="form-group">
                                       <label class="@error('name') text-danger @enderror">Nombre Completo</label>
                                       <input type="text" class="form-control @error('name') text-danger @enderror" wire:model="name">
                                       <i class="text-danger">
                                           @error('name') {{ $message }} @enderror
                                       </i>
                                   </div>
                                   <div class="form-group mb-2">
                                       <label class="@error('email') text-danger @enderror">Correo</label>
                                       <input type="email" class="form-control @error('email') text-danger @enderror" wire:model="email">
                                           <i class="text-danger">
                                               @error('email') {{ $message }} @enderror
                                           </i>
                                   </div>
                               </div>
                               <div class="col-md-6">
                                 <div class="form-group mb-2">
                                    <label class="@error('password') text-danger @enderror">Contraseña</label>
                                    <input type="text" class="form-control @error('password') text-danger @enderror" wire:model="password">
                                       <i class="text-danger">
                                          @error('password') {{ $message }} @enderror
                                       </i>
                                 </div>
                                 <div class="form-group mb-2">
                                    <label class="@error('rol') text-danger @enderror">Rol</label>
                                    <select class="form-select @error('rol') text-danger @enderror" wire:model="rol">
                                       <option value="">Seleccione una opción...</option>
                                       <option value="Admon">Administrador</option>
                                       <option value="Client">Cliente</option>
                                    </select>
                                    <i class="text-danger">
                                       @error('rol') {{ $message }} @enderror
                                    </i>
                                 </div>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="modal-footer">
                       <button type="submit" class="btn btn-primary" wire:click='crear'>Registrar Usuarios</button>
                       <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                   </div>
               </div>
           </div>
       </div>
       {{-- Fin modal crear Servicio --}}

       {{--  editar   --}}
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-12">
                   <div class="modal fade" id="Modaleditar" tabindex="-1" wire:ignore.self>
                       <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h4 class="modal-title">Editar Usuario</h4>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               </div>
                               <div class="modal-body">
                                   <div class="container-fluid">
                                       <div class="row">
                                           <div class="col-md-6">
                                               <div class="form-group">
                                                   <label class="@error('namex') text-danger @enderror">Nombre Completo</label>
                                                   <input type="text" class="form-control @error('namex') text-danger @enderror" wire:model="namex">
                                                   <i class="text-danger">
                                                      @error('namex') {{ $message }} @enderror
                                                  </i>
                                               </div>
                                               <div class="form-group mb-2">
                                                   <label class="@error('emailx') text-danger @enderror">Correo</label>
                                                   <input type="email" class="form-control @error('emailx') text-danger @enderror" wire:model="emailx">
                                                   <i class="text-danger">
                                                      @error('emailx') {{ $message }} @enderror
                                                  </i>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                                <div class="form-group mb-2">
                                                   <label class="@error('rolx') text-danger @enderror">Rol</label>
                                                   <select class="form-select @error('rol') text-danger @enderror" wire:model="rolx">
                                                      <option value="">Seleccione una opción...</option>
                                                      <option value="Admon">Administrador</option>
                                                      <option value="Client">Cliente</option>
                                                   </select>
                                                   <i class="text-danger">
                                                      @error('rolx') {{ $message }} @enderror
                                                   </i>
                                                </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="modal-footer">
                                   <button type="submit" class="btn btn-primary" wire:click="actua">Editar
                                       Usuario</button>
                                   <button type="button" class="btn btn-danger"
                                       data-bs-dismiss="modal">Cerrar</button>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       {{--  editar   --}}

       {{--  contraseña   --}}
       <div class="container-fluid">
           <div class="row">
               <div class="col-md-12">
                   <div class="modal fade" id="Modalcontraseña" tabindex="-1" wire:ignore.self>
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h4 class="modal-title">Editar Contraseña</h4>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               </div>
                               <div class="modal-body">
                                   <div class="form-group">
                                       <label for="exampleInputEmail1">Contraseña</label>
                                       <input type="text" class="form-control" wire:model="passwordx">
                                   </div>
                               </div>
                               <div class="modal-footer">
                                   <button type="submit" class="btn btn-primary" wire:click="actuacredenciales({{ $usu->id }})">Editar Contraseña</button>
                                   <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
       {{--  contraseña   --}}

   </div>
</div>
@push('js')
   <script>
       Livewire.on('ok', msj =>{
           Swal.fire(
               msj[0],
               msj[1],
               msj[2],
           )
       });
       livewire.on('deletePost', postId => {
           Swal.fire({
               title: "¿Estas Seguro?",
               text: "¿Desea Eliminar este registro?",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "SI"
           }).then((result) => {
               if (result.isConfirmed) {
                   livewire.emitTo('usuarios', 'delete', postId);

                   Swal.fire({
                   title: "!Eliminado!",
                   text: "Se elimino el Usuario",
                   icon: "success"
                   });
               }
           });
       });
   </script>
@endpush
