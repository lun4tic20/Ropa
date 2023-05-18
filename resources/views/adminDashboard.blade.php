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
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                    <th>Cantidad</th>
                                    <th>Carrito</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($productos as $product)
                                <tr>
                                    <td>{{ $product['id'] }}</td>
                                    <td>{{ $product['nombre'] }}</td>
                                    <td>{{ $product['descripcion'] }}</td>
                                    <td>{{ $product['cantidad'] }}</td>
                                    <td>{{ $product['precio'] }}€</td>
                                    <td>{{ $product['proveedor_id']}}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarProducto{{ $product['id'] }}">Editar</button>
                                        <!-- Modal para editar producto -->
                                        <div class="modal fade" id="editarProducto{{ $product['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar producto {{ $product['id'] }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('producto.update', $product['id']) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="nombre" class="form-label">Nombre</label>
                                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $product['nombre'] }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="descripcion" class="form-label">Descripción</label>
                                                                <textarea class="form-control" id="descripcion" name="descripcion" required>{{ $product['descripcion'] }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="cantidad" class="form-label">Stock</label>
                                                                <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $product['cantidad'] }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="precio" class="form-label">Precio</label>
                                                                <input type="number" class="form-control" id="precio" name="precio" value="{{ $product['precio'] }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="proveedor_id" class="form-label">Proveedor ID</label>
                                                                <input type="number" class="form-control" id="proveedor_id" name="proveedor_id" value="{{ $product['proveedor_id'] }}" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><form action="{{ route('producto.destroy', $product['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmarEliminar{{ $product['id'] }}">Eliminar</button>
                                        <!-- Modal de confirmación -->
                                        <div class="modal fade" id="confirmarEliminar{{ $product['id'] }}" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel{{ $product['id'] }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmarEliminarModalLabel{{ $product['id'] }}">Confirmar eliminación</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>¿Estás seguro de que deseas eliminar este producto?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form></td>
                                    <form action="{{ route('cart.store')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                                        <td><input type="number" size="3" name="cantidad" id="{{ $product['id'] }}" value="0"></td>
                                        <td><button type="submit" class="btn btn-primary">Añadir al carrito</button></td>
                                    </form>
                                </tr>
                                @endforeach
                                </tbody>
                        </table>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agregarProductoModal">Agregar producto</button>

                        <!-- Modal -->
                        <div class="modal fade" id="agregarProductoModal" tabindex="-1" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Producto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route("producto.store") }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="descripcion" class="form-label">Descripción</label>
                                        <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="precio" class="form-label">Precio</label>
                                        <input type="number" class="form-control" id="precio" name="precio" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cantidad" class="form-label">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="proveedor_id" class="form-label">Proveedor ID</label>
                                        <input type="number" class="form-control" id="proveedor_id" name="proveedor_id" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
</x-app-layout>
