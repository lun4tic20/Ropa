<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proveedores') }}
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
                                    <th>Dirección</th>
                                    <th>Teléfono</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proveedores as $proveedor)
                                <tr>
                                    <td>{{ $proveedor['id'] }}</td>
                                    <td>{{ $proveedor['nombre'] }}</td>
                                    <td>{{ $proveedor['direccion'] }}</td>
                                    <td>{{ $proveedor['telefono'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editarProveedor{{ $proveedor['id'] }}">Editar</button>
                                        <!-- Modal para editar proveedor -->
                                        <div class="modal fade" id="editarProveedor{{ $proveedor['id'] }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Editar proveedor {{ $proveedor['id'] }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('proveedor.update', $proveedor['id']) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="nombre" class="form-label">Nombre</label>
                                                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $proveedor['nombre'] }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="direccion" class="form-label">Dirección</label>
                                                                <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $proveedor['direccion'] }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="telefono" class="form-label">Teléfono</label>
                                                                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $proveedor['telefono'] }}" required>
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
                                    <td>
                                        <form action="{{ route('proveedor.destroy', $proveedor['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmarEliminar{{ $proveedor['id'] }}">Eliminar</button>
                                            <!-- Modal de confirmación -->
                                            <div class="modal fade" id="confirmarEliminar{{ $proveedor['id'] }}" tabindex="-1" aria-labelledby="confirmarEliminarModalLabel{{ $proveedor['id'] }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmarEliminarModalLabel{{ $proveedor['id'] }}">Confirmar eliminación</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>¿Estás seguro de que deseas eliminar este proveedor?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                        </table>
                        <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#agregarProveedorModal">Agregar proveedor</button>

                        <!-- Modal -->
                        <div class="modal fade" id="agregarProveedorModal" tabindex="-1" aria-labelledby="agregarProveedorModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="agregarProveedorModalLabel">Agregar Proveedor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route("proveedor.store") }}" method="POST">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="direccion" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="direccion" name="direccion" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="telefono" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefono" name="telefono" required>
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
