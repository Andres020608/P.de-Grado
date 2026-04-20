<x-layouts.admin>
    <div class="max-w-7xl mx-auto px-6 py-8">
        <header class="mb-10 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-headline font-bold text-primary">Reportes y Estadísticas</h1>
                <p class="text-on-surface-variant mt-1">Análisis de rendimiento y métricas de ventas.</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.sales.export') }}" class="bg-emerald-800 text-white px-4 py-2 rounded-sm text-sm font-medium hover:bg-emerald-900 transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">table_view</span>
                    Exportar Excel
                </a>
            </div>
        </header>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-white p-6 rounded-sm border border-outline-variant/10 shadow-sm">
                <p class="text-xs font-label uppercase tracking-widest text-on-surface-variant mb-2">Ingresos Totales</p>
                <h2 class="text-3xl font-headline font-bold text-primary">${{ number_format($totalRevenue, 2) }}</h2>
                <p class="text-[10px] text-green-600 mt-2">↑ Histórico acumulado</p>
            </div>
            <div class="bg-white p-6 rounded-sm border border-outline-variant/10 shadow-sm">
                <p class="text-xs font-label uppercase tracking-widest text-on-surface-variant mb-2">Ventas Realizadas</p>
                <h2 class="text-3xl font-headline font-bold text-primary">{{ $totalSales }}</h2>
                <p class="text-[10px] text-on-surface-variant mt-2">Transacciones totales</p>
            </div>
            <div class="bg-white p-6 rounded-sm border border-outline-variant/10 shadow-sm">
                <p class="text-xs font-label uppercase tracking-widest text-on-surface-variant mb-2">Productos Vendidos</p>
                <h2 class="text-3xl font-headline font-bold text-primary">{{ $topProducts->sum('total_qty') }}</h2>
                <p class="text-[10px] text-on-surface-variant mt-2">Unidades movilizadas</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-10">
            <!-- Sales Chart -->
            <div class="bg-white p-8 rounded-sm border border-outline-variant/10 shadow-sm">
                <h3 class="text-sm font-label uppercase tracking-widest mb-6">Ventas de los últimos 7 días</h3>
                <div class="h-64">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>

            <!-- Top Products Chart -->
            <div class="bg-white p-8 rounded-sm border border-outline-variant/10 shadow-sm">
                <h3 class="text-sm font-label uppercase tracking-widest mb-6">Productos más vendidos</h3>
                <div class="h-64">
                    <canvas id="productsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Recent Sales Table -->
        <div class="bg-white rounded-sm border border-outline-variant/10 shadow-sm overflow-hidden">
            <div class="px-8 py-6 border-b border-outline-variant/10">
                <h3 class="text-sm font-label uppercase tracking-widest">Transacciones Recientes</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-surface-container-low text-[10px] uppercase tracking-widest text-on-surface-variant">
                        <tr>
                            <th class="px-8 py-4">Factura</th>
                            <th class="px-8 py-4">Cliente</th>
                            <th class="px-8 py-4">Total</th>
                            <th class="px-8 py-4">Fecha</th>
                            <th class="px-8 py-4">Atendido por</th>
                            <th class="px-8 py-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm divide-y divide-outline-variant/5">
                        @foreach($recentSales as $sale)
                        <tr class="hover:bg-surface-container-lowest transition-colors">
                            <td class="px-8 py-4 font-bold">{{ $sale->invoice_number }}</td>
                            <td class="px-8 py-4">{{ $sale->customer_name }}</td>
                            <td class="px-8 py-4">${{ number_format($sale->total_amount, 2) }}</td>
                            <td class="px-8 py-4">{{ $sale->sale_date->format('d/m/Y') }}</td>
                            <td class="px-8 py-4 text-xs">{{ $sale->user->name }}</td>
                            <td class="px-8 py-4">
                                <a href="{{ route('admin.sales.invoice', $sale) }}" class="text-primary hover:underline flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[16px]">download</span>
                                    PDF
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts para Gráficas -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Configuración de Sales Chart
            const ctxSales = document.getElementById('salesChart').getContext('2d');
            new Chart(ctxSales, {
                type: 'line',
                data: {
                    labels: {!! json_encode($salesByDay->pluck('date')) !!},
                    datasets: [{
                        label: 'Ingresos ($)',
                        data: {!! json_encode($salesByDay->pluck('total')) !!},
                        borderColor: '#003229',
                        backgroundColor: 'rgba(0, 50, 41, 0.1)',
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: '#f0f0f0' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Configuración de Products Chart
            const ctxProducts = document.getElementById('productsChart').getContext('2d');
            new Chart(ctxProducts, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($topProducts->map(fn($item) => $item->product->name)) !!},
                    datasets: [{
                        data: {!! json_encode($topProducts->pluck('total_qty')) !!},
                        backgroundColor: [
                            '#003229', '#735c0a', '#95d3c1', '#dbdad5', '#fed65b'
                        ]
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
</x-layouts.admin>
