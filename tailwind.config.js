import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Your custom DreamHome Palette
                dh: {
                    light: '#F0EEEA',     // Top: Off-white (Best for main content backgrounds)
                    sand: '#C79A70',      // Second: Tan/Sand (Best for active states or subtle highlights)
                    charcoal: '#5B4F4D',  // Third: Dark Brown/Taupe (Best for the Sidebar background)
                    forest: '#5D786F',    // Bottom: Muted Green (Best for buttons or hover states)
                }
            }
        },
    },

    plugins: [forms],
};