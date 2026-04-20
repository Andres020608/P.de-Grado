<x-layouts.admin>
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="flex items-center justify-between mb-12">
            <div>
                <a href="{{ route('admin.sales.index') }}" class="text-secondary font-label text-[10px] uppercase tracking-[0.2em] flex items-center gap-2 mb-4 hover:gap-4 transition-all">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Volver al Historial
                </a>
                <h1 class="text-4xl font-headline text-primary italic">Detalle de Transacción</h1>
                <p class="text-on-surface-variant font-body">Comprobante No. {{ $sale->invoice_number }}</p>
            </div>
            <div class="flex gap-4">
                <a href="{{ route('admin.sales.invoice', $sale) }}" class="flex items-center gap-2 px-6 py-3 bg-primary text-on-primary font-label text-xs font-bold uppercase tracking-widest hover:shadow-lg transition-all">
                    <span class="material-symbols-outlined text-sm">download</span>
                    Descargar Factura
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Information Column -->
            <div class="md:col-span-2 space-y-8">
                <!-- Customer info -->
                <div class="bg-surface-container-low p-8 rounded-sm">
                    <h2 class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em] mb-6">Información del Cliente</h2>
                    <div class="grid grid-cols-2 gap-8">
                        <div>
                            <p class="text-[10px] font-label uppercase text-stone-400 mb-1">Nombre</p>
                            <p class="font-headline text-primary text-lg">{{ $sale->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-label uppercase text-stone-400 mb-1">Documento</p>
                            <p class="font-body text-primary">{{ $sale->customer_document ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-label uppercase text-stone-400 mb-1">Correo Electrónico</p>
                            <p class="font-body text-primary">{{ $sale->customer_email ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-label uppercase text-stone-400 mb-1">Teléfono</p>
                            <p class="font-body text-primary">{{ $sale->customer_phone ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Items Table -->
                <div class="bg-surface-container-lowest border border-outline-variant/10 rounded-sm overflow-hidden">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-surface-container-low border-b border-outline-variant/10">
                                <th class="text-left py-4 px-6 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-widest">Producto</th>
                                <th class="text-center py-4 px-6 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-widest">Cantidad</th>
                                <th class="text-right py-4 px-6 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-widest">Precio Unit.</th>
                                <th class="text-right py-4 px-6 text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-widest">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-50">
                            @foreach($sale->items as $item)
                                <tr>
                                    <td class="py-6 px-6">
                                        <div class="flex items-center gap-4">
                                            <div class="h-12 w-12 bg-stone-50 rounded-sm overflow-hidden">
                                                @if($item->product->image)
                                                    <img src="{{ $item->product->image_url }}" class="h-full w-full object-cover">
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-headline text-primary text-sm">{{ $item->product->name }}</p>
                                                <p class="text-[10px] text-stone-400 uppercase">SKU: {{ $item->product->sku }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-6 px-6 text-center font-body text-sm">{{ $item->quantity }}</td>
                                    <td class="py-6 px-6 text-right font-body text-sm">${{ number_format($item->unit_price, 2) }}</td>
                                    <td class="py-6 px-6 text-right font-headline text-primary font-bold">${{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="border-t-2 border-primary">
                                <td colspan="3" class="py-6 px-6 text-right text-[10px] font-label font-bold text-primary uppercase tracking-[0.2em]">Total de la Transacción</td>
                                <td class="py-6 px-6 text-right font-headline text-primary text-2xl font-bold">${{ number_format($sale->total_amount, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <!-- Sidebar Column -->
            <div class="space-y-8">
                <div class="bg-primary text-on-primary p-8 rounded-sm">
                    <h3 class="text-[10px] font-label font-bold uppercase tracking-[0.2em] mb-6 opacity-60">Datos de la Venta</h3>
                    <div class="space-y-6">
                        <div>
                            <p class="text-[10px] font-label uppercase opacity-40 mb-1">Fecha y Hora</p>
                            <p class="font-body text-sm">{{ $sale->sale_date->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-label uppercase opacity-40 mb-1">Registrado por</p>
                            <p class="font-body text-sm">{{ $sale->user->name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-label uppercase opacity-40 mb-1">Estado Actual</p>
                            <span class="inline-block px-3 py-1 bg-secondary text-on-secondary text-[9px] font-bold uppercase tracking-widest rounded-full">
                                {{ strtoupper($sale->status ?? 'COMPLETADO') }}
                            </span>
                        </div>

                        <div class="pt-6 border-t border-white/10">
                            <form action="{{ route('admin.sales.update-status', $sale) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div>
                                    <label for="status" class="text-[10px] font-label uppercase opacity-40 mb-2 block">Cambiar Estado</label>
                                    <select name="status" id="status" class="w-full bg-white/10 border-none text-white text-xs font-label uppercase tracking-widest rounded-sm focus:ring-1 focus:ring-secondary cursor-pointer">
                                        <option value="completado" class="text-primary" {{ $sale->status == 'completado' ? 'selected' : '' }}>Completado</option>
                                        <option value="pendiente" class="text-primary" {{ $sale->status == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                        <option value="cancelado" class="text-primary" {{ $sale->status == 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                    </select>
                                </div>
                                <button type="submit" class="w-full py-2 bg-secondary text-on-secondary text-[9px] font-bold uppercase tracking-[0.2em] hover:opacity-90 transition-all">
                                    Actualizar Estado
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                @if($sale->notes)
                    <div class="bg-surface-container-low p-8 rounded-sm italic">
                        <h3 class="text-[10px] font-label font-bold text-on-surface-variant uppercase tracking-[0.2em] mb-4 not-italic">Notas</h3>
                        <p class="text-stone-600 text-sm leading-relaxed">"{{ $sale->notes }}"</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.admin>
