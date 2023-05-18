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


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <td>Descripción</td>
                        <td>Proveedor</td>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                        <th>Cantidad</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($producto as $item)
                        <tr>
                            <td>{{ $item['id'] }}</td>
                            <td>{{ $item['nombre'] }}</td>
                            <td>{{ $item['descripcion'] }}</td>
                            <td>{{ $item['proveedor_id'] }}</td>
                            <td>{{ $item['cantidad'] }}</td>
                            <td>{{ $item['precio'] }}€</td>
                            <td>€</td>
                            <td>
                                <form action="{{ route('cart.update', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="cantidad" value="" size="3">
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('cart.destroy', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <a href="/dashboard" class="btn btn-secondary">Seguir comprando</a>
                </div>
                <div class="col-md-6 text-end">
                    <h4>Total: €</h4>
                    <a class="btn btn-primary" onclick="CompraRealizada()">Comprar</a>
                </div>
            </div>
        </div>
    </body>
    <script>

    </script>
</x-app-layout>
