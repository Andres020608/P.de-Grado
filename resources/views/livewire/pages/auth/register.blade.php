<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'cliente';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'string', 'in:admin,cliente'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('inicio', absolute: false), navigate: false);
    }
}; ?>

<div class="relative min-h-screen overflow-hidden">
    <div class="fixed inset-0 z-0">
        <img alt="Colección de joyería de lujo" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAkAE9a7htSA0WaBMOWWI69XcfLH8n7OrLTGWKO54aTiHvS_02654SSbtKQu3iT2Sasg2HTn3Gs3ZJmJPGXyjjJB9BsxjTtReS3ejuV2WSePR1L4ynM05MwwQGIz7fV2YgNIj7uT0oLop9S8x4AYg4x9jjjHADBj3aFET9FzF7SnKfe4Xt8nshypgYwB9tNc" class="w-full h-full object-cover opacity-30 blur-sm scale-105" />
        <div class="absolute inset-0 bg-gradient-to-tr from-[#003229]/10 via-transparent to-[#fed65b]/5"></div>
    </div>

    <main class="relative z-10 mx-auto flex min-h-screen w-full max-w-[1200px] flex-col items-center justify-center gap-16 px-6 py-12">
        <div class="hidden md:flex max-w-md flex-col">
            <h1 class="text-5xl font-bold tracking-tighter leading-tight mb-6" style="font-family: 'Noto Serif', serif;">The Imperial<br/>Editorial</h1>
            <p class="text-lg text-[#404945] leading-relaxed mb-8 opacity-90">Ingresa al atelier digital y accede a una colección curada de piezas atemporales diseñadas para el conocedor moderno.</p>
            <div class="flex items-center gap-4">
                <div class="h-px w-12 bg-[#735c00]/40"></div>
                <span class="text-xs uppercase tracking-[0.2em] text-[#735c00] font-semibold">Legado desde 1924</span>
            </div>
        </div>

        <div class="w-full max-w-[480px] rounded-[32px] border border-white/20 p-8 md:p-12 glass-panel shadow-[0_20px_40px_rgba(27,28,25,0.05)]">
            <div class="text-center mb-10">
                <span class="material-symbols-outlined text-secondary text-4xl mb-4">diamond</span>
                <h2 class="text-2xl font-bold text-[#003229] tracking-tight" style="font-family: 'Noto Serif', serif;">Crea tu cuenta</h2>
                <p class="text-sm text-[#404945] mt-2">Únete a la colección privada de The Imperial Editorial</p>
            </div>

            <div class="flex border-b border-[#bfc9c4]/30 mb-8">
                <a href="{{ route('login') }}" class="flex-1 pb-4 font-semibold text-xs uppercase tracking-[0.2em] text-[#404945]/60 hover:text-[#003229] transition">Ingresar</a>
                <a href="{{ route('register') }}" class="flex-1 pb-4 font-semibold text-xs uppercase tracking-[0.2em] text-[#735c00] border-b-2 border-[#735c00]">Registrarse</a>
            </div>

            <form wire:submit="register" class="space-y-6">
                <div>
                    <label for="name" class="block text-[10px] uppercase tracking-[0.2em] text-[#404945] mb-1">Nombre</label>
                    <input wire:model="name" id="name" name="name" type="text" required autofocus autocomplete="name" placeholder="Nombre completo" class="w-full bg-transparent border-0 border-b border-[#bfc9c4] py-3 px-0 pl-1 text-sm text-[#1b1c19] focus:outline-none focus:border-[#735c00] transition" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-xs text-[#ba1a1a]" />
                </div>

                <div>
                    <label for="email" class="block text-[10px] uppercase tracking-[0.2em] text-[#404945] mb-1">Correo electrónico</label>
                    <input wire:model="email" id="email" name="email" type="email" required autocomplete="username" placeholder="atelier@imperial.com" class="w-full bg-transparent border-0 border-b border-[#bfc9c4] py-3 px-0 pl-1 text-sm text-[#1b1c19] focus:outline-none focus:border-[#735c00] transition" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-[#ba1a1a]" />
                </div>

                <div>
                    <label for="password" class="block text-[10px] uppercase tracking-[0.2em] text-[#404945] mb-1">Clave de seguridad</label>
                    <div class="relative">
                        <input wire:model="password" id="password" name="password" type="password" required autocomplete="new-password" placeholder="••••••••••••" class="w-full bg-transparent border-0 border-b border-[#bfc9c4] py-3 px-0 pl-1 pr-10 text-sm text-[#1b1c19] focus:outline-none focus:border-[#735c00] transition" />
                        <button type="button" onclick="togglePasswordVisibility('password', this)" class="absolute right-0 bottom-3 text-[#404945]/60 hover:text-[#003229] transition pr-2">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-[#ba1a1a]" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-[10px] uppercase tracking-[0.2em] text-[#404945] mb-1">Confirmar clave de seguridad</label>
                    <div class="relative">
                        <input wire:model="password_confirmation" id="password_confirmation" name="password_confirmation" type="password" required autocomplete="new-password" placeholder="••••••••••••" class="w-full bg-transparent border-0 border-b border-[#bfc9c4] py-3 px-0 pl-1 pr-10 text-sm text-[#1b1c19] focus:outline-none focus:border-[#735c00] transition" />
                        <button type="button" onclick="togglePasswordVisibility('password_confirmation', this)" class="absolute right-0 bottom-3 text-[#404945]/60 hover:text-[#003229] transition pr-2">
                            <span class="material-symbols-outlined text-sm">visibility</span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-[#ba1a1a]" />
                </div>

                <div>
                    <label for="role" class="block text-[10px] uppercase tracking-[0.2em] text-[#404945] mb-1">Tipo de cuenta</label>
                    <select wire:model="role" id="role" name="role" required class="w-full bg-transparent border-0 border-b border-[#bfc9c4] py-3 px-0 pl-1 text-sm text-[#1b1c19] focus:outline-none focus:border-[#735c00] transition">
                        <option value="cliente">Cliente</option>
                        <option value="admin">Administrador</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-2 text-xs text-[#ba1a1a]" />
                </div>

                <button type="submit" wire:loading.attr="disabled" class="w-full bg-[#003229] hover:bg-[#00503f] disabled:opacity-50 text-white py-4 font-semibold text-xs uppercase tracking-[0.2em] rounded-lg transition-all flex items-center justify-center gap-2">
                    <span wire:loading.remove>Crear Cuenta</span>
                    <span wire:loading>Procesando...</span>
                    <span wire:loading.remove class="material-symbols-outlined text-sm">arrow_forward</span>
                </button>
            </form>
        </div>
    </main>

    <footer class="fixed bottom-0 w-full py-8 px-6 md:px-12 flex flex-col md:flex-row justify-between items-center gap-4 z-10 pointer-events-none">
        <div class="pointer-events-auto">
            <span class="text-[10px] uppercase tracking-[0.15em] text-[#404945]/60">© 2024 The Imperial Editorial. Todos los derechos reservados.</span>
        </div>
        <div class="flex gap-8 pointer-events-auto">
            <a href="#" class="text-[10px] uppercase tracking-[0.15em] text-[#404945]/60 hover:text-[#735c00] transition">Privacidad</a>
            <a href="#" class="text-[10px] uppercase tracking-[0.15em] text-[#404945]/60 hover:text-[#735c00] transition">Términos</a>
            <a href="#" class="text-[10px] uppercase tracking-[0.15em] text-[#404945]/60 hover:text-[#735c00] transition">Seguridad</a>
        </div>
    </footer>
</div>

<script>
    function togglePasswordVisibility(inputId, button) {
        const input = document.getElementById(inputId);

        if (!input) {
            return;
        }

        if (input.type === 'password') {
            input.type = 'text';
            button.querySelector('span').textContent = 'visibility_off';
        } else {
            input.type = 'password';
            button.querySelector('span').textContent = 'visibility';
        }
    }
</script>
