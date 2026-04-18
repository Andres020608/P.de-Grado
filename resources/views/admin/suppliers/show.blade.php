<x-layouts.admin>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-900">{{ $supplier->name }}</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.suppliers.edit', $supplier) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Editar
                    </a>
                    <a href="{{ route('admin.suppliers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                        Volver
                    </a>
                </div>
            </div>
        </div>

        <div class="p-6 space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Contacto Principal</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $supplier->primary_contact ?? 'No especificado' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Email de Contacto</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $supplier->contact_email ?? 'No especificado' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Especialidad en Materiales</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $supplier->material_specialty ?? 'No especificado' }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Ubicación</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $supplier->location ?? 'No especificado' }}</p>
                </div>
            </div>

            <div class="flex space-x-4">
                <div class="flex items-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $supplier->rjc_certified ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $supplier->rjc_certified ? '✓' : '✗' }} Certificado RJC
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $supplier->carbon_neutral ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $supplier->carbon_neutral ? '✓' : '✗' }} Carbono Neutral
                    </span>
                </div>
                <div class="flex items-center">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $supplier->heritage_craft ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $supplier->heritage_craft ? '✓' : '✗' }} Artesanía Heredada
                    </span>
                </div>
            </div>

            <div class="border-t pt-4">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Productos</h3>
                @if($supplier->products->isEmpty())
                    <p class="text-sm text-gray-500">No hay productos asociados a este proveedor.</p>
                @else
                    <ul class="space-y-2">
                        @foreach($supplier->products as $product)
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