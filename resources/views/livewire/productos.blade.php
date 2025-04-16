<div>
    @section('title', 'Prodcutos')
    <div class="container-fluid">
        <div class="row text-center mb-3">
            <div class="col-md-12 d-flex justify-content-between align-items-center">
                <h1 class="display-4">Productos</h1>
                <button class="btn btn-primary rounded-circle " data-bs-toggle="modal"
                    data-bs-target="#modalCrearSlug">+</button>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-12 d-flex justify-content-center gap-2">
                <input type="file" wire:model='file' class="form-control w-auto">
                <button class="btn btn-success d-flex align-items-center" wire:click='import'>
                    <i class="fas fa-file-import me-2"></i> Importar
                </button>
                <button class="btn btn-info d-flex align-items-center" wire:click='export'>
                    <i class="fas fa-file-export me-2"></i> Exportar
                </button>
                <button class="btn btn-secondary d-flex align-items-center" wire:click="descargarPlantilla" wire:loading.attr="disabled" wire:target="descargarPlantilla">
                    <span wire:loading.remove wire:target="descargarPlantilla">
                        <i class="fas fa-file-excel me-2"></i> Plantilla Excel
                    </span>
                    <span wire:loading wire:target="descargarPlantilla">
                        <i class="fas fa-spinner fa-spin me-2"></i> Cargando...
                    </span>
                </button>
                <button class="btn btn-danger d-flex align-items-center" wire:click="exportPdf" wire:loading.attr="disabled" wire:target="exportPdf">
                    <span wire:loading.remove wire:target="exportPdf">
                        <i class="fas fa-file-pdf me-2"></i> PDF
                    </span>
                    <span wire:loading wire:target="exportPdf">
                        <i class="fas fa-spinner fa-spin me-2"></i> Cargando...
                    </span>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-sm">
                        <thead>
                            <th colspan="10">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control"
                                    placeholder="Buscar..."
                                    wire:model="search">
                                </div>
                            </th>
                            <tr>
                                <th class="text-center">producto</th>
                                <th class="text-center">imagen</th>
                                <th class="text-center">codigo</th>
                                <th class="text-center">descripcion</th>
                                <th class="text-center">categoria</th>
                                <th class="text-center">precio_con_iva</th>
                                <th class="text-center">precio_sin_iva</th>
                                <th class="text-center">Fecha Registro</th>
                                <th class="text-center">Fecha Actualizacion</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($this->productos as $cat)
                                <tr>
                                    <td class="text-center">{{ $cat->producto }}</td>
                                    @if ($cat->imagen != null && $cat->imagen != '')
                                        <td class="text-center">
                                            <img id="picture" src="{{ asset($cat->imagen) }}" alt="avatar" class="img-fluid" width="150px" height="150px">
                                        </td>
                                    @else
                                        <td class="text-center">
                                            <img id="picture" src="{{ asset('img/perfil_blanco.png') }}" alt="avatar" class="rounded-circle img-fluid" width="100px" height="100px">
                                        </td>
                                    @endif
                                    <td class="text-center">{{ $cat->codigo }}</td>
                                    @if ($cat->descripcion != null)
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary" wire:click="cargardescripcion({{$cat}})" data-bs-toggle="modal" data-bs-target="#extract"><i class="fab fa-sistrix"></i></button>
                                        </td>
                                    @else
                                        <td class="text-center"></td>
                                    @endif
                                    <td class="text-center">{{ $categoryy::find($cat->categoria_id)->nombre_categoria}}</td>
                                    <td class="text-center">${{ number_format($cat->precio_con_iva) }}</td>
                                    <td class="text-center">${{ number_format($cat->precio_sin_iva) }}</td>
                                    <td class="text-center">{{ $cat->created_at }}</td>
                                    <td class="text-center">{{ $cat->updated_at }}</td>
                                    <td class="d-flex justify-content-center">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-sm btn-warning"
                                                wire:click="datacliente({{ $cat }})" data-bs-toggle="modal"
                                                data-bs-target="#Modaleditar"><i class="fas fa-user-edit"></i></button>
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                wire:click="$emit('deletePost',{{$cat->id}})"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">No hay registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $this->productos->links() }}
                </div>
            </div>
        </div>

        {{-- Modal crear post --}}
        <div class="modal fade" id="modalCrearSlug" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Prodcuto</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="@error('producto') text-danger @enderror">Nombre Productos</label>
                                        <input type="text" class="form-control @error('producto') text-danger @enderror" wire:model="producto">
                                        <i class="text-danger">
                                            @error('producto') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label class="@error('codigo') text-danger @enderror">Codigo</label>
                                        <input type="text" class="form-control @error('codigo') text-danger @enderror" wire:model="codigo">
                                        <i class="text-danger">
                                            @error('codigo') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label class="@error('descripcion') text-danger @enderror">Descripcion</label>
                                        <textarea class="form-control @error('descripcion') text-danger @enderror" wire:model="descripcion" rows="4"></textarea>
                                            <i class="text-danger">
                                                @error('descripcion') {{ $message }} @enderror
                                            </i>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="@error('categoria_id') text-danger @enderror">Categoria</label>
                                        <select class="form-select @error('categoria_id') text-danger @enderror" wire:model="categoria_id">
                                            <option value="">Seleccione una opción...</option>
                                            @foreach ($category as $cate)
                                                <option value="{{$cate->id}}">{{ $cate->nombre_categoria }}</option>
                                            @endforeach
                                        </select>
                                        <i class="text-danger">
                                            @error('categoria_id') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label class="@error('precio_con_iva') text-danger @enderror">precio con iva</label>
                                        <input type="number" class="form-control @error('precio_con_iva') text-danger @enderror" wire:model="precio_con_iva">
                                        <i class="text-danger">
                                            @error('precio_con_iva') {{ $message }} @enderror
                                        </i>
                                    </div>
                                    <div class="form-group">
                                        <label class="@error('precio_sin_iva') text-danger @enderror">precio sin iva</label>
                                        <input type="number" class="form-control @error('precio_sin_iva') text-danger @enderror" wire:model="precio_sin_iva">
                                        <i class="text-danger">
                                            @error('precio_sin_iva') {{ $message }} @enderror
                                        </i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" wire:click='crear'>Registrar Prodcuto</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Fin modal crear post --}}

        {{--  modal Resumen   --}}
        <div class="modal fade" id="extract" tabindex="-1" wire:ignore.self>
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fs-5">Resumen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p style="text-align: justify" >{{$descripcion_producto}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div> 
        {{--  modal Resumen   --}}

        {{--  editar   --}}
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="modal fade" id="Modaleditar" tabindex="-1" wire:ignore.self>
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Editar Prodcutos</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="@error('productox') text-danger @enderror">Nombre Productos</label>
                                                    <input type="text" class="form-control @error('productox') text-danger @enderror" wire:model="productox">
                                                    <i class="text-danger">
                                                        @error('productox') {{ $message }} @enderror
                                                    </i>
                                                </div>
                                                <div class="form-group">
                                                    <label class="@error('codigox') text-danger @enderror">Codigo</label>
                                                    <input type="text" class="form-control @error('codigox') text-danger @enderror" wire:model="codigox">
                                                    <i class="text-danger">
                                                        @error('codigox') {{ $message }} @enderror
                                                    </i>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="@error('descripcionx') text-danger @enderror">Descripcion</label>
                                                    <textarea class="form-control @error('descripcionx') text-danger @enderror" wire:model="descripcionx" rows="4"></textarea>
                                                        <i class="text-danger">
                                                            @error('descripcionx') {{ $message }} @enderror
                                                        </i>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="@error('categoria_idx') text-danger @enderror">Categoria</label>
                                                    <select class="form-select @error('categoria_idx') text-danger @enderror" wire:model="categoria_idx">
                                                        <option value="">Seleccione una opción...</option>
                                                        @foreach ($category as $cate)
                                                            <option value="{{$cate->id}}">{{ $cate->nombre_categoria }}</option>
                                                        @endforeach
                                                    </select>
                                                    <i class="text-danger">
                                                        @error('categoria_idx') {{ $message }} @enderror
                                                    </i>
                                                </div>
                                                <div class="form-group">
                                                    <label class="@error('precio_con_ivax') text-danger @enderror">precio con iva</label>
                                                    <input type="number" class="form-control @error('precio_con_ivax') text-danger @enderror" wire:model="precio_con_ivax">
                                                    <i class="text-danger">
                                                        @error('precio_con_ivax') {{ $message }} @enderror
                                                    </i>
                                                </div>
                                                <div class="form-group">
                                                    <label class="@error('precio_sin_ivax') text-danger @enderror">precio sin iva</label>
                                                    <input type="number" class="form-control @error('precio_sin_ivax') text-danger @enderror" wire:model="precio_sin_ivax">
                                                    <i class="text-danger">
                                                        @error('precio_sin_ivax') {{ $message }} @enderror
                                                    </i>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label>Imagen</label>
                                                    <input type="file" id="file" class="form-control" accept="image/*" wire:model="imagenx" onchange="cambiarImagen(event)">
                                                </div>
                                            </div>
                                            @if ($imagenx != null)
                                                <div class="my-4">
                                                    <img id="picture" src="{{ $imagenx->temporaryUrl() }}" alt="avatar" class="img-fluid" width="150px" height="150px">
                                                </div>
                                            @else
                                                <div class="my-4">
                                                    <img id="picture" src="{{ asset('img/perfil_blanco.png') }}" alt="avatar" class="rounded-circle img-fluid" width="100px" height="100px">
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary" wire:click="actua">Editar
                                        Prodcutos</button>
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
                    livewire.emitTo('productos', 'delete', postId);

                    Swal.fire({
                    title: "!Eliminado!",
                    text: "Se elimino la Categoria",
                    icon: "success"
                    });
                }
            });
        });
    </script>
@endpush