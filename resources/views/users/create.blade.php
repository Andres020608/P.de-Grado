<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Crear usuario</h2>
                <p class="text-sm text-gray-500">Registra un nuevo usuario y asigna su rol.</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-900">Volver</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <x-input-label for="name" :value="__('Nombre')" info="Nombre legal completo del usuario." />
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Correo')" info="Se utilizará para el inicio de sesión y notificaciones." />
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('email')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                            <input type="password" name="password" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            @error('password')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Confirmar contraseña</label>
                            <input type="password" name="password_confirmation" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div>
                            <x-input-label for="role" :value="__('Rol')" info="Define el nivel de acceso al panel administrativo." />
                            <select name="role" id="role" class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                @foreach(App\Models\User::roles() as $roleKey => $roleLabel)
                                    <option value="{{ $roleKey }}" {{ old('role') === $roleKey ? 'selected' : '' }}>{{ $roleLabel }}</option>
                                @endforeach
                            </select>
                            @error('role')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div class="pt-4">
                            <button type="submit" class="inline-flex items-center justify-center w-full rounded-md bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700">Guardar usuario</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
