{{--  @php 
  $productos = App\Models\Productos::orderBy('id', 'DESC')->take(7)->get();
@endphp  --}}

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <style>
        .logo {
            position: absolute;
            top: 10px;
            left: 10px;
            width: 80px;
            height: auto;
        }
        
        .header {
            margin-top: 10px;
            text-align: center;
            font-size: 1em;
        }
        table{
            width: 100%;
        }

        td{
            width: 50%;
        }
        .product-card {
            border: 1px solid #333;
            border-radius: 10px;
            padding: 15px;
            height: auto;
        }
        
        .product-image {
            width: 100%;
            margin-bottom: 10px;
        }
        
        .product-title {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .product-categoria {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
            flex-grow: 1;
        }

        .product-description {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
            flex-grow: 1;
        }
        
        .product-price {
            font-weight: bold;
            font-size: 20px;
            color: #e63946;
        }
        kbd{
            padding: 3px;
            background-color: black;
            color: white;
        }
    </style>
</head>
<body>

    <img src="{{ public_path('img/logo_negro.png') }}" alt="Logo" class="logo">
    
    <div class="header">
      <h1>Productos</h1>
    </div>
    <table>
        @foreach ($productos as $k => $producto)
            @if($loop->odd)
                <tr>
            @endif
                <td> 
                    <div class="product-card">
                        <div class="product-image">
                            <center>
                            {{--  <img src="{{ ($producto->imagen) ? asset($producto->imagen) : asset('img/perfil_blanco.png') }}" alt="Producto 1" height="150px">  --}}
                            {{--  <img src="{{ ($producto->imagen) ? public_path($producto->imagen) : public_path('img/perfil_blanco.png') }}" alt="Producto 1" height="150px">  --}}
                            <img src="{{ ($producto['imagen']) ? public_path($producto['imagen']) : public_path('img/perfil_blanco.png') }}" alt="Producto 1" height="150px">
                            </center>
                        </div>
                        <div class="product-title">
                            <kbd>{{ $producto['codigo'] }}</kbd> {{ $producto['producto'] }}
                        </div>
                        <div class="product-categoria">
                            <b>Categoria:</b> {{ $producto['categoria_id'] }}
                        </div>
                        <div class="product-description">
                            <b>Descripcion:</b> {{ $producto['descripcion'] }}
                        </div>
                        <div class="product-price">
                             ${{ $producto['precio_sin_iva'] }} <kbd>${{ $producto['precio_con_iva'] }}</kbd>
                        </div>
                    </div>
                </td>
            @if($loop->even)
                </tr>
            @endif
        @endforeach
    </table>
</body>
</html>


