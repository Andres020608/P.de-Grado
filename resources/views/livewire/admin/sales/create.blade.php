<?php

use Livewire\Volt\Component;
use App\Models\Product;
use App\Models\Sale;
use App\Services\SaleService;
use Illuminate\Support\Facades\Auth;

new class extends Component {
    // Datos del Cliente
    public string $customer_name = '';
    public string $customer_email = '';
    public string $customer_phone = '';
    public string $customer_document = '';
    public string $notes = '';

    // Datos de la Venta
    public string $search = '';
    public ?int $selected_product_id = null;
    public int $quantity = 1;
    public float $sale_price = 0;
    public string $sale_date = '';

    public function mount()
    {
        $this->sale_date = now()->format('Y-m-d');
    }

    public function getSelectedProductProperty()
    {
        return $this->selected_product_id ? Product::find($this->selected_product_id) : null;
    }

    public function selectProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $this->selected_product_id = $product->id;
            $this->sale_price = (float) $product->price;
            $this->search = $product->name;
        }
    }

    public function getResultsProperty()
    {
        if (strlen($this->search) < 2) return [];
        return Product::where('name', 'like', "%{$this->search}%")
            ->orWhere('sku', 'like', "%{$this->search}%")
            ->limit(5)
            ->get();
    }

    public function getSubtotalProperty()
    {
        return $this->sale_price * $this->quantity;
    }

    public function getTaxProperty()
    {
        return $this->subtotal * 0.19; // Ejemplo 19% IVA
    }

    public function getTotalProperty()
    {
        return $this->subtotal + $this->tax;
    }

    public function store(SaleService $saleService)
    {
        $this->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_document' => 'required|string|max:20',
            'selected_product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'sale_price' => 'required|numeric|min:0',
        ]);

        try {
            $sale = $saleService->createSale([
                'customer_name' => $this->customer_name,
                'customer_email' => $this->customer_email,
                'customer_phone' => $this->customer_phone,
                'customer_document' => $this->customer_document,
                'notes' => $this->notes,
                'user_id' => Auth::id(),
                'items' => [
                    [
                        'product_id' => $this->selected_product_id,
                        'quantity' => $this->quantity,
                    ]
                ]
            ]);

            session()->flash('success', 'Venta registrada con éxito. Factura: ' . $sale->invoice_number);
            return redirect()->route('admin.products.index'); // O a la lista de ventas cuando exista
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
}; ?>

