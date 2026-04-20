<!-- SideNavBar -->
<aside class="hidden md:flex flex-col h-screen w-64 fixed left-0 top-0 pt-20 bg-[#fbf9f4]/80 dark:bg-emerald-950/80 space-y-2 p-6 z-40">
    <div class="mb-8 px-2">
        <h2 class="font-noto-serif text-lg text-emerald-900 dark:text-emerald-50">Jessica Joyería</h2>
        <p class="font-manrope uppercase tracking-[0.1em] text-[10px] font-semibold text-emerald-900">Panel de Gestión</p>
    </div>
    <nav class="flex-1 space-y-1">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ ($active ?? '') === 'dashboard' ? 'text-emerald-900 dark:text-emerald-50 bg-[#ffffff] dark:bg-emerald-800/40 shadow-sm border-r-2 border-amber-600' : 'text-emerald-800/50 dark:text-emerald-200/40 hover:bg-[#ffffff]/50 dark:hover:bg-emerald-800/20 hover:text-emerald-900 dark:hover:text-emerald-50' }} font-manrope uppercase tracking-[0.1em] text-xs font-semibold transition-all ease-out duration-200 hover:translate-x-1">
            <span class="material-symbols-outlined text-lg" data-icon="dashboard">dashboard</span>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 {{ ($active ?? '') === 'products' ? 'text-emerald-900 dark:text-emerald-50 bg-[#ffffff] dark:bg-emerald-800/40 shadow-sm border-r-2 border-amber-600' : 'text-emerald-800/50 dark:text-emerald-200/40 hover:bg-[#ffffff]/50 dark:hover:bg-emerald-800/20 hover:text-emerald-900 dark:hover:text-emerald-50' }} font-manrope uppercase tracking-[0.1em] text-xs font-semibold transition-all ease-out duration-200 hover:translate-x-1">
            <span class="material-symbols-outlined text-lg" data-icon="inventory_2">inventory_2</span>
            <span>Productos</span>
        </a>

        <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 {{ ($active ?? '') === 'categories' ? 'text-emerald-900 dark:text-emerald-50 bg-[#ffffff] dark:bg-emerald-800/40 shadow-sm border-r-2 border-amber-600' : 'text-emerald-800/50 dark:text-emerald-200/40 hover:bg-[#ffffff]/50 dark:hover:bg-emerald-800/20 hover:text-emerald-900 dark:hover:text-emerald-50' }} font-manrope uppercase tracking-[0.1em] text-xs font-semibold transition-all ease-out duration-200 hover:translate-x-1">
            <span class="material-symbols-outlined text-lg" data-icon="category">category</span>
            <span>Categorias</span>
        </a>

        <a href="{{ route('admin.suppliers.index') }}" class="flex items-center gap-3 px-4 py-3 {{ ($active ?? '') === 'suppliers' ? 'text-emerald-900 dark:text-emerald-50 bg-[#ffffff] dark:bg-emerald-800/40 shadow-sm border-r-2 border-amber-600' : 'text-emerald-800/50 dark:text-emerald-200/40 hover:bg-[#ffffff]/50 dark:hover:bg-emerald-800/20 hover:text-emerald-900 dark:hover:text-emerald-50' }} font-manrope uppercase tracking-[0.1em] text-xs font-semibold transition-all ease-out duration-200 hover:translate-x-1">
            <span class="material-symbols-outlined text-lg" data-icon="local_shipping">local_shipping</span>
            <span>Proveedores</span>
        </a>

        <a href="{{ route('admin.sales.create') }}" class="flex items-center gap-3 px-4 py-3 {{ ($active ?? '') === 'sales_create' ? 'text-emerald-900 dark:text-emerald-50 bg-[#ffffff] dark:bg-emerald-800/40 shadow-sm border-r-2 border-amber-600' : 'text-emerald-800/50 dark:text-emerald-200/40 hover:bg-[#ffffff]/50 dark:hover:bg-emerald-800/20 hover:text-emerald-900 dark:hover:text-emerald-50' }} font-manrope uppercase tracking-[0.1em] text-xs font-semibold transition-all ease-out duration-200 hover:translate-x-1">
            <span class="material-symbols-outlined text-lg" data-icon="add_shopping_cart">add_shopping_cart</span>
            <span>Registrar Venta</span>
        </a>

        <a href="{{ route('admin.sales.index') }}" class="flex items-center gap-3 px-4 py-3 {{ ($active ?? '') === 'sales_index' ? 'text-emerald-900 dark:text-emerald-50 bg-[#ffffff] dark:bg-emerald-800/40 shadow-sm border-r-2 border-amber-600' : 'text-emerald-800/50 dark:text-emerald-200/40 hover:bg-[#ffffff]/50 dark:hover:bg-emerald-800/20 hover:text-emerald-900 dark:hover:text-emerald-50' }} font-manrope uppercase tracking-[0.1em] text-xs font-semibold transition-all ease-out duration-200 hover:translate-x-1">
            <span class="material-symbols-outlined text-lg" data-icon="history">history</span>
            <span>Historial de Ventas</span>
        </a>

        <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-3 {{ ($active ?? '') === 'reports' ? 'text-emerald-900 dark:text-emerald-50 bg-[#ffffff] dark:bg-emerald-800/40 shadow-sm border-r-2 border-amber-600' : 'text-emerald-800/50 dark:text-emerald-200/40 hover:bg-[#ffffff]/50 dark:hover:bg-emerald-800/20 hover:text-emerald-900 dark:hover:text-emerald-50' }} font-manrope uppercase tracking-[0.1em] text-xs font-semibold transition-all ease-out duration-200 hover:translate-x-1">
            <span class="material-symbols-outlined text-lg" data-icon="bar_chart">bar_chart</span>
            <span>Reportes</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 text-emerald-800/50 dark:text-emerald-200/40 hover:bg-[#ffffff]/50 dark:hover:bg-emerald-800/20 hover:text-emerald-900 dark:hover:text-emerald-50 font-manrope uppercase tracking-[0.1em] text-xs font-semibold transition-all ease-out duration-200 hover:translate-x-1">
            <span class="material-symbols-outlined text-lg" data-icon="settings">settings</span>
            <span>Settings</span>
        </a>
    </nav>
    <a href="{{ route('admin.products.create') }}" class="mt-auto bg-primary text-on-primary py-3 px-4 rounded-lg font-manrope uppercase tracking-[0.1em] text-xs font-bold hover:opacity-90 transition-opacity text-center">
        New Product
    </a>
</aside>
