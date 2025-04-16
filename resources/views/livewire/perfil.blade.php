<div>
    @section('title', 'Perfil')
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <div class="my-4">
                            @if ($this->perfil->foto != null)
                                <img src="{{ asset($this->perfil->foto) }}" alt="avatar" class="rounded-circle img-fluid"
                                width="200px" height="200px">
                            @else
                                <img src="{{ asset('img/perfil_blanco.png') }}" alt="avatar" class="rounded-circle img-fluid"
                                width="200px" height="200px">
                            @endif
                        </div>
                        <h5 class="my-3">{{ $this->perfil->name }}</h5>
                        {{--  <p class="text-muted mb-4">{{ $this->perfil->direccion }}</p>  --}}
                        <div class="d-flex justify-content-center mb-2">
                            <div class="btn-group w-100" role="group" >
                                <button type="button" class="btn btn-sm btn-success"
                                    wire:click="cargacredenciales({{ $this->perfil->id }})" data-bs-toggle="modal"
                                    data-bs-target="#Modalcontraseña"><i class="fas fa-lock"></i></button>
                                <button type="button" class="btn btn-warning"
                                    data-bs-toggle="modal" data-bs-target="#Modaleditar"><i
                                        class="fas fa-user-edit"></i></button>
                                <button type="submit" class="btn btn-sm btn-danger"
                                    wire:click="$emit('deletePost',{{$this->perfil->id}})"><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush rounded-3 mt-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center px-3 border-bottom">
                                <i class="fab fa-fab fa-whatsapp fa-lg" style="color: #00ea38;"></i>
                                <p class="mb-0 fw-bold">{{ $this->perfil->whatsapp }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h1 class="display-2">Datos Personales</h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><b> Tipo de Documento </b></p>
                            </div>
                            <div class="col-sm-9">
                                {{--  <p class="text-muted mb-0">{{ $this->perfil->tipo_documento }}</p>  --}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><b> No de Documento </b></p>
                            </div>
                            <div class="col-sm-9">
                                {{--  <p class="text-muted mb-0">{{ $this->perfil->no_documento }}</p>  --}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><b> Nombre Completo </b></p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $this->perfil->name }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><b> Correo Electronico </b></p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $this->perfil->email }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><b> Rol </b></p>
                            </div>
                            <div class="col-sm-9">
                                @if ($this->perfil->rol == "Admon")
                                    <p class="text-muted mb-0">Administrador</p>
                                @else
                                    <p class="text-muted mb-0">Cliente</p>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><b> Telefono </b></p>
                            </div>
                            <div class="col-sm-9">
                                {{--  <p class="text-muted mb-0">{{ $this->perfil->telefono }}</p>  --}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0"><b> Direccion </b></p>
                            </div>
                            <div class="col-sm-9">
                                {{--  <p class="text-muted mb-0">{{ $this->perfil->direccion }}</p>  --}}
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        {{--  editar perfil  --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="Modaleditar" tabindex="-1" wire:ignore>
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title fs-5">Editar Perfil</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="@error('email') text-danger @enderror">Email</label>
                                                    <input type="text" class="form-control  @error('email') text-danger @enderror" wire:model="email" placeholder="Email personal o corporativo">
                                                    <i class="text-danger">
                                                        @error('email') {{ $message }} @enderror
                                                     </i>
                                                </div>
                                                <div class="form-group">
                                                    <label class="@error('name') text-danger @enderror">Nombre Completo</label>
                                                    <input type="text" class="form-control @error('name') text-danger @enderror" wire:model="name" placeholder="Nombre completo">
                                                    <i class="text-danger">
                                                        @error('name') {{ $message }} @enderror
                                                     </i>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
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
                                                <div class="form-group mb-2">
                                                    <label class="@error('fotox') text-danger @enderror">Foto</label>
                                                    <input type="file" id="file" class="form-control @error('fotox') text-danger @enderror" accept="image/*" wire:model="fotox" onchange="cambiarImagen(event)">
                                                    <i class="text-danger">
                                                        @error('fotox') {{ $message }} @enderror
                                                     </i>
                                                </div>

                                                @if ($this->perfil->foto != null)
                                                    <div class="my-4">
                                                        <img id="picture" src="{{ asset($this->perfil->foto) }}" alt="avatar" class="rounded-circle img-fluid" width="150px" height="150px">
                                                    </div>
                                                @else
                                                    <div class="my-4">
                                                        <img id="picture" src="{{ asset('img/perfil_blanco.png') }}" alt="avatar" class="rounded-circle img-fluid" width="100px" height="100px">
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" wire:click="actualizar">Editar
                                        Perfil</button>
                                    <button type="button" class="btn btn-danger" id="cerrar" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--  editar perfil   --}}

        {{--  contraseña   --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="Modalcontraseña" tabindex="-1" wire:ignore.self>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar Contraseña</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label >Contraseña</label>
                                        <input type="text" class="form-control" wire:model="passwordy">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary"
                                        wire:click="actuacredenciales({{ $this->perfil->id }})">Editar
                                        Contraseña</button>
                                    <button type="button" class="btn btn-danger"
                                        data-bs-dismiss="modal">Cerrar</button>
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
            document.getElementById('cerrar').click();
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
                    livewire.emitTo('perfil', 'delete', postId);

                    Swal.fire({
                    title: "!Eliminado!",
                    text: "Se elimino el Usuario",
                    icon: "success"
                    });
                }
            });
        });

        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload= (event)=>{
                document.getElementById("picture").setAttribute('src', event.target.result)
            };
            reader.readAsDataURL(file);
        };
    </script>
@endpush
