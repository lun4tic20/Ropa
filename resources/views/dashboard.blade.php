<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css">
    </head>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
                                    <th>Proveedor</th>
                                    <th>Cantidad</th>
                                    <th>Carrito</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($producto as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->nombre }}</td>
                                    <td>{{ $product->descripcion }}</td>
                                    <td>{{ $product->cantidad }}</td>
                                    <td>{{ $product->precio }}€</td>
                                    <td>{{ $product->proveedor->nombre }}</td>
                                    <form action="{{ route('cart.index') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <td><input type="number" size="3" name="cantidad" id="{{ $product->id }}" value="0"></td>
                                        <td><button type="submit" class="btn btn-primary">Añadir al carrito</button></td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
