<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Carrito de compras') }}
    </h2>
</x-slot>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Carrito de Compras</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">

            @if ($mensaje)
            <div class="alert alert-info" role="alert">
                {{ $mensaje }}
            </div>
            @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <td>Descripción</td>
                        <td>Proveedor</td>
                        <th>Precio</th>
                        <th>Subtotal</th>
                        <th>Cantidad</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($productos as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['nombre'] }}</td>
                            <td>{{ $item['descripcion'] }}</td>
                            <td>{{ $item['proveedor_id'] }}</td>
                            <td>{{ $item['precio'] }}€</td>
                            <td>{{$item['subtotal']}}€</td>
                            <td>
                                <form action="{{ route('cart.update', ['id' => $item['id']]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" size="3" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td>
                                <form id="delete-form" action="{{ route('cart.destroy', ['id' => $item['id']]) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Eliminar">
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <a href="/dashboard" class="btn btn-secondary">Seguir comprando</a>
                </div>
                <div class="col-md-6 text-end">
                    <h4>Total: {{$total}}€</h4>
                    <a class="btn btn-primary" onclick="CompraRealizada()">Comprar</a>
                </div>
            </div>
        </div>
    </body>
    <script>
        // Obtener la cantidad de productos en el carrito
        function CompraRealizada(){
            var cartCount = {{ count($productos) }};

            // Verificar si el carrito está vacío
            if (cartCount === 0) {
                // Mostrar alerta si el carrito está vacío
                alert("El carrito está vacío");
            } else {
                // Mostrar alerta si el carrito tiene productos
                alert("¡Compra realizada con éxito!");
            }
        }

    </script>
</x-app-layout>
