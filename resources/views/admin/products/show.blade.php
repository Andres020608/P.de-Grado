<x-layouts.admin>
    <div class="max-w-5xl mx-auto bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $product->name }}</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.products.edit', $product) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Editar
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                        Volver
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Columna Izquierda: Información Completa -->
                <div class="space-y-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">SKU</h3>
                            <p class="mt-1 text-sm text-gray-900 font-mono">{{ $product->sku }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Estado</h3>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Precio</h3>
                            <p class="mt-1 text-lg font-bold text-gray-900">${{ number_format($product->price, 2) }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Stock</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $product->stock }} unidades</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Categoría</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $product->category->name }}</p>
                        </div>
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">Proveedor</h3>
                            <p class="mt-1 text-sm text-gray-900">{{ $product->supplier->name }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="text-sm font-medium text-gray-500">Sello de Metal</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $product->metal_hallmark ?? 'No especificado' }}</p>
                    </div>

                    <div class="border-t border-gray-100 pt-4">
                        <h3 class="text-sm font-medium text-gray-500">Descripción</h3>
                        <p class="mt-1 text-sm text-gray-900 whitespace-pre-line">{{ $product->description ?? 'Sin descripción' }}</p>
                    </div>
                </div>

                <!-- Columna Derecha: Imagen Centrada -->
                <div class="flex flex-col items-center justify-start pt-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-4 w-full text-center">Imagen del Producto</h3>
                    <div class="w-full max-w-[500px] aspect-square overflow-hidden flex items-center justify-center p-3">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover rounded-md">
                        @else
                            <div class="text-center p-4 bg-gray-50 border border-dashed border-gray-300 rounded-lg">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="mt-1 text-sm text-gray-500">Sin imagen disponible</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.admin>