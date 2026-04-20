<?php

use Livewire\Volt\Component;
use App\Models\Sale;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $customer_search = '';
    public string $date_from = '';
    public string $date_to = '';

    public function updatingCustomerSearch()
    {
        $this->resetPage();
    }

    public function updatingDateFrom()
    {
        $this->resetPage();
    }

    public function updatingDateTo()
    {
        $this->resetPage();
    }

    public function getSalesProperty()
    {
        return Sale::with(['items.product', 'user'])
            ->when($this->customer_search, function ($query) {
                $query->where('customer_name', 'like', '%' . $this->customer_search . '%');
            })
            ->when($this->date_from, function ($query) {
                $query->whereDate('sale_date', '>=', $this->date_from);
            })
            ->when($this->date_to, function ($query) {
                $query->whereDate('sale_date', '<=', $this->date_to);
            })
            ->orderBy('sale_date', 'desc')
            ->paginate(10);
    }

    public function clearFilters()
    {
        $this->reset(['customer_search', 'date_from', 'date_to']);
    }
}; ?>

<div class="max-w-6xl mx-auto">
    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
        <div>
            <h1 class="text-5xl font-serif text-primary tracking-tight mb-2">Historial de Transacciones</h1>
            <p class="text-stone-500 font-body text-lg italic">Registro exclusivo de adquisiciones y movimientos de la colección imperial.</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-2 px-6 py-3 border border-outline/20 text-primary font-label text-xs font-bold uppercase tracking-widest hover:bg-primary/5 transition-colors">
                <span class="material-symbols-outlined text-sm">bar_chart</span>
                Reportes
            </a>
            <a href="{{ route('admin.sales.export') }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-on-primary font-label text-xs font-bold uppercase tracking-widest hover:shadow-lg transition-all">
                <span class="material-symbols-outlined text-sm">table_view</span>
                Exportar a Excel
            </a>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-surface-container-low p-8 mb-12 rounded-sm border border-outline-variant/10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative group">
                <label class="block text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em] mb-2">Nombre del Cliente</label>
                <input wire:model.live.debounce.300ms="customer_search" class="w-full bg-transparent border-b border-outline-variant py-2 focus:border-secondary outline-none transition-colors text-primary placeholder:text-stone-400" placeholder="Buscar por cliente..." type="text"/>
            </div>
            <div class="relative group">
                <label class="block text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em] mb-2">Rango de Fechas</label>
                <div class="flex items-center gap-2">
                    <input wire:model.live="date_from" class="w-full bg-transparent border-b border-outline-variant py-2 focus:border-secondary outline-none transition-colors text-primary" type="date"/>
                    <span class="text-stone-400 font-label text-xs">A</span>
                    <input wire:model.live="date_to" class="w-full bg-transparent border-b border-outline-variant py-2 focus:border-secondary outline-none transition-colors text-primary" type="date"/>
                </div>
            </div>
            <div class="flex items-end">
                <button wire:click="clearFilters" class="text-secondary font-label text-xs font-bold uppercase tracking-widest flex items-center gap-2 group">
                    Limpiar Filtros
                    <span class="h-[1px] w-8 bg-secondary transition-all group-hover:w-12"></span>
                </button>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="relative overflow-x-auto bg-surface-container-lowest border border-outline-variant/10 rounded-sm">
        <table class="w-full border-collapse">
            <thead>
                <tr class="border-b border-stone-100">
                    <th class="text-left py-6 px-4 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em]">Fecha</th>
                    <th class="text-left py-6 px-4 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em]">Cliente</th>
                    <th class="text-left py-6 px-4 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em]">Artículo (SKU)</th>
                    <th class="text-right py-6 px-4 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em]">Cant.</th>
                    <th class="text-right py-6 px-4 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em]">Total</th>
                    <th class="text-center py-6 px-4 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em]">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-stone-50">
                @forelse($this->sales as $sale)
                    <tr class="group hover:bg-surface-container-low transition-colors">
                        <td class="py-8 px-4 font-body text-sm text-stone-600">{{ $sale->sale_date->format('d M, Y') }}</td>
                        <td class="py-8 px-4">
                            <div class="flex flex-col">
                                <span class="font-serif text-primary text-base">{{ $sale->customer_name }}</span>
                                <span class="text-[10px] font-label text-stone-400 uppercase">{{ $sale->customer_email }}</span>
                            </div>
                        </td>
                        <td class="py-8 px-4">
                            <div class="flex items-center gap-4">
                                <div class="h-10 w-10 bg-stone-100 overflow-hidden rounded-sm flex-shrink-0">
                                    @if($sale->items->first() && $sale->items->first()->product->image)
                                        <img src="{{ $sale->items->first()->product->image_url }}" class="h-full w-full object-cover">
                                    @endif
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-body text-sm text-stone-700">{{ $sale->items->first()->product->name ?? 'N/A' }}</span>
                                    <span class="text-[10px] text-stone-400 uppercase">SKU: {{ $sale->items->first()->product->sku ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-8 px-4 text-right font-body text-sm text-stone-600">{{ $sale->items->sum('quantity') }}</td>
                        <td class="py-8 px-4 text-right font-serif text-primary font-bold">${{ number_format($sale->total_amount, 2) }}</td>
                        <td class="py-8 px-4 text-center">
                            <a href="{{ route('admin.sales.invoice', $sale) }}" class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container text-primary text-[10px] font-bold uppercase tracking-widest rounded-sm hover:bg-primary hover:text-on-primary transition-all">
                                <span class="material-symbols-outlined text-sm">download</span>
                                Factura
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center text-stone-400 italic">No se encontraron transacciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $this->sales->links() }}
    </div>
</div>
