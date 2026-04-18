<x-layouts.admin>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow">
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

        <div class="p-6 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">SKU</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $product->sku }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Precio</h3>
                    <p class="mt-1 text-sm text-gray-900">${{ number_format($product->price, 2) }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Stock</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $product->stock }} unidades</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Estado</h3>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $product->is_active ? 'Activo' : 'Inactivo' }}
                    </span>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Categoría</h3>
                    <a href="{{ route('admin.categories.show', $product->category) }}" class="mt-1 text-sm text-blue-600 hover:text-blue-500">
                        {{ $product->category->name }}
                    </a>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Proveedor</h3>
                    <a href="{{ route('admin.suppliers.show', $product->supplier) }}" class="mt-1 text-sm text-blue-600 hover:text-blue-500">
                        {{ $product->supplier->name }}
                    </a>
                </div>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500">Descripción</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $product->description ?? 'Sin descripción' }}</p>
            </div>

            <div>
                <h3 class="text-sm font-medium text-gray-500">Sello de Metal</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $product->metal_hallmark ?? 'No especificado' }}</p>
            </div>

            @if($product->image_url)
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Imagen</h3>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="mt-2 max-w-xs rounded-lg shadow">
                </div>
            @endif
        </div>
    </div>
</x-layouts.admin>