<div class="max-w-6xl mx-auto px-12 py-16">
    <header class="mb-16">
        <nav class="mb-8 flex items-center gap-2 text-on-surface-variant font-label text-[10px] tracking-widest uppercase">
            <a class="hover:text-primary transition-colors" href="#">Admin</a>
            <span class="material-symbols-outlined text-[12px]">chevron_right</span>
            <a class="hover:text-primary transition-colors" href="#">Transacciones</a>
            <span class="material-symbols-outlined text-[12px]">chevron_right</span>
            <span class="text-primary font-bold">Nueva Venta</span>
        </nav>
        <h1 class="text-6xl font-headline font-bold text-primary tracking-tighter">Registrar Venta</h1>
        <p class="text-on-surface-variant mt-4 font-body text-lg max-w-2xl leading-relaxed">
            Registre una adquisición privada en el archivo Imperial. Asegúrese de que todos los detalles de la tasación coincidan con el certificado físico.
        </p>
    </header>

    @if (session()->has('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-8">
            {{ session('error') }}
        </div>
    @endif

    <form wire:submit.prevent="store" class="grid grid-cols-12 gap-x-12 gap-y-20">
        <!-- Left Column -->
        <div class="col-span-12 lg:col-span-7 space-y-16">
            <!-- Identity -->
            <section>
                <h3 class="text-xs font-label uppercase tracking-[0.3em] text-secondary mb-10 pb-2 border-b border-outline-variant/20">I. Identidad del Cliente</h3>
                <div class="space-y-10">
                    <div class="relative">
                        <x-input-label for="customer_name" :value="__('Nombre Legal Completo *')" info="Nombre que aparecerá en la factura oficial." class="block text-[10px] font-label uppercase tracking-widest text-on-surface-variant mb-2" />
                        <input wire:model="customer_name" id="customer_name" class="w-full bg-transparent border-none border-b border-outline-variant focus:ring-0 focus:border-secondary py-3 px-0 font-headline text-xl transition-all placeholder:text-outline-variant/40" placeholder="ej. Alistair Vance" type="text" required/>
                        @error('customer_name') <span class="text-error text-[10px] uppercase">{{ $message }}</span> @enderror
                    </div>
                    <div class="relative">
                        <x-input-label for="customer_document" :value="__('Documento de Identidad *')" info="ID, DNI o Pasaporte del cliente." class="block text-[10px] font-label uppercase tracking-widest text-on-surface-variant mb-2" />
                        <input wire:model="customer_document" id="customer_document" class="w-full bg-transparent border-none border-b border-outline-variant focus:ring-0 focus:border-secondary py-3 px-0 font-body text-base transition-all" placeholder="ID / DNI / Pasaporte" type="text" required/>
                        @error('customer_document') <span class="text-error text-[10px] uppercase">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-8">
                        <div class="relative">
                            <label class="block text-[10px] font-label uppercase tracking-widest text-on-surface-variant mb-2">Correo Electrónico *</label>
                            <input wire:model="customer_email" class="w-full bg-transparent border-none border-b border-outline-variant focus:ring-0 focus:border-secondary py-3 px-0 font-body text-base transition-all" placeholder="cliente@imperial.com" type="email" required/>
                            @error('customer_email') <span class="text-error text-[10px] uppercase">{{ $message }}</span> @enderror
                        </div>
                        <div class="relative">
                            <label class="block text-[10px] font-label uppercase tracking-widest text-on-surface-variant mb-2">Teléfono de Contacto</label>
                            <input wire:model="customer_phone" class="w-full bg-transparent border-none border-b border-outline-variant focus:ring-0 focus:border-secondary py-3 px-0 font-body text-base transition-all" placeholder="+34 000 000 000" type="tel"/>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Item Selection -->
            <section>
                <h3 class="text-xs font-label uppercase tracking-[0.3em] text-secondary mb-10 pb-2 border-b border-outline-variant/20">II. Selección de Artículo</h3>
                <div class="relative group">
                    <label class="block text-[10px] font-label uppercase tracking-widest text-on-surface-variant mb-4">Búsqueda en Inventario</label>
                    <div class="flex items-center border-b border-outline-variant focus-within:border-secondary transition-colors py-2">
                        <span class="material-symbols-outlined text-outline mr-3">search</span>
                        <input wire:model.live="search" class="w-full bg-transparent border-none focus:ring-0 py-2 px-0 font-headline text-lg" placeholder="Buscar por SKU o nombre..." type="text"/>
                    </div>
                    
                    @if(count($this->results) > 0 && !$selected_product_id)
                        <div class="absolute z-50 w-full bg-white shadow-xl rounded-sm mt-1 border border-outline-variant/20 overflow-hidden">
                            @foreach($this->results as $product)
                                <div wire:click="selectProduct({{ $product->id }})" class="p-4 hover:bg-surface-container-low cursor-pointer flex gap-4 items-center border-b border-outline-variant/10">
                                    <div class="w-12 h-12 bg-gray-100 rounded-sm overflow-hidden flex-shrink-0">
                                        @if($product->image)
                                            <img src="{{ $product->image_url }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold">{{ $product->name }}</p>
                                        <p class="text-[10px] uppercase opacity-50">SKU: {{ $product->sku }} | Stock: {{ $product->stock }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                @if($this->selected_product)
                    <div class="mt-8 p-4 bg-surface-container border border-secondary flex gap-4 items-center relative rounded-sm animate-in fade-in slide-in-from-top-2">
                        <div class="absolute top-2 right-2">
                            <button type="button" wire:click="$set('selected_product_id', null)" class="material-symbols-outlined text-secondary hover:text-primary transition-colors" style="font-variation-settings: 'FILL' 1;">cancel</button>
                        </div>
                        <div class="w-16 h-16 bg-white overflow-hidden rounded-sm flex-shrink-0">
                            @if($this->selected_product->image)
                                <img src="{{ $this->selected_product->image_url }}" class="w-full h-full object-cover">
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-headline font-bold">{{ $this->selected_product->name }}</p>
                            <p class="text-[10px] font-label uppercase text-secondary">Seleccionado | Stock disponible: {{ $this->selected_product->stock }}</p>
                        </div>
                    </div>
                @endif
                @error('selected_product_id') <span class="text-error text-[10px] uppercase mt-2 block">{{ $message }}</span> @enderror
            </section>

            <!-- Transaction Details -->
            <section>
                <h3 class="text-xs font-label uppercase tracking-[0.3em] text-secondary mb-10 pb-2 border-b border-outline-variant/20">III. Detalles de Transacción</h3>
                <div class="grid grid-cols-3 gap-8">
                    <div class="relative">
                        <label class="block text-[10px] font-label uppercase tracking-widest text-on-surface-variant mb-2">Precio de Venta ($)</label>
                        <input wire:model.live="sale_price" class="w-full bg-transparent border-none border-b border-outline-variant focus:ring-0 focus:border-secondary py-3 px-0 font-headline text-2xl transition-all" type="number" step="0.01"/>
                        @if($this->selected_product)
                            <span class="text-[10px] text-on-surface-variant/60 mt-2 block">Tasación original: ${{ number_format($this->selected_product->price, 2) }}</span>
                        @endif
                    </div>
                    <div class="relative">
                        <label class="block text-[10px] font-label uppercase tracking-widest text-on-surface-variant mb-2">Cantidad</label>
                        <input wire:model.live="quantity" class="w-full bg-transparent border-none border-b border-outline-variant focus:ring-0 focus:border-secondary py-3 px-0 font-headline text-2xl transition-all" type="number" min="1"/>
                    </div>
                    <div class="relative">
                        <label class="block text-[10px] font-label uppercase tracking-widest text-on-surface-variant mb-2">Fecha de Adquisición</label>
                        <input wire:model="sale_date" class="w-full bg-transparent border-none border-b border-outline-variant focus:ring-0 focus:border-secondary py-3 px-0 font-body text-base transition-all" type="date"/>
                    </div>
                </div>
            </section>

            <!-- Notes -->
            <section>
                <h3 class="text-xs font-label uppercase tracking-[0.3em] text-secondary mb-10 pb-2 border-b border-outline-variant/20">IV. Notas Editoriales</h3>
                <textarea wire:model="notes" class="w-full bg-surface-container-low border-none border-b border-outline-variant focus:ring-0 focus:border-secondary p-4 font-body text-base transition-all italic placeholder:not-italic" placeholder="Registre ajustes de tamaño, inscripciones personalizadas o solicitudes de entrega específicas..." rows="4"></textarea>
            </section>
        </div>

        <!-- Right Column: Summary -->
        <div class="col-span-12 lg:col-span-5">
            <div class="sticky top-24 space-y-8">
                <div class="bg-primary text-on-primary p-10 rounded-sm shadow-2xl relative overflow-hidden">
                    <h4 class="text-xs font-label uppercase tracking-[0.4em] mb-12 opacity-60">Resumen de Adquisición</h4>
                    <div class="space-y-6">
                        <div class="flex justify-between items-end border-b border-white/10 pb-4">
                            <div>
                                <p class="text-[10px] uppercase tracking-widest opacity-50 mb-1">Artículo</p>
                                <p class="font-headline text-lg">{{ $this->selected_product ? $this->selected_product->name : 'No seleccionado' }}</p>
                            </div>
                            <p class="font-headline text-lg">${{ number_format($this->subtotal, 2) }}</p>
                        </div>
                        <div class="flex justify-between items-end border-b border-white/10 pb-4">
                            <p class="text-[10px] uppercase tracking-widest opacity-50">Impuesto (IVA 19%)</p>
                            <p class="font-body text-sm font-light">${{ number_format($this->tax, 2) }}</p>
                        </div>
                        <div class="flex justify-between items-end pt-4">
                            <p class="text-xs uppercase tracking-[0.2em] font-bold">Inversión Total</p>
                            <p class="font-headline text-4xl font-bold text-secondary-fixed">${{ number_format($this->total, 2) }}</p>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-6 bg-secondary text-on-primary font-label text-sm uppercase tracking-[0.3em] font-bold hover:opacity-90 transition-all flex items-center justify-center gap-4 group">
                    <span wire:loading.remove>Registrar Venta</span>
                    <span wire:loading>Procesando...</span>
                    <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>

                <a href="{{ route('admin.products.index') }}" class="w-full py-4 border border-outline-variant/30 text-error font-label text-[10px] uppercase tracking-[0.2em] hover:bg-error-container/10 transition-all flex items-center justify-center">
                    Cancelar
                </a>

                <div class="p-6 bg-surface-container-low border border-outline-variant/10">
                    <div class="flex gap-4 items-start">
                        <span class="material-symbols-outlined text-secondary">info</span>
                        <div>
                            <p class="text-[10px] font-label uppercase tracking-widest text-on-surface-variant leading-relaxed">
                                Esta transacción se registrará con la marca de tiempo <span class="font-bold text-primary">{{ now()->format('Y.m.d H:i:s') }} UTC</span> y se atribuirá a <span class="font-bold text-primary">{{ Auth::user()->name }}</span>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
