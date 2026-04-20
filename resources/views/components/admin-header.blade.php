<!-- TopNavBar -->
<header class="bg-[#fbf9f4]/80 dark:bg-emerald-950/80 backdrop-blur-md sticky top-0 z-50 shadow-[0_20px_40px_rgba(27,28,25,0.05)]">
    <div class="flex justify-between items-center w-full px-8 py-4">
        <div class="flex items-center gap-8">
            <a href="{{ route('inicio') }}" class="text-2xl font-bold font-noto-serif text-emerald-900 dark:text-emerald-50 hover:opacity-80 transition">
                Jessica Joyería
            </a>
        </div>
        <div class="flex items-center space-x-6">
            <div class="hidden md:flex items-center space-x-8 mr-8">
                <a href="{{ route('admin.products.index') }}" class="text-emerald-900 dark:text-emerald-50 font-semibold font-noto-serif tracking-tight hover:text-amber-700 dark:hover:text-amber-400 transition-colors duration-300">Inventario</a>
                <a href="{{ route('admin.reports.index') }}" class="text-emerald-800/60 dark:text-emerald-200/60 font-noto-serif tracking-tight hover:text-amber-700 dark:hover:text-amber-400 transition-colors duration-300">Graficas</a>
            </div>
            <div class="flex items-center space-x-4">
                @php
                    $lowStockAlerts = \App\Models\Product::where('stock', '<=', 9)->orderBy('stock')->get();
                    $alertCount = $lowStockAlerts->count();
                @endphp

                <!-- Notifications Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative scale-98 active:opacity-80 transition-all text-emerald-900 hover:text-amber-700 dark:hover:text-amber-400">
                        <span class="material-symbols-outlined" data-icon="notifications">notifications</span>
                        @if($alertCount > 0)
                            <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-error text-[10px] font-bold text-white shadow-sm">
                                {{ $alertCount }}
                            </span>
                        @endif
                    </button>

                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         @click.away="open = false"
                         class="absolute right-0 mt-4 w-80 bg-white rounded-lg shadow-xl border border-gray-100 py-2 z-50">
                        
                        <div class="px-4 py-2 border-b border-gray-50">
                            <h3 class="text-[10px] font-label font-bold uppercase tracking-[0.2em] text-stone-400">Alertas de Inventario</h3>
                        </div>

                        <div class="max-h-64 overflow-y-auto">
                            @forelse($lowStockAlerts as $alert)
                                <a href="{{ route('admin.products.edit', $alert) }}" class="flex items-start gap-3 px-4 py-4 hover:bg-surface-container-low transition-colors border-b border-gray-50 last:border-0">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-sm bg-surface-container flex items-center justify-center">
                                        <span class="material-symbols-outlined text-sm {{ $alert->stock < 5 ? 'text-error' : 'text-secondary' }}">inventory_2</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-bold text-primary truncate">{{ $alert->name }}</p>
                                        <p class="text-[10px] text-stone-500">Stock: <span class="font-bold {{ $alert->stock < 5 ? 'text-error' : 'text-secondary' }}">{{ $alert->stock }}</span> unidades</p>
                                    </div>
                                    <span class="text-[9px] font-bold uppercase tracking-tighter {{ $alert->stock < 5 ? 'text-error' : 'text-secondary' }}">
                                        {{ $alert->stock < 5 ? 'CRÍTICO' : 'BAJO' }}
                                    </span>
                                </a>
                            @empty
                                <div class="px-4 py-8 text-center">
                                    <span class="material-symbols-outlined text-stone-200 text-4xl mb-2">check_circle</span>
                                    <p class="text-xs text-stone-400 italic">No hay alertas de stock pendientes.</p>
                                </div>
                            @endforelse
                        </div>

                        @if($alertCount > 0)
                            <div class="px-4 py-2 bg-surface-container-low text-center border-t border-gray-100">
                                <a href="{{ route('admin.products.index') }}" class="text-[9px] font-bold uppercase tracking-widest text-secondary hover:opacity-80 transition-opacity">Ver Inventario Completo</a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- User Dropdown Menu -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 scale-98 active:opacity-80 transition-all text-emerald-900 hover:text-amber-700 dark:hover:text-amber-400">
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
