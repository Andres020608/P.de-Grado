<!-- TopNavBar -->
<header class="bg-[#fbf9f4]/80 dark:bg-emerald-950/80 backdrop-blur-md sticky top-0 z-50 shadow-[0_20px_40px_rgba(27,28,25,0.05)]">
    <div class="flex justify-between items-center w-full px-8 py-4">
        <div class="flex items-center gap-8">
            <a href="{{ route('dashboard') }}" class="text-2xl font-bold font-noto-serif text-emerald-900 dark:text-emerald-50 hover:opacity-80 transition">
                Jessica Joyería
            </a>
        </div>
        <div class="flex items-center space-x-6">
            <div class="hidden md:flex items-center space-x-8 mr-8">
                <a href="{{ route('admin.products.index') }}" class="text-emerald-900 dark:text-emerald-50 font-semibold font-noto-serif tracking-tight hover:text-amber-700 dark:hover:text-amber-400 transition-colors duration-300">Inventario</a>
                <a href="#" class="text-emerald-800/60 dark:text-emerald-200/60 font-noto-serif tracking-tight hover:text-amber-700 dark:hover:text-amber-400 transition-colors duration-300">Graficas</a>
                <a href="#" class="text-emerald-800/60 dark:text-emerald-200/60 font-noto-serif tracking-tight hover:text-amber-700 dark:hover:text-amber-400 transition-colors duration-300">Showroom</a>
            </div>
            <div class="flex items-center space-x-4">
                <button class="scale-98 active:opacity-80 transition-all text-emerald-900">
                    <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                </button>

                <!-- User Dropdown Menu -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 scale-98 active:opacity-80 transition-all text-emerald-900">
                        <span class="material-symbols-outlined" data-icon="person">person</span>
                        <span class="material-symbols-outlined text-sm" x-show="!open">expand_more</span>
                        <span class="material-symbols-outlined text-sm" x-show="open">expand_less</span>
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         @click.away="open = false"
                         @keydown.escape.window="open = false"
                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-1 z-50">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                        </div>
                        <a href="{{ route('profile') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                            <span class="material-symbols-outlined text-base">edit</span>
                            Editar perfil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                                <span class="material-symbols-outlined text-base">logout</span>
                                Cerrar sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
