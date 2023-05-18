<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Historial de Compras') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Descripción</th>
                                <th class="px-4 py-2">Precio</th>
                                <th class="px-4 py-2">Cantidad</th>
                                <th class="px-4 py-2">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ventas as $venta)
                            <tr>
                                <td class="border px-4 py-2">{{ $venta->product->id }}</td>
                                <td class="border px-4 py-2">{{ $venta->product->name }}</td>
                                <td class="border px-4 py-2">{{ $venta->product->description }}</td>
                                <td class="border px-4 py-2">{{ $venta->product->price }}</td>
                                <td class="border px-4 py-2">{{ $venta->item->cantidad }}</td>
                                <td class="border px-4 py-2">{{ $venta->item->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
