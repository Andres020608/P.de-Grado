<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'The Imperial Editorial' }} - Management Suite</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:wght@400;700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-primary-fixed-variant": "#0a5043",
                        "on-error": "#ffffff",
                        "on-background": "#1b1c19",
                        "primary-container": "#004b3e",
                        "surface-variant": "#e4e2dd",
                        "tertiary-fixed": "#ffe089",
                        "on-secondary": "#ffffff",
                        "surface-container-high": "#eae8e3",
                        "outline-variant": "#bfc9c4",
                        "on-tertiary": "#ffffff",
                        "inverse-surface": "#30312e",
                        "surface-tint": "#2b695a",
                        "surface-bright": "#fbf9f4",
                        "on-tertiary-fixed-variant": "#574400",
                        "surface-container-highest": "#e4e2dd",
                        "surface": "#fbf9f4",
                        "inverse-primary": "#95d3c1",
                        "error-container": "#ffdad6",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary-fixed": "#241a00",
                        "secondary-container": "#fed65b",
                        "tertiary-fixed-dim": "#e3c46b",
                        "primary-fixed-dim": "#95d3c1",
                        "on-primary-container": "#7dbaa9",
                        "on-tertiary-fixed": "#241a00",
                        "on-tertiary-container": "#4f3d00",
                        "on-secondary-fixed-variant": "#574500",
                        "on-surface": "#1b1c19",
                        "on-primary-fixed": "#00201a",
                        "inverse-on-surface": "#f2f1ec",
                        "secondary-fixed-dim": "#e9c349",
                        "primary": "#003229",
                        "secondary-fixed": "#ffe088",
                        "error": "#ba1a1a",
                        "on-error-container": "#93000a",
                        "surface-dim": "#dbdad5",
                        "on-primary": "#ffffff",
                        "tertiary": "#735c0a",
                        "primary-fixed": "#b0efdd",
                        "on-secondary-container": "#745c00",
                        "secondary": "#735c00",
                        "surface-container-low": "#f5f3ee",
                        "tertiary-container": "#c5a853",
                        "surface-container": "#f0eee9",
                        "on-surface-variant": "#404945",
                        "outline": "#707975",
                        "background": "#fbf9f4"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "fontFamily": {
                        "headline": ["Noto Serif"],
                        "body": ["Manrope"],
                        "label": ["Manrope"]
                    }
                },
            },
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }
        body {
            font-family: 'Manrope', sans-serif;
            background-color: #fbf9f4;
        }
        .serif-headline {
            font-family: 'Noto Serif', serif;
        }
    </style>
</head>
<body class="text-on-surface bg-surface">
    <x-admin-header />
    <div class="flex">
        <x-admin-sidebar :active="$active ?? null" />
        <!-- Main Content -->
        <main class="flex-1 md:ml-64 min-h-screen p-8 md:p-16">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>
