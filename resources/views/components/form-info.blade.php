@props(['message'])

<div x-data="{ open: false }" class="inline-block ml-1 relative">
    <button 
        type="button" 
        @click="open = !open" 
        @click.away="open = false"
        class="text-secondary hover:text-primary transition-colors focus:outline-none"
    >
        <span class="material-symbols-outlined text-[16px] align-middle" style="font-variation-settings: 'FILL' 1;">info</span>
    </button>

    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-1"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-1"
        class="absolute z-50 w-64 p-3 mt-2 text-xs font-medium text-on-surface-variant bg-surface-container border border-outline-variant rounded-sm shadow-xl -left-2 top-full"
        style="display: none;"
    >
        <div class="relative">
            {{ $message }}
            <!-- Arrow -->
            <div class="absolute -top-4 left-3 w-3 h-3 bg-surface-container border-l border-t border-outline-variant rotate-45"></div>
        </div>
    </div>
</div>
