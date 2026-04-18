<x-layouts.admin>
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-900">Editar Proveedor</h1>
        </div>

        <form method="POST" action="{{ route('admin.suppliers.update', $supplier) }}" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nombre *</label>
                <input type="text" name="name" id="name" value="{{ old('name', $supplier->name) }}" required
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="primary_contact" class="block text-sm font-medium text-gray-700">Contacto Principal</label>
                <input type="text" name="primary_contact" id="primary_contact" value="{{ old('primary_contact', $supplier->primary_contact) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('primary_contact')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="contact_email" class="block text-sm font-medium text-gray-700">Email de Contacto</label>
                <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $supplier->contact_email) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('contact_email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="material_specialty" class="block text-sm font-medium text-gray-700">Especialidad en Materiales</label>
                <input type="text" name="material_specialty" id="material_specialty" value="{{ old('material_specialty', $supplier->material_specialty) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Ej: oro, plata, diamantes">
                @error('material_specialty')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Ubicación</label>
                <input type="text" name="location" id="location" value="{{ old('location', $supplier->location) }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                @error('location')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-3">
                <div class="flex items-center">
                    <input type="checkbox" name="rjc_certified" id="rjc_certified" value="1" {{ old('rjc_certified', $supplier->rjc_certified) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="rjc_certified" class="ml-2 block text-sm text-gray-700">Certificado RJC</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="carbon_neutral" id="carbon_neutral" value="1" {{ old('carbon_neutral', $supplier->carbon_neutral) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="carbon_neutral" class="ml-2 block text-sm text-gray-700">Carbono Neutral</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="heritage_craft" id="heritage_craft" value="1" {{ old('heritage_craft', $supplier->heritage_craft) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="heritage_craft" class="ml-2 block text-sm text-gray-700">Artesanía Heredada</label>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.suppliers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md text-sm font-medium">
                    Cancelar
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium">
                    Actualizar Proveedor
                </button>
            </div>
        </form>
    </div>
</x-layouts.admin>