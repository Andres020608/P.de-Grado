<x-layouts.admin active="dashboard">
    <div class="mb-12">
        <h2 class="text-4xl font-headline text-primary mb-2 italic">Bienvenido, {{ auth()->user()->name }}.</h2>
        <p class="text-on-surface-variant font-body">Estado actual de su boutique digital al día de hoy.</p>
    </div>

    <!-- KPI Bento Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-[20px_20px_40px_rgba(27,28,25,0.03)] border-b-2 border-transparent hover:border-secondary transition-all group">
            <p class="text-[10px] font-label uppercase tracking-[0.2em] text-on-surface-variant/70 mb-4">Ventas Totales</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-headline text-primary">${{ number_format($totalSales, 2) }}</h3>
                <span class="text-secondary text-xs font-bold italic">En vivo</span>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-[20px_20px_40px_rgba(27,28,25,0.03)] border-b-2 border-transparent hover:border-secondary transition-all group">
            <p class="text-[10px] font-label uppercase tracking-[0.2em] text-on-surface-variant/70 mb-4">Producto Más Vendido</p>
            <div class="flex items-end justify-between">
                <h3 class="text-xl font-headline text-primary leading-tight">{{ $topProductName }}</h3>
                <span class="material-symbols-outlined text-secondary">star</span>
            </div>
        </div>
        <div class="bg-surface-container-lowest p-8 rounded-xl shadow-[20px_20px_40px_rgba(27,28,25,0.03)] border-b-2 border-transparent hover:border-secondary transition-all group">
            <p class="text-[10px] font-label uppercase tracking-[0.2em] text-on-surface-variant/70 mb-4">Valor de Inventario</p>
            <div class="flex items-end justify-between">
                <h3 class="text-3xl font-headline text-primary">${{ number_format($inventoryValue, 2) }}</h3>
                <span class="text-primary/40 text-xs font-bold uppercase tracking-widest">Activo</span>
            </div>
        </div>
    </div>

    <!-- Main Content Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Left Column: Chart & Recent Activity -->
        <div class="lg:col-span-8 space-y-12">
            <!-- Weekly Sales Chart -->
            <section class="bg-surface-container-low rounded-xl p-8 relative overflow-hidden flex flex-col">
                <div class="flex justify-between items-center mb-8">
                    <h4 class="font-headline text-xl text-primary">Tendencia de Ventas (Últimos 7 días)</h4>
                </div>
                <div class="h-64">
                    <canvas id="weeklySalesChart"></canvas>
                </div>
            </section>

            <!-- Recent Activity -->
            <section>
                <h4 class="font-headline text-2xl text-primary mb-8 italic">Actividad Reciente</h4>
                <div class="space-y-4">
                    @forelse($recentSales as $sale)
                        <div class="flex items-center justify-between p-6 bg-surface-container-lowest rounded-lg hover:shadow-md transition-shadow">
                            <div class="flex items-center gap-6">
                                <div class="w-12 h-12 bg-primary-container rounded flex items-center justify-center text-on-primary-container">
                                    <span class="material-symbols-outlined">shopping_bag</span>
                                </div>
                                <div>
                                    <p class="font-bold text-primary text-sm">Venta: {{ $sale->invoice_number }}</p>
                                    <p class="text-xs text-on-surface-variant">Cliente: {{ $sale->customer_name }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-6">
                                <div class="text-right">
                                    <p class="font-bold text-primary text-sm">${{ number_format($sale->total_amount, 2) }}</p>
                                    <p class="text-[10px] font-label uppercase text-on-surface-variant/60">{{ $sale->sale_date->diffForHumans() }}</p>
                                </div>
                                <a href="{{ route('admin.sales.show', $sale) }}" class="p-2 text-secondary hover:bg-secondary/10 rounded-full transition-all" title="Ver Detalles">
                                    <span class="material-symbols-outlined">visibility</span>
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-on-surface-variant italic">No hay actividad reciente.</p>
                    @endforelse
                </div>
            </section>
        </div>

        <!-- Right Column: Stock Alerts & Top Products Chart -->
        <div class="lg:col-span-4 space-y-12">
            <!-- Stock Alerts -->
            <section class="bg-primary text-on-primary p-8 rounded-xl relative overflow-hidden">
                <div class="absolute -right-10 -top-10 opacity-10">
                    <span class="material-symbols-outlined text-[120px]">inventory_2</span>
                </div>
                <h4 class="font-headline text-xl mb-6 relative z-10">Alertas de Stock</h4>
                <div class="space-y-6 relative z-10">
                    @forelse($lowStockProducts as $product)
                        <div class="border-b border-on-primary/10 pb-4 last:border-0">
                            <div class="flex justify-between items-start mb-2">
                                <p class="text-sm font-bold">{{ $product->name }}</p>
                                <span class="font-bold text-[10px] uppercase tracking-widest {{ $product->stock_color }}">{{ $product->stock_level }}</span>
                            </div>
                            <p class="text-xs text-on-primary-container/80 mb-3">{{ $product->stock }} unidades restantes.</p>
                            <div class="w-full bg-white/10 h-1 rounded-full overflow-hidden">
                                <div class="h-full {{ $product->stock_bar_color }}" style="width: {{ min(100, $product->stock * 10) }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-on-primary-container italic">Todo el stock está correcto.</p>
                    @endforelse
                </div>
                <a href="{{ route('admin.products.index') }}" class="mt-6 block w-full text-center text-[10px] font-label uppercase tracking-widest border border-on-primary/20 py-3 hover:bg-white/10 transition-all">
                    Ver Inventario Completo
                </a>
            </section>

            <!-- Top Products Donut Chart -->
            <section class="bg-surface-container-low rounded-xl p-8">
                <h4 class="font-headline text-lg text-primary mb-6">Distribución de Ventas</h4>
                <div class="h-64">
                    <canvas id="topProductsChart"></canvas>
                </div>
            </section>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Weekly Sales Chart
            const weeklyCtx = document.getElementById('weeklySalesChart').getContext('2d');
            new Chart(weeklyCtx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($weeklySales->pluck('date')) !!},
                    datasets: [{
                        label: 'Ventas',
                        data: {!! json_encode($weeklySales->pluck('count')) !!},
                        backgroundColor: '#003229',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true, grid: { display: false } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Top Products Chart
            const topCtx = document.getElementById('topProductsChart').getContext('2d');
            new Chart(topCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($topProducts->map(fn($tp) => $tp->product->name)) !!},
                    datasets: [{
                        data: {!! json_encode($topProducts->pluck('total_sold')) !!},
                        backgroundColor: ['#003229', '#735c00', '#2b695a', '#fed65b', '#0a5043'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 10 } } }
                    }
                }
            });
        });
    </script>
    @endpush
</x-layouts.admin>
