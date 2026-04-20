@extends('layouts.app')

@section('content')
<!-- TopNavBar -->
<header class="fixed top-0 w-full z-50 bg-[#fbf9f4]/80 dark:bg-[#003229]/90 backdrop-blur-xl shadow-sm dark:shadow-none">
<nav class="flex justify-between items-center px-8 py-4 max-w-full mx-auto">
<div class="flex items-center space-x-12">
<a class="text-2xl font-serif font-bold text-[#003229] dark:text-[#fbf9f4] tracking-tighter" href="#">Jessica Joyería</a>
<div class="hidden md:flex space-x-8">
<a class="font-serif text-lg tracking-tight text-[#735c00] border-b-2 border-[#735c00] pb-1 hover:text-[#735c00] transition-colors duration-300" href="#">Inicio</a>
<a class="font-serif text-lg tracking-tight text-[#003229] dark:text-[#fbf9f4] opacity-80 hover:text-[#735c00] transition-colors duration-300" href="#">Colección</a>
<a class="font-serif text-lg tracking-tight text-[#003229] dark:text-[#fbf9f4] opacity-80 hover:text-[#735c00] transition-colors duration-300" href="#herencia">Nosotros</a>
</div>
</div>
<div class="flex items-center space-x-6">
@auth
    <!-- User Menu for authenticated users -->
    <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex items-center gap-2 scale-95 active:opacity-80 transition-all text-[#003229] dark:text-[#fbf9f4] hover:text-[#735c00]">
            <span class="material-symbols-outlined">person</span>
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
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">
                    <span class="material-symbols-outlined text-base">admin_panel_settings</span>
                    Panel de Administración
                </a>
            @endif
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
@else
    <a href="{{ route('login') }}" class="font-serif text-lg tracking-tight text-[#003229] dark:text-[#fbf9f4] opacity-80 hover:text-[#735c00] transition-colors duration-300 scale-95 active:opacity-80 transition-all">Iniciar Sesión</a>
    <a href="{{ route('register') }}" class="bg-primary text-on-primary px-6 py-2 rounded-lg font-serif text-lg tracking-tight hover:bg-primary-container transition-all scale-95 active:opacity-80">Registrarse</a>
@endauth
</div>
</nav>
</header>
<!-- Hero Section - Full bleed starting from top -->
<section class="relative min-h-screen overflow-hidden flex items-center">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBOvGBBOCGNcer62il7rt7v-iOYgu5W8JqAW-Cgw3O9A-qn8n3ssMwblrd7EeSmbmqMYczt4Kn9bFId_e6AN3txC81NnYbFk-t3zosoQN9WvEEPO8tM5UQKtgrKmGVUPgRS7LK82mUZTMbxNEp98HsnAsatq5-0pwxSHGyMqDqwRou42diYLwCjQWkDanNnuKlZs1fzAutjEW_pNLlFLFh3Kqn_k9G-R7csihpL8ZUDJAMZVl7tgBSNtq7SuEbjIDo_fnTeRR6Ti5U"/>
<div class="absolute inset-0 bg-primary/20"></div>
</div>
<div class="relative z-10 max-w-7xl mx-auto px-8 grid grid-cols-12 gap-8">
<div class="col-span-12 md:col-span-7 space-y-8">
<span class="font-label text-sm uppercase tracking-[0.2em] text-white">La Colección de Alta Joyería</span>
<h1 class="font-headline text-5xl md:text-7xl lg:text-8xl text-white leading-tight -ml-1">Arte en <br/> <span class="italic">Cada Detalle</span></h1>
<p class="font-body text-xl text-white/90 max-w-lg leading-relaxed">Descubre nuestra colección exclusiva de joyería artesanal, donde la tradición y la elegancia se unen.</p>
<div class="pt-4">
<button class="bg-secondary text-surface px-10 py-5 rounded-lg font-label text-sm uppercase tracking-widest hover:bg-on-secondary-container transition-all editorial-shadow flex items-center gap-3">
                            Ver Colección
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
</button>
</div>
</div>
</div>
</section>
<!-- Featured Collection -->
<section class="py-32 px-8 max-w-[1440px] mx-auto">
<div class="flex flex-col md:flex-row justify-between items-end mb-24 gap-8">
<div class="max-w-2xl">
<h2 class="font-headline text-4xl md:text-5xl mb-6">Piezas Destacadas</h2>
<p class="text-on-surface-variant leading-relaxed">Cada pieza de nuestra colección es un testimonio del pursuit de la perfección, meticulosamente elaboradas en nuestros estudios artesanales.</p>
</div>
<button class="font-label text-xs uppercase tracking-widest text-secondary border-b border-secondary pb-1 hover:opacity-70 transition-opacity">Ver Todas las Colecciones</button>
</div>
<!-- Bento-Inspired Grid -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-8">
<!-- Large Feature Item -->
<div class="md:col-span-2 md:row-span-2 group">
<div class="relative overflow-hidden bg-surface-container-low h-full min-h-[600px]">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBO8GGNor3xa_sF_5uPZvRhV8FRchE5oneIncG4y9nghy7EONnhjPpKTQ91yV5bHZJZXosS45pAp6M-Ugm_PvGeMM7IBurFfqDsyC1ioQ553iQc0EqviI9LcMz_pT6cAJBbvOH1L0dBURI88ZldKtB9pcxOW2_RGUQ9yfAMZ06EQLZZbYu_fJN4vDfPTjhKJaYqbCx1wk-PEle6-e3_sXsXYaUyZ1dAvLkkVagNzAp0YNw10yDpf1KWdCGN6U9x8BQFDE9DRQjMtA4"/>
<div class="absolute bottom-8 left-8 text-surface">
<span class="font-label text-xs uppercase tracking-widest bg-primary/40 backdrop-blur-md px-3 py-1 mb-3 inline-block">Anillo Imperial</span>
<h3 class="font-headline text-3xl">Esmeralda en Oro 18k</h3>
</div>
</div>
</div>
<!-- Product Grid Items -->
<div class="group cursor-pointer">
<div class="aspect-[4/5] overflow-hidden bg-surface-container-low mb-6">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDLzzYKEbYn3JugVfXINHRc9CKTgDmQhzNzBwUbVifi2hQqSNby6dGMPpyTtID8PZyuG72jxWlvth5DNRy_E64OeuDpEsM-XoblG1cVQ_Uy37AGrSHoBy-3CS8ol03ieXPHqSEH9YfHtRl3t2NHAs3CcequpTVtYIEvBp_f14jzxj_DGIfbnZagAFTBRP-cI97rxcEVS3FmqxoX0a2E2GmNe-Is8d8HmtjqVsP-cLKqWN5qnfofWxY3XhINE_xS4vikjARErs5b_9U"/>
</div>
<span class="font-label text-xs uppercase tracking-widest bg-primary/40 backdrop-blur-md px-3 py-1 mb-3 inline-block">Aretes</span>
<h4 class="font-headline text-xl mt-1 mb-2">Drops de Diamante Celestial</h4>
<span class="text-secondary font-semibold">$3,200</span>
</div>
<div class="group cursor-pointer">
<div class="aspect-[4/5] overflow-hidden bg-surface-container-low mb-6">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCWC5w2jvIqATrhxXcWt9Sl61-dRmRfsHUe560MS1pZGR0e0Yj5xwc9PkCHbDuTW_oo3dwACQ2jZ2cAyfLrYplknyyIXQFLCFsz1VEpZKm2SinVQuIATACVNob8rXMz8sRErGvIUurumJBSDyBJa5LqIQQI4TUKqYz9fRSZw8bO3yLIznogknxn4Pk6BA8kpGRfYXb1ghpMZATXLyGR5l0V5hBIVzTUthcTD-W4rW9N69S48C661K7smJ-DLZ-PaTfeolRqV1SReB0"/>
</div>
<span class="font-label text-xs uppercase tracking-widest bg-primary/40 backdrop-blur-md px-3 py-1 mb-3 inline-block">Collares</span>
<h4 class="font-headline text-xl mt-1 mb-2">Perla Solitaria</h4>
<span class="text-secondary font-semibold">$1,850</span>
</div>
<div class="group cursor-pointer">
<div class="aspect-[4/5] overflow-hidden bg-surface-container-low mb-6">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzKOMfTKyVfqsTo6_vN91ktCA997-1q_aELMSwVpmXKtXsY7N_cGYm38i_uEdk3qSqDpvUPSV_O3kemXcrAIG7KiaWsmHFUMOtmEefe8P2fzl-1SGJSYY7IPg93TVF0HvNEAXWcRQJq5J07xdx4Ag-JF7kuYFhxnv-hTDm_tHgwyqzzMtBF5zFxB6qIvuU_AOGVL7D9MDDPrJu5mEnoanEDpjBmdBt-1RvATqeqWU5vOsDwuolwit1ePCpUTMudCU_ASKpi3IROTM"/>
</div>
<span class="font-label text-xs uppercase tracking-widest bg-primary/40 backdrop-blur-md px-3 py-1 mb-3 inline-block">Pulseras</span>
<h4 class="font-headline text-xl mt-1 mb-2">Brazalete Etéreo</h4>
<span class="text-secondary font-semibold">$5,400</span>
</div>
<div class="group cursor-pointer">
<div class="aspect-[4/5] overflow-hidden bg-surface-container-low mb-6">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBjG49nb_QZmeni62aG-6_XelVKqwIahKPAmugvGbCf2pCNcbQWdpGrk-JPexMBYGdzgHfCRftURJiiTkBsLuDOMK1ndYPAggOgyjsGcI3X0-bkDL9UyxaSmZos_gtqiOgZ4GSI3JumitnbRdSW4KqRNL9bqDsPp93dqOsrlA6N0c3bf6VXtkwGIVTm08VUqFWP25miIPegRGTI3ZJOBy8W_sC1UZTy2PKmSU_k7qsWqfUkKs0d0QLnKyGlPt9tTQW29CgkEkrUskw"/>
</div>
<span class="font-label text-xs uppercase tracking-widest bg-primary/40 backdrop-blur-md px-3 py-1 mb-3 inline-block">Anillos</span>
<h4 class="font-headline text-xl mt-1 mb-2">Banda Artesanal</h4>
<span class="text-secondary font-semibold">$950</span>
</div>
</div>
<!-- Additional Row (Asymmetric) -->
<div class="grid grid-cols-1 md:grid-cols-5 gap-8 mt-8">
<div class="md:col-span-2 group">
<div class="aspect-[16/9] overflow-hidden bg-surface-container-low mb-6">
<img class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBh8uDk6Y_f5myVkNsNE--0gShI3pQpClWwJuEJPMo9fSqMWSRupTTxGQdr25KF9fNCzw3-ZxnhbIMMteknHPxAQNNS80sNis9OiRnVEQzXkvb1DGIyBiR1jbFbK1-Gr7la8vw9OV-B937rasXZ42jcTy-XiilcnzzEx4qpjVt6xafmk2U5canvugjaWrVFIBNHEXPFlWEA849duntUCdiZmfH7cLSaiUESGrQd7PsSr8Y92T_Fo2WOK0cHa5sUDwUzZh8hgtMoFfU"/>
</div>
<h4 class="font-headline text-xl">La Selección del Taller</h4>
<p class="text-sm text-on-surface-variant mt-2">Comisiones personalizadas creadas para el coleccionista exigente.</p>
</div>
<div class="md:col-span-3 grid grid-cols-3 gap-8">
<!-- More items to fill 10 total as requested -->
<div class="group">
<div class="aspect-[1/1] bg-surface-container mb-4 overflow-hidden">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCYdXc5-2Giua33L1f8hl4eC5aF77_AJmVJ8DpThrkuCW7g2F7kAHJUfQP0h1bN12Q6ONXUJ23CfvxM95bE5u218C99TqRXMRfQBK200SuchyIsAirVOoir-22XCNSbMzkhPnwahbfeW09hFCyuRKuLN-uPy82znQktGmOdZx26HgLcR3dqldjpC2WdPhhM9tX0TUShsVN6_v1tmAWvyCPetiDQT7B-f51rgCvdIqLEVojJTb0jAnLyTH4-s2Z4vFNXzOkcGs025WY"/>
</div>
<h5 class="text-sm font-semibold">Broqueles Pétalo de Oro</h5>
</div>
<div class="group">
<div class="aspect-[1/1] bg-surface-container mb-4 overflow-hidden">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCzuKkiuQZuqzYxqxrVj2WAYe3W0t9MV122eRcGyWtg_uRUSzxtyLlvfboNJEBn8QsS0EAgrnRZ0iNcM5jXAl_SvCNdWyf_tjN8gEUFkS2Yn6iHcd2BJ-jLUZFHph7wxemPkQARMZFrGvsXS49Ca-9JBRCH6VFd_3jSMAgDvbFm8DUdBhIyQFY9HcWI4CwlbmaImqlZAq-gf0voeRasNkyncDgKZFv3hKVy-7hNjlmyQbS2A2yv_B4s9mYf53JqVqepgzP5gfthoik"/>
</div>
<h5 class="text-sm font-semibold">Zafiro de Medianoche</h5>
</div>
<div class="group">
<div class="aspect-[1/1] bg-surface-container mb-4 overflow-hidden">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCLDTRbmqmrrsMQVc00kWkk8wM2tUxA6uTxAykxL0g3ub2EYWc2GMO49WlOYHikUsH45-V33ax7GHzQQ3NHJaZszgyomHBhztcRbmDPdgYgTiXLxqzpYsaxseGMQ85kfVJJ_EhvpJKqAlKUKe3JBtnyxRiA1t3coFi_n0IJKoLZj7HoS4K3__74mLPgctJ8zcl6gZtEsMgdedQJgeSh8utpKY3zvw5Z2uE7Skg60lID_vJA04QGEaGbJ7_LIG_G91aIfFyrAhRm1O4"/>
</div>
<h5 class="text-sm font-semibold">Reloj Editorial</h5>
</div>
</div>
</div>
</section>
<!-- Our Story Section -->
<section id="herencia" class="bg-surface-container-low py-32 px-8 overflow-hidden">
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-16 items-center">
<div class="md:col-span-6 relative">
<div class="aspect-[3/4] overflow-hidden rounded-sm">
<img class="w-full h-full object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDELPIP7OvFUKBUsSdu35NelBFamQ2IaFwW6BWzIpWWhp0OyaMzzn0o3CdfJw2vi240ugTrOBL1k-iaruvJXsRhp44svpag1MKZto1OBtVqNwWqz3MsAMe0_iz_evQvmur16Ucww8KDNbsqoYZu6-kySA4snkl8yzUHp_ocXVbJYs9DITfKxJqRRPNZm8wadbAV1jUF-4Kc9x3zzWpfSvQ3Dm7u255aw4NnAQTw7bkdUbIajwJ1fcf8ECjwQCF2dQP58hKlgahF22Q"/>
</div>
<div class="absolute -right-12 -bottom-12 w-64 h-64 bg-primary p-8 hidden lg:flex flex-col justify-end text-surface">
<span class="font-headline text-4xl italic">Colombia</span>
<p class="font-label text-xs tracking-widest mt-4 uppercase">Cali • Colombia</p>
</div>
</div>
<div class="md:col-span-6 space-y-12">
<span class="font-label text-xs uppercase tracking-[0.3em] text-secondary">Nuestra Herencia</span>
<h2 class="font-headline text-5xl leading-tight">Años de <br/>Artesanía <br/>Inigualable</h2>
<div class="space-y-6 text-lg text-on-surface-variant leading-relaxed">
<p>Jessica Joyería se ha destacado por más de una década por ofrecer accesorios de la más alta calidad. Lo que comenzó como un pequeño taller en Cali se ha convertido en un destino para quienes buscan lo extraordinario.</p>
<p>Nuestra filosofía es simple: honrar la belleza intrínseca de las gemas más raras del mundo a través de técnicas artesanales que han permanecido invariables por generaciones. Cada diamante es seleccionado a mano; cada engaste es una obra de arte estructural.</p>
</div>
<button class="font-label text-sm uppercase tracking-widest text-primary border-b-2 border-primary pb-2 hover:text-secondary hover:border-secondary transition-all">Conoce Nuestra Historia</button>
</div>
</div>
</section>
<!-- Signature Footer -->
<footer class="bg-[#fbf9f4] dark:bg-[#003229] w-full mt-24">
<div class="grid grid-cols-1 md:grid-cols-3 gap-12 px-12 py-16 border-t border-[#003229]/5">
<!-- Branding -->
<div class="space-y-6">
<h2 class="font-serif text-lg font-bold text-[#003229] dark:text-[#fbf9f4]">Jessica Joyería</h2>
<p class="font-sans text-xs tracking-[0.1em] uppercase text-[#003229]/70 dark:text-[#fbf9f4]/70 leading-loose">
                        Orgullosos de ofrecer joyería artesanal de alta calidad. Accesorios en plata y baño de oro.
                    </p>
<div class="flex space-x-4">
<a class="text-[#003229] dark:text-[#fbf9f4] hover:text-[#735c00] transition-colors" href="#">
<span class="material-symbols-outlined">public</span>
</a>
<a class="text-[#003229] dark:text-[#fbf9f4] hover:text-[#735c00] transition-colors" href="#">
<span class="material-symbols-outlined">camera</span>
</a>
</div>
</div>
<!-- Contact Info -->
<div class="space-y-6">
<h3 class="font-sans text-xs tracking-[0.1em] uppercase text-[#003229] dark:text-[#fbf9f4] font-bold">Contáctanos</h3>
<ul class="space-y-4 font-sans text-xs tracking-[0.1em] uppercase">
<li><a class="text-[#003229]/70 dark:text-[#fbf9f4]/70 hover:text-[#735c00] underline decoration-1" href="#">Email: contacto@jessicajoyeria.com</a></li>
<li><a class="text-[#003229]/70 dark:text-[#fbf9f4]/70 hover:text-[#735c00] underline decoration-1" href="#">WhatsApp: +57 300 123 4567</a></li>
<li><a class="text-[#003229]/70 dark:text-[#fbf9f4]/70 hover:text-[#735c00] underline decoration-1" href="#">Ubicación: Cali, Colombia</a></li>
</ul>
</div>
<!-- Socials & Legal -->
<div class="space-y-6">
<h3 class="font-sans text-xs tracking-[0.1em] uppercase text-[#003229] dark:text-[#fbf9f4] font-bold">Síguenos</h3>
<ul class="space-y-4 font-sans text-xs tracking-[0.1em] uppercase">
<li><a class="text-[#003229]/70 dark:text-[#fbf9f4]/70 hover:text-[#735c00] underline decoration-1" href="#">Instagram</a></li>
<li><a class="text-[#003229]/70 dark:text-[#fbf9f4]/70 hover:text-[#735c00] underline decoration-1" href="#">Facebook</a></li>
</ul>
<p class="font-sans text-[10px] tracking-[0.15em] uppercase text-[#003229]/40 dark:text-[#fbf9f4]/40 pt-8">
                        © 2025 Jessica Joyería. Todos los derechos reservados.
                    </p>
</div>
</div>
</footer>
</main>
@endsection
