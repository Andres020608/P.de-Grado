<x-layouts.admin>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $category->name }}</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.categories.edit', $category) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Editar
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                        Volver
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6 space-y-4">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Descripción</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $category->description ?? 'Sin descripción' }}</p>
            </div>

            @if($category->visual_reference)
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Referencia Visual</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $category->visual_reference }}</p>
                </div>
            @endif

            @if($category->material_focus_tags)
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Etiquetas de Material</h3>
                    <div class="flex flex-wrap gap-2 mt-1">
                        @foreach(explode(',', $category->material_focus_tags) as $tag)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ trim($tag) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="border-t pt-4">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Productos</h3>
                @if($category->products->isEmpty())
                    <p class="text-sm text-gray-500">No hay productos en esta categoría.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($category->products as $product)
                            <li class="text-sm text-gray-900">
                                <a href="{{ route('admin.products.show', $product) }}" class="text-blue-600 hover:text-blue-500">
                                    {{ $product->name }} ({{ $product->sku }})
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>