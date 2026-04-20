import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                headline: ['Noto Serif', 'serif'],
                body: ['Manrope', 'sans-serif'],
                label: ['Manrope', 'sans-serif'],
            },
            colors: {
                "primary": "#003229",
                "secondary": "#735c00",
                "error": "#ba1a1a",
                "surface": "#fbf9f4",
                "on-primary": "#ffffff",
                "on-secondary": "#ffffff",
                "on-error": "#ffffff",
                "on-surface": "#1b1c19",
                "on-surface-variant": "#404945",
                "surface-container": "#f0eee9",
                "surface-container-low": "#f5f3ee",
                "surface-container-lowest": "#ffffff",
                "primary-container": "#004b3e",
                "on-primary-container": "#7dbaa9",
                "secondary-container": "#fed65b",
                "on-secondary-container": "#745c00",
                "outline": "#707975",
                "outline-variant": "#bfc9c4",
            },
        },
    },

    plugins: [forms],
};